<?php
class BaseDatos{
	private $host = "localhost";  
	private $usuario = "root";
	private $password = "";
	private $db = "meiko";
	private $query = null; 
	private $conexion = null;
	public $acceso = false;
	public function __construct()
	{
		$this->conexion = mysqli_connect($this->host, $this->usuario, $this->password,$this->db);	
		if (mysqli_connect_errno()) {
			echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}	
	}	
	
	public function consultarRegistros($query)
	{
		if ($result = mysqli_query($this->conexion, $query)) {
			$row_cnt = mysqli_num_rows($result);
			printf("El resultado tiene %d filas.\n", $row_cnt);
			mysqli_free_result($result);
		}
	}
	public function crearRegistros($query)
	{
		mysqli_query($this->conexion, $query);	
	}
	public function eliminarRegistros($query)
	{
		mysqli_query($this->conexion, $query);		
	}
	public function actualizarRegistros($query)
	{
		mysqli_query($this->conexion, $query);
	}
	public function getAcceso($query)	
	{
		if ($result = mysqli_query($this->conexion, $query)) {
			$row_cnt = mysqli_num_rows($result);
			mysqli_free_result($result);
		}
		if ($row_cnt > 0) {
			echo "Acceso concedido";
			$this->acceso = true;
		} 
		else
		{
			echo "Acceso denegado";
		} 
	}
}

$consultar = "select nombres,apellidos,pais from tbusuario where id = 1";
$eliminar = "delete from tbusuario where id = 3";
$insertar = "INSERT INTO tbusuario(id, nombres, apellidos, pais) VALUES (3,'Angelica', 'Galindo', 'Colombia')";
$credenciales = "select username from tbadministrador where id = 1";
$usuario = new BaseDatos();
$usuario->getAcceso($credenciales);
if ($usuario->acceso) {
	$usuario->consultarRegistros($consultar);
	$usuario->crearRegistros($insertar);
	$usuario->crearRegistros($eliminar);		
}  
		
?>  