<?php
session_start();
require_once 'model/proyecto.php';

class ProyectoController{
    
    private $model;
    public $id;
    
    public function __CONSTRUCT(){
        $this->model = new Proyecto();
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

    public function misProyectos(){
         require_once 'view/usuario/headerEdil.phtml';
         require_once 'view/proyecto/proyectos.phtml';
         require_once 'view/footer.phtml';
    }

     public function Editar(){
        $proyecto = new Proyecto();
        
        if(isset($_REQUEST['id'])){
            $proyecto = $this->model->Obtener($_REQUEST['id']);
            
        }
        
         require_once 'view/proyecto/guardarProyecto.phtml';
//echo $_REQUEST['id'];
    }
    
       public function Opinar(){
        require_once 'view/usuario/headerCiudadano.phtml';
         require_once 'view/proyecto/opinaproyecto.phtml';
         require_once 'view/footer.phtml';
    }



    public function OpinarProyecto(){
       $id= $_REQUEST['id'];
       require_once 'view/proyecto/opinion.phtml';
    }

    public function guardarOpinion(){
        $proyecto = new Proyecto();
        echo "Id: ".$_REQUEST['id'];
        $proyecto->id= $_REQUEST['id'];
         $proyecto->opinion= $_REQUEST['opinion'];
         $proyecto->usuario= $_SESSION['nombre']." ".$_SESSION['apellidos'];
 
$this->model->ActualizarOpinion($proyecto); 
         
header('Location: ?c=Proyecto&a=Opinar');

    }
  
    
    public function Guardar(){
      $proyecto = new Proyecto();
        
        

         $proyecto->id = $_REQUEST['id'];
         echo $_REQUEST['id'];
         
        $proyecto->titulo = $_REQUEST['titulo'];
        $proyecto->descripcion = $_REQUEST['descripcion'];
        $proyecto->fechaInicio = $_REQUEST['fecha_inicio'];
        $proyecto->fechaTerminacion = $_REQUEST['fecha_terminacion'];
        $proyecto->nombreArchivo = $_FILES['archivo']['name'];
      
      if(!empty($_FILES['archivo']['name'])){
        $ruta = $_FILES['archivo']['tmp_name'];
        $destino = "resource/proyectos/" . $_FILES['archivo']['name'];
        $nombre = $_FILES['archivo']['name'];

        copy($ruta, $destino);
        }
        
        if($proyecto->id > 0){
            $this->model->Actualizar($proyecto);          
        }
        else{
            $this->model->Registrar($proyecto);
         
        }
       
        
        header('Location: ?c=Proyecto&a=misProyectos');
    }
    
    public function Eliminar(){
        $this->model->Eliminar($_REQUEST['id']);

        $this->misProyectos();
    }

      public function mostrarJson(){
        

        $this->model->ListarJson();
    }

       public function mostrarJsonPorId(){
        $id= $_REQUEST['id'];

        $this->model->ObtenerJson($id);
    }

    public function RegistroProyecto(){
          require_once 'view/proyecto/guardarProyecto.phtml';

    } 

       public function Datos(){

    require_once 'resource/json.php';
                 
    }


   public function Grafica(){

     require_once 'resource/grafica.php';
                 
  }

    public function consultaCertificados(){

     require_once 'resource/jsonCertificados.php';
                 
  }


  public function GraficaCertificados(){

     require_once 'resource/graficaCertificados.php';
                 
  }
  
 


    
}