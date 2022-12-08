<?php

class ReceatController extends Controller{
    
    var $json;

    function __construct(){
        //Controlador padre
        parent::__construct();    
        //cargar modelo
        $this->loadModel('receat');
        //iniciar respuesta
        $this->json = array();
    }


    function add(){
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $data = $this->getdataparamaters_json();


            $data = array(
                'nombrereceta'       => $data['nombrereceta'],
                'tipocomida'          => $data['tipocomida'],
                'cantidadp'          => $data['cantidadp'],
                'nivel'          => $data['nivel'],
                'ingredientes'          => $data['ingredientes'],
                'nnacionalidad'          => $data['nnacionalidad'],
                'pasos'          => $data['pasos'],
                'img' => $data['img']
            );

            //echo json_encode($data);
            $this->json = $this->model->add($data);
            echo json_encode($this->json);
        }
    }

    function addFav(){
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $data = $this->getdataparamaters_json();


            $data = array(
                'usuario'       => $data['usuario'],
                'nombrereceta'       => $data['nombrereceta'],
                'tipocomida'          => $data['tipocomida'],
                'cantidadp'          => $data['cantidadp'],
                'nivel'          => $data['nivel'],
                'ingredientes'          => $data['ingredientes'],
                'nnacionalidad'          => $data['nnacionalidad'],
                'pasos'          => $data['pasos'],
                'img' => $data['img']
            );

            //echo json_encode($data);
            $this->json = $this->model->addFav($data);
            echo json_encode($this->json);
        }
    }

    function updateFav(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $data = $this->getdataparamaters_json();


            $data = array(
                'usuario'       => $data['usuario'],
                'nombrereceta'       => $data['nombrereceta'],
                'favorito'      =>$data['favorito'],
                
            );

            //echo json_encode($data);
            $this->json = $this->model->updateFav($data);
            //echo json_encode($this->json);
            echo $this->json;
            
        }
    }

    function getAll(){
        if($_SERVER['REQUEST_METHOD'] === 'GET'){
            $data = $this->getdataparamaters_json();
           
            $this->json = $this->model->getAll();
            echo json_encode($this->json);
        }
    }

    function getOneReceat(){
        if($_SERVER['REQUEST_METHOD'] === 'GET'){
                    
            $this->json = $this->model->getOneReceat($_GET['nombrereceta']);
            echo json_encode($this->json);
        }
    }

    function getOneFav(){
        if($_SERVER['REQUEST_METHOD'] === 'GET'){
                    
            $this->json = $this->model->getOneFav($_GET['usuario'],$_GET['nombrereceta']);
            echo json_encode($this->json);
        }
    }
    function getStateFav(){
        if($_SERVER['REQUEST_METHOD'] === 'GET'){
                    
            $this->json = $this->model->getStateFav($_GET['usuario'],$_GET['nombrereceta']);
            echo json_encode($this->json);
        }
    }

}