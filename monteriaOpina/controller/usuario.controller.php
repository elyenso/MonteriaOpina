<?php

session_start();
require_once 'model/usuario.php';

class UsuarioController{
    
    private $model;
    
    public function __CONSTRUCT(){
        $this->model = new Usuario();
    }
    
    public function Index(){
        require_once 'view/header.phtml';
        require_once 'view/home.phtml';
        require_once 'view/footer.phtml';
    }

    public function HomeEdil(){
         require_once 'view/usuario/headerEdil.phtml';
         require_once 'view/home.phtml';
         require_once 'view/footer.phtml';
    }

    public function HomeCiudadano(){
         require_once 'view/usuario/headerCiudadano.phtml';
         require_once 'view/home.phtml';
         require_once 'view/footer.phtml';

    }
    
      public function Opinar(){
        require_once 'view/usuario/headerCiudadano.phtml';
         require_once 'view/proyecto/opinaproyecto.phtml';
         require_once 'view/footer.phtml';
    }

    
    
    public function Editar(){
        $usuario = new Usuario();
        
        if(isset($_REQUEST['id'])){
            $usuario = $this->model->Obtener($_REQUEST['id']);
        }
        
         require_once 'view/usuario/registro.phtml';

    }
    
    public function Guardar(){
        $alm = new Usuario();

        if(isset($_REQUEST['id'])){
        $alm->id = $_REQUEST['id'];

        }
        
        $alm->nombre = $_REQUEST['nombre'];
        $alm->apellidos = $_REQUEST['apellidos'];
        $alm->correo = $_REQUEST['correo'];
        $alm->password = $_REQUEST['password'];
        $alm->fecha_nacimiento = $_REQUEST['fecha_nacimiento'];


        $alm->id > 0 
            ? $this->model->Actualizar($alm)
            : $this->model->Registrar($alm);
            
        $this->Registro();
            ?>

            <script>
		document.getElementById("mensaje_registro").style.display='block';
            </script>

            <?php


                   
    }

 
    
    public function Eliminar(){
        $this->model->Eliminar($_REQUEST['id']);
        header('Location: index.php');
    }

    public function Registro(){
          require_once 'view/usuario/registro.phtml';

    } 

    public function Login(){
         require_once 'view/usuario/login.phtml';
    }

    public function Loguear(){


        $_SESSION['nombre']="";
        $_SESSION['apellidos']="";

        $estado=1;
        $correo=$_REQUEST['username'];
        $password=md5($_REQUEST['password']);

        $req=$this->model->ConsultarUsuario($correo,$password);
        $user=$this->model->ObtenerPorCorreo($correo);

        $_SESSION['nombre']=$user->nombre;

        $_SESSION['apellidos']=$user->apellidos;

       

       if($req){

            if($req->estado==1){
                if($req->rol=="edil"){
                    $this->HomeEdil();
                 }
                else{
                    $this->HomeCiudadano();
                }
            }
            
            elseif($req->estado==0){

                $this->Login();
           
              ?>

            <script>
		document.getElementById("mensaje_sin_activa").style.display='block';
            </script>

            <?php
                
            }
    

        }
        else{
           $this->Login();
             ?>

            <script>
		    document.getElementById("mensaje_sin_registrar").style.display='block';
            </script>

            <?php
         $this->Login();
        }

    }

    public function Activar(){
        $req=$this->model->ActivarUsuario($_REQUEST['correo'],$_REQUEST['codigo']);

         ?>
         <script>

         alert("Su cuenta a sido activada exitosamente");
         </script>

         <?php
         header('Location: index.php');

    }

    public function Logout(){

        session_destroy();
        $this->Index();
    }

    public function validarCorreo(){
              
                $req=$this->model->consultarCorreo($_POST['usuario']);

                if($req){
                      ?>

            <script>
		    document.getElementById("mensaje_correo_repetido").style.display='block';
            </script>

            <?php
                }
               


    }

    
}