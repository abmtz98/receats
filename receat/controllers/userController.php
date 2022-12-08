<?php

class UserController extends Controller{
    
    var $json;

    function __construct(){
        //Controlador padre
        parent::__construct();    
        //cargar modelo
        $this->loadModel('user');
        //iniciar respuesta
        $this->json = array();
    }

    function signup(){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
        
            $data = $this->getdataparamaters_json();

            $img = isset($data['img']) ? $data['img'] : "";

            $data = array(
                'email'      => $data['email'], 
                'passw'      => $data['passw'],
                'usuario'    => $data['usuario'],
                'img'        => $img
            );

            $data2 = array(
                'email'         => $data['email']
            );

            $check = $this->model->check_user($data2);
            if($check == 0){
                $this->json = $this->model->signup($data);
            } else{
                $this->json = array('error','error');
            }

            echo json_encode($this->json);

        }

    }


    function login(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $data = $this->getdataparamaters_json();

            $data = array(
                'email'    => $data['email'], 
                'passw' => $data['passw']
            );

            $this->json = $this->model->login($data);
            echo json_encode($this->json);
        }
    }

}