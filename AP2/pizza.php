<?php

require_once"accesoDatos.php";

class pizza
{
	public $id;
	public $sabor;
 	public $tipo;
  	public $cantidad;
	//public $id;
	//CONSTRUCTOR
	public function __construct($sabor, $tipo, $cantidad,$id){
		$this->sabor = $sabor;
		$this->tipo = $tipo;
		$this->cantidad = $cantidad;
		$this->id= $id;
	}    
	//OBTENCION DE TODOS LAS PERSONAS DE LA BASE DE DATOS
	public static function TraerTodasLasPersonas(){
		$sql = 'SELECT * FROM pizza';
        $consulta = AccesoDatos::ObtenerObjetoAccesoDatos()->ObtenerConsulta($sql);
	    $consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_ASSOC);	
	}
	//ELIMINACION DE UNA PERSONA DE LA BASE DE DATOS
	public static function BorrarPersona($id){	
		$sql = 'DELETE FROM pizza WHERE id = :id';
		$consulta = AccesoDatos::ObtenerObjetoAccesoDatos()->ObtenerConsulta($sql);
		$consulta->bindValue(':id', $id);		
		$consulta->execute();
	}
	//CREACION DEL PERSONA EN LA BASE DE DATOS
	public static function InsertarPersona($pizza){
		//VERIFICACION DE EXISTENCIA DEL USUARIO
		if (pizza::ObtenerPersona($pizza->id,0) != NULL) {
			return false;//EL USUARIO YA EXISTIA PREVIAMENTE EN LA BASE DE DATOS
		}
		else{
			//CREACION DEL USUARIO EN LA BASE DE DATOS
			$sql = 'INSERT INTO pizza (sabor,tipo,cantidad) VALUES (:sabor, :tipo, :cantidad)';
			$consulta = AccesoDatos::ObtenerObjetoAccesoDatos()->ObtenerConsulta($sql);
			$consulta->bindValue(':sabor', $pizza->sabor);
			$consulta->bindValue(':tipo', $pizza->tipo);
			$consulta->bindValue(':cantidad', $pizza->cantidad);
			$consulta->execute();
			return true;//ALTA EXITOSA
		}
	}
	public static function ModificarUnaPersona($pizza){
		//VERIFICACION DE EXISTENCIA DEL USUARIO
		if (pizza::ObtenerPersona($pizza->id,$pizza->id) != NULL) {
			return false;//EL USUARIO YA EXISTIA PREVIAMENTE EN LA BASE DE DATOS
		}
		else{
			
			pizza::BorrarPersona($pizza->id);
			//CREACION DEL USUARIO EN LA BASE DE DATOS
			$sql = 'INSERT INTO pizza (sabor,tipo,cantidad) VALUES (:sabor, :tipo, :cantidad)';
			$consulta = AccesoDatos::ObtenerObjetoAccesoDatos()->ObtenerConsulta($sql);
			$consulta->bindValue(':sabor', $pizza->sabor);
			$consulta->bindValue(':tipo', $pizza->tipo);
			$consulta->bindValue(':cantidad', $pizza->cantidad);
			$consulta->execute();
			return true;//ALTA EXITOSA
		}
	}
	
	
	//OBTENCION DE UN USUARIO
	public static function ObtenerPersona($id){
		//aca busco coincidencias solo cuando es insert de uno nuevo, es decir, me fijo que no haya otro en toda la base
		if($id==0){
			$sql = 'SELECT * FROM pizza WHERE id = :id';
			
        $consulta = AccesoDatos::ObtenerObjetoAccesoDatos()->ObtenerConsulta($sql);
			$consulta->bindParam(':id', $id);
			
		}
		else{  //aca intento ver que no haya otros en toda la base salvo ese, porque va a ser borrado de todas formas, y es como si no hubiera
			$sql = 'SELECT * FROM pizza WHERE id <> :id ';
			
        $consulta = AccesoDatos::ObtenerObjetoAccesoDatos()->ObtenerConsulta($sql);		
			$consulta->bindParam(':id', $id);
			//$consulta->bindParam(':dni', $dni);
		}
		
	    $consulta->execute();
	    return $consulta->fetch(PDO::FETCH_ASSOC);
	}
}