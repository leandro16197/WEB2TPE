<?php
require_once './Model/SeriesModel.php';
require_once './Model/GenerosModel.php';
require_once './Views/ModificarView.php';

class ModificarController{
    private $serieModel;
    private $generoModel;
    private $modificarView;

    function __construct(){
        $this->serieModel=new SeriesModel();   
        $this->generoModel=new GenerosModel();
        $this->modificarView=new ModificarView();

    }
    public function checkLogginIn(){
        session_start();
        if(!isset($_SESSION['user'])){
            header("Location: " . LOGIN_URL);
            die();
        }else{
            header("Location:". BASE_URL);
        }
        if(isset($_SESSION['LAST_ACTIVITY']) &&
            time()- $_SESSION['LAST_ACTIVITY'] > 3600){
                header("Location: " . LOGIN_URL);
                die();
            }
        $_SESSION['LAST_ACTIVITY'] = time();
    }
    //trae todas las series
    function getSeries(){
        session_start();
        $user= $_SESSION['user'];
        $series=$this->serieModel->getSerieGenro();
        $generos=$this->generoModel->getGeneros();
        $this->modificarView->DisplaySeries($series,$generos,$user);

    }
    //ABM SERIE

    function locacionModificar(){
        header("Location: ". MODIFICAR_URL);
    }
    //agrega una serie
    function addSerie(){  
        $this->checkLogginIn();
        if(($_FILES["img"]["type"]=="image/png") || ($_FILES["img"]["type"]=="image/jpg")){
            $img=$_FILES["img"];
            $origen=$img["tmp_name"];
            $destino="publico/images/".uniqid().$img["name"];
            copy($origen,$destino);
            $this->serieModel->addSerie($_POST['nombre'],$_POST['sinopsis'],$_POST['actor'],$_POST['genero'],$destino);
            $this->locacionModificar();
        }else{
            $this->getSeries();
        }
        
       
    }
    //elimina serie segun id
    function deleteSerie($id){
        $this->checkLogginIn();
        $this->serieModel->deleteSerie($id);
        $this->locacionModificar();
    }
    //edita serie
    public function editarSerie(){
        $this->checkLogginIn();
        $id = $_POST['id-serie'];
        $this->serieModel->editSerie( $_POST['nombreSerie'], $_POST['sinopsis'], $_POST['actor'], $_POST['genero-editar'], $id);
        $this->locacionModificar();
    }

    //ABM GENEROS

    //agregar un genero
    function addGenero(){
        $this->checkLogginIn();
        $this->generoModel->addGenero($_POST['nombre-gen']);
        $this->locacionModificar();
    }

    //edita nombre genero
    function editarGenero(){
        $this->checkLogginIn();
        $this->generoModel->editGenero($_POST['genero'],$_POST['id-genero']);
        $this->locacionModificar();
    }
    //eliminar genero
    function deleteGen($id){
        $this->checkLogginIn();
        $this->generoModel->deleteGenero($id);
        $this->locacionModificar();
    }
}