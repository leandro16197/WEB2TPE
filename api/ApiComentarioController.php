<?php
require_once "./Model/ComentarioModel.php";
require_once "./Views/ApiComentarioView.php";

class ApiComentarioController
{
    private $model;
    private $view;

    function __construct()
    {
        $this->model = new ComentarioModel();
        $this->view = new ApiComentarioView();
        $this->data = file_get_contents("php://input");
    }


    function getData()
    {
        return json_decode($this->data);
    }
    function getComentarios()
    {
        $sentencia = $this->model->getComentarios();
        if ($sentencia) {
            return $this->view->response($sentencia, 200);
        } else {
            return $this->view->response("error al traer comentarios", 404);
        }
    }

    function getComentario($param = null){
        $id = $param[':ID'];
        $comentario = $this->model->getComentario($id);
        if ($comentario) {
            return $this->view->response($comentario, 202);
        } else {
            return $this->view->response("error al traer comentario con id=$id", 404);
        }
    }
    function deleteComentario($params = null){
        $id = $params[':ID'];
        $comentario = $this->model->getComentario($id);
        if ($comentario) {
            $this->model->deleteComentario($id);
            return $this->view->response("comentario con id=$id se elimino", 200);
        } else {
            return $this->view->response("nose pudo eliminar comentario con id=$id", 404);
        }
    }

    function addComentario(){
        $body = $this->getData();
        $id = $this->model->insertComentario($body->comentario, $body->puntaje,$body->fecha,$body->id_usuario, $body->id_serie);
        if ($id != 0) {
            return $this->view->response("se agrego correctamente la serie", 200);
        } else {
            return $this->view->response("error al agregar serie", 404);
        }
    }
}
