<?php 

require 'Database.php';

function MostrarProyectos(){

	$datos = array();
	
	if($_SERVER['REQUEST_METHOD'] == 'GET'){
		
		if($id=$_GET['id']){

		$pdo = Database::connect();

		$Proyecto = $pdo->prepare('SELECT * FROM proyecto WHERE id=?');
		$Proyecto->execute(array($id));
		$datos = array();

		if($Proyecto->rowCount() > 0) {
			
			while($row = $Proyecto->fetch(PDO::FETCH_ASSOC)){
				
				$datos = $row;
		
			}	
			$response = array('estado'=>'ok', 'data' => $datos);

		}else{
			$response = array('estado'=>'ok', 'data' => null );
		}
		
	}
	
	
	elseif(!$_GET['id']){
			$pdo = Database::connect();
		$Proyectos = $pdo->prepare('SELECT * FROM proyecto');
		$Proyectos->execute();
		$datos = array();

		if($Proyectos->rowCount() > 0) {
			
			while($row = $Proyectos->fetch(PDO::FETCH_ASSOC)){
				
				$datos[] = $row;
				
			}	
			$response = array('estado'=>'ok', 'data' => $datos);

		}else{
			$response = array('estado'=>'ok', 'data' => null );
		}
		
	}
	
	echo json_encode($datos);
	Database::disconnect();
}
}

MostrarProyectos();


?>