<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require_once "pizza.php";
require 'vendor/autoload.php';

$app = new \Slim\App(['settings' => ['displayErrorDetails' => true]]);

$app->add(function (Request $request, Response $response, $next) {
    $response = $next($request, $response);
    return $response
            ->withHeader('Access-Control-Allow-Origin', 'http://localhost:4200')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});

$app->get('/pizza/obtenerTodas', function (Request $request, Response $response){
    return $response->withJson(pizza::TraerTodasLasPersonas());
});

$app->delete('/pizza/borrar', function (Request $request, Response $response) {
	
	//unlink ('fotos/' . $request->getParam('dni') . '.png'); //BORRA FOTO
	
	pizza::BorrarPersona($request->getParam('id'));//BORRA PERSONA
    return $response;
});

$app->post('/pizza/agregar', function (Request $request, Response $response) {
    //DECODIFICACION DE DATOS DE FORMULARIO Y ALMACENAMIENTO EN ARRAY ASOCIATIVO
	$datosForm = $request->getParsedBody();
    $mensajeError = null;
	//VALIDACION DEL TAMAÑO DE LA IMAGEN
	if ($_FILES['foto']['size'] > (1 /*1MB*/ * 1024 * 1024)) {
		$mensajeError = 'Cambie la imagen, solo se permiten tamaños imagenes de tamaño inferior a 1 MB';
	}
	//VALIDACION DE TIPO DE IMAGEN MEDIANTE EL INTENTO DE PROCESARLA COMO IMAGEN, SI IMAGENINICIAL ES FALSE, FALLO LA VALIDACION
	else if(!($imagenInicial = imagecreatefromstring(file_get_contents($_FILES['foto']['tmp_name'])))) {
		$mensajeError = 'Cambie la imagen, sólo se permiten imágenes con extensión .jpg .jpeg .bmp .gif o .png';
	}
	//CREACION DE PERSONA CON FOTO
	else if(pizza::InsertarPersona(new pizza($datosForm['tipo'], $datosForm['sabor'], $datosForm['cantidad'],0))){
		//OBTENCION DE LAS DIMENSIONES DE LA IMAGEN INICIAL
		$imagenInicialAncho = imagesx($imagenInicial);
		$imagenInicialAlto = imagesy($imagenInicial);
		//CREACION DE UNA IMAGEN VACIA CON LAS DIMENSIONES DE LA IMAGEN INCIAL
		$imagenFinal = imagecreatetruecolor($imagenInicialAncho, $imagenInicialAlto);
		//COPIA DE LA IMAGEN INCIAL EN LA FINAL
		imagecopy($imagenFinal, $imagenInicial, 0, 0, 0, 0, $imagenInicialAncho, $imagenInicialAlto);
		//LIBERACION DE LA MEMORIA DE LA IMAGEN INICIAL
		imagedestroy($imagenInicial);
		//GUARDADO DEFINITIVO DE LA IMAGEN EN EL SERVIDOR CONVIRTIENDOLA EN FORMATO PNG
		imagepng($imagenFinal, 'fotos/' . $datosForm['id'] . '.png');
		//LIBERACION DE LA MEMORIA DE LA IMAGEN FINAL
		imagedestroy($imagenFinal);
	}
	//MENSAJE POR USUARIO DUPLICADO
	else{
		$mensajeError = 'ERROR: El DNI ingresado ya existe en la base de datos. Por favor, revise esa información e intente nuevamente , o intente actualizar el registro ya existente.';
	}
	//CODIFICACION DEL MENSAJE DE ERROR
	return $response->withJson($mensajeError);
});	


$app->post('/perpizzasona/modificar', function (Request $request, Response $response) {
    //DECODIFICACION DE DATOS DE FORMULARIO Y ALMACENAMIENTO EN ARRAY ASOCIATIVOPersona:
	$datosForm = $request->getParsedBody();
    $mensajeError = null;
	//VALIDACION DEL TAMAÑO DE LA IMAGEN
	if ($_FILES['foto']['size'] > (1 /*1MB*/ * 1024 * 1024)) {
		$mensajeError = 'Cambie la imagen, solo se permiten tamaños imagenes de tamaño inferior a 1 MB';
	}
	//VALIDACION DE TIPO DE IMAGEN MEDIANTE EL INTENTO DE PROCESARLA COMO IMAGEN, SI IMAGENINICIAL ES FALSE, FALLO LA VALIDACION
	else if(!($imagenInicial = imagecreatefromstring(file_get_contents($_FILES['foto']['tmp_name'])))) {
		$mensajeError = 'Cambie la imagen, sólo se permiten imágenes con extensión .jpg .jpeg .bmp .gif o .png';
	}
	//CREACION DE PERSONA CON FOTO
	else if(pizza::ModificarUnaPersona(new pizza($datosForm['tipo'], $datosForm['sabor'], $datosForm['cantidad'],$datosForm['id']))){
		//OBTENCION DE LAS DIMENSIONES DE LA IMAGEN INICIAL
		$imagenInicialAncho = imagesx($imagenInicial);
		$imagenInicialAlto = imagesy($imagenInicial);
		//CREACION DE UNA IMAGEN VACIA CON LAS DIMENSIONES DE LA IMAGEN INCIAL
		$imagenFinal = imagecreatetruecolor($imagenInicialAncho, $imagenInicialAlto);
		//COPIA DE LA IMAGEN INCIAL EN LA FINAL
		imagecopy($imagenFinal, $imagenInicial, 0, 0, 0, 0, $imagenInicialAncho, $imagenInicialAlto);
		//LIBERACION DE LA MEMORIA DE LA IMAGEN INICIAL
		imagedestroy($imagenInicial);
		//GUARDADO DEFINITIVO DE LA IMAGEN EN EL SERVIDOR CONVIRTIENDOLA EN FORMATO PNG
		imagepng($imagenFinal, 'fotos/' . $datosForm['id'] . '.png');
		//LIBERACION DE LA MEMORIA DE LA IMAGEN FINAL
		imagedestroy($imagenFinal);
	}
	//MENSAJE POR USUARIO DUPLICADO
	else{
		$mensajeError = 'ERROR: El DNI ingresado ya existe en la base de datos. Por favor, revise esa información e intente nuevamente , o intente actualizar el registro ya existente.';
	}
	//CODIFICACION DEL MENSAJE DE ERROR
	return $response->withJson($mensajeError);
});	
$app->run();


//que cosa es el next de la funcion add????