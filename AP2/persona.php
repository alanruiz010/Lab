<?php

require_once"accesoDatos.php";

class Persona
{
	public $id;
	public $nombre;
 	public $apellido;
  	public $dni;
	public $sexo;
	public $password;
	public $idViejo;
	//CONSTRUCTOR
	public function __construct($nombre, $apellido, $dni, $sexo, $password,$idViejo){
		$this->nombre = $nombre;
		$this->apellido = $apellido;
		$this->dni = $dni;
		$this->sexo = $sexo;
		$this->password = $password;
		$this->idViejo= $idViejo;
	}
	//OBTENCION DE TODOS LAS PERSONAS DE LA BASE DE DATOS
	public static function TraerTodasLasPersonas(){
		$sql = 'SELECT * FROM persona';
        $consulta = AccesoDatos::ObtenerObjetoAccesoDatos()->ObtenerConsulta($sql);
	    $consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_ASSOC);	
	}
	//ELIMINACION DE UNA PERSONA DE LA BASE DE DATOS
	public static function BorrarPersona($id){	
		$sql = 'DELETE FROM persona WHERE id = :id';
		$consulta = AccesoDatos::ObtenerObjetoAccesoDatos()->ObtenerConsulta($sql);
		$consulta->bindValue(':id', $id);		
		$consulta->execute();
	}
	//CREACION DEL PERSONA EN LA BASE DE DATOS
	public static function InsertarPersona($persona){
		//VERIFICACION DE EXISTENCIA DEL USUARIO
		if (Persona::ObtenerPersona($persona->dni,0) != NULL) {
			return false;//EL USUARIO YA EXISTIA PREVIAMENTE EN LA BASE DE DATOS
		}
		else{
			//CREACION DEL USUARIO EN LA BASE DE DATOS
			$sql = 'INSERT INTO persona (nombre, apellido, dni, sexo, password) VALUES (:nombre, :apellido, :dni, :sexo, :password)';
			$consulta = AccesoDatos::ObtenerObjetoAccesoDatos()->ObtenerConsulta($sql);
			$consulta->bindValue(':nombre', $persona->nombre);
			$consulta->bindValue(':apellido', $persona->apellido);
			$consulta->bindValue(':dni', $persona->dni);
			$consulta->bindValue(':sexo', $persona->sexo);
			$consulta->bindValue(':password', $persona->password);
			$consulta->execute();
			return true;//ALTA EXITOSA
		}
	}
	public static function ModificarUnaPersona($persona){
		//VERIFICACION DE EXISTENCIA DEL USUARIO
		if (Persona::ObtenerPersona($persona->dni,$persona->idViejo) != NULL) {
			return false;//EL USUARIO YA EXISTIA PREVIAMENTE EN LA BASE DE DATOS
		}
		else{
			
			Persona::BorrarPersona($persona->idViejo);
			//CREACION DEL USUARIO EN LA BASE DE DATOS
			$sql = 'INSERT INTO persona (nombre, apellido, dni, sexo, password) VALUES (:nombre, :apellido, :dni, :sexo, :password)';
			$consulta = AccesoDatos::ObtenerObjetoAccesoDatos()->ObtenerConsulta($sql);
			$consulta->bindValue(':nombre', $persona->nombre);
			$consulta->bindValue(':apellido', $persona->apellido);
			$consulta->bindValue(':dni', $persona->dni);
			$consulta->bindValue(':sexo', $persona->sexo);
			$consulta->bindValue(':password', $persona->password);
			$consulta->execute();
			return true;//ALTA EXITOSA
		}
	}
	
	
	//OBTENCION DE UN USUARIO
	public static function ObtenerPersona($dni,$id){
		//aca busco coincidencias solo cuando es insert de uno nuevo, es decir, me fijo que no haya otro en toda la base
		if($id==0){
			$sql = 'SELECT * FROM persona WHERE dni = :dni';
			
        $consulta = AccesoDatos::ObtenerObjetoAccesoDatos()->ObtenerConsulta($sql);
			$consulta->bindParam(':dni', $dni);
			
		}
		else{  //aca intento ver que no haya otros en toda la base salvo ese, porque va a ser borrado de todas formas, y es como si no hubiera
			$sql = 'SELECT * FROM persona WHERE dni = :dni and id <> :id ';
			
        $consulta = AccesoDatos::ObtenerObjetoAccesoDatos()->ObtenerConsulta($sql);		
			$consulta->bindParam(':id', $id);
			$consulta->bindParam(':dni', $dni);
		}
		
	    $consulta->execute();
	    return $consulta->fetch(PDO::FETCH_ASSOC);
	}
}