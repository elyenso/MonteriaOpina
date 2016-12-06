<?php
class Usuario
{
	private $pdo;
    
    public $id;
    public $nombre;
    public $apellidos;
    public $fecha_nacimiento;
    public $correo;
    public $password;
    public $rol;
	public $estado;
	public $codigo_activacion;


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

			$stm = $this->pdo->prepare("SELECT * FROM usuarios");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
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
			          ->prepare("SELECT * FROM usuarios WHERE id = ?");
	
			          

			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
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
			            ->prepare("DELETE FROM usuarios WHERE id = ?");			          

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
			$sql = "UPDATE usuarios SET
						nombre          = ?, 
						apellidos        = ?,
                        correo        = ?,
                        password       =?,
						fecha_nacimiento = ?
				    WHERE id = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				    array(
                        $data->nombre, 
                        $data->apellidos,
                        $data->correo,
                        $data->password,
                        $data->fecha_nacimiento,
                        $data->id
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Usuario $data)
	{
		try 
		{
			$codigo=rand(100, 1000000);
		$sql = "INSERT INTO usuarios(nombre,apellidos,correo,password,fecha_nacimiento,rol,estado,codigo_activacion) 
		        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
				array(
                    $data->nombre,
                    $data->apellidos,
                    $data->correo,
                    md5($data->password),
                    $data->fecha_nacimiento,
					"ciudadano",
					0,
                    $codigo
                )
			);

			require("lib/class.phpmailer.php");

			$mail=new PHPMailer();
		
			$mail->From="luisito@dwunicor.com.co";
			$mail->FromName="Unicordoba";
			$mail->Subject="Activacion Cuenta de Usuario";
			$mail->Body='Hola <strong>'.$data->nombre.'</strong>'.
			'<p> Se ha registrado en MonteriaOpina</p>'.
			'para activar su cuenta haga click sobre el siguiente enlace </br>'.
			'<a href="dwunicor.com.co/monteriaOpina/?c=Usuario&a=Activar&correo='.$data->correo.'&codigo='.$codigo.'">'.
			'</a>';
			


			$mail->AllBody="Su servidor de correo no soprta html";
			$mail->AddAddress($data->correo);
			$mail->Send();
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}


		public function ObtenerPorCorreo($correo)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM usuarios WHERE correo = ?");
	
			          

			$stm->execute(array($correo));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	
	public function getUsuarioCodigo($id, $codigo){
		try 
		{
			$stm = $this->pdo

			          ->prepare("SELECT * FROM usuarios WHERE id = ? and codigo_activacion=?");
			          
			$stm->execute(array($id, $codigo));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function activarUsuario($correo, $codigo){
			try 
		{
			$estado=1;
			$sql = "UPDATE usuarios SET
						estado          = ?
				    WHERE correo = ? and codigo_activacion=?";

			$this->pdo->prepare($sql)
			     ->execute(
					 
				    array(
						$estado,
                        $correo, 
                        $codigo
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}		
	}

	public function ConsultarUsuario($correo, $password){

		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM usuarios WHERE correo = ? and password=?");
			          
			$stm->execute(array($correo, $password));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}

	}

	public function consultarCorreo($correo){
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM usuarios WHERE correo = ?");
			          
			$stm->execute(array($correo));
			return $stm->fetch(PDO::FETCH_OBJ);

			
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}

	
	}

	

	
}