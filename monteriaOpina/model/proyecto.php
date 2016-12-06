<?php

class Proyecto{
    
    private $pdo;

    public $id;
    public $titulo;
    public $descripcion;
    public $fechaInicio;
    public $fechaTerminacion;
	public $nombreArchivo;
	public $opinion;
	public $usuario;

    public function __CONSTRUCT()
	{
		try
		{
			$this->pdo = Database::StartUp();     
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

    public function Listar()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM proyecto");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
			
			//echo json_encode($stm->fetchAll(PDO::FETCH_OBJ));
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	  public function ListarJson()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM proyecto");
			$stm->execute();

			
			
			echo json_encode($stm->fetchAll(PDO::FETCH_OBJ));
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obtener($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM proyecto WHERE id = ?");
			          

			$stm->execute(array($id));
		return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

		public function ObtenerJson($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM proyecto WHERE id = ?");
			          

			$stm->execute(array($id));
		echo json_encode($stm->fetchAll(PDO::FETCH_OBJ));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Eliminar($id)
	{
		try 
		{
			$stm = $this->pdo
			            ->prepare("DELETE FROM proyecto WHERE id = ?");			          

			$stm->execute(array($id));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar($data)
	{
		try 
		{
			$sql = "UPDATE proyecto SET
						titulo          = ?, 
						descripcion        = ?,
                        fecha_inicio        = ?,
                        fecha_terminacion       =?,
                        nombre_archivo       =?

				    WHERE id = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				    array(
                        $data->titulo, 
                        $data->descripcion,
                        $data->fechaInicio,
                        $data->fechaTerminacion,
						$data->nombreArchivo,
                        $data->id
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
	
	public function ActualizarOpinion($data)
	{
		try 
		{
			
			$sql = "UPDATE proyecto SET
						opinion          = ?, 
						usuario        = ?

				    WHERE id = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				    array(
                        $data->opinion, 
                        $data->usuario,
                        $data->id
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}


	public function Registrar(Proyecto $data)
	{
		try 
		{
			
		$sql = "INSERT INTO proyecto(titulo,descripcion,fecha_inicio,fecha_terminacion, nombre_archivo) 
		        VALUES (?, ?, ?, ?,?)";

		$this->pdo->prepare($sql)
		     ->execute(
				array(
                   $data->titulo, 
                    $data->descripcion,
                    $data->fechaInicio,
                    $data->fechaTerminacion,
					$data->nombreArchivo
                )
			);

		
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}


}