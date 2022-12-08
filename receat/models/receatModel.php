<?php
    class ReceatModel extends Model{
        public function __construct(){
            parent::__construct();
        }
        public function add($data){
            $result;
    
            try{
    
                $sql = "CALL sp_addReceat(
                    :nombrereceta,
                    :tipocomida, 
                    :cantidadp,
                    :nivel,
                    :ingredientes,
                    :nnacionalidad,
                    :pasos,
                    :img
                )";   
    
                $connection = $this->db->connect();
                $query = $connection->prepare($sql);
    
                if($query->execute($data)){
                    $result = 1;
                }else{
                    $result = 0;
                }
    
            }catch(PDOException $e){
                echo $e;
                $result = 0;
            }
    
            return $result;
        
        }

        public function addFav($data){
            $result;
    
            try{
    
                $sql = "CALL sp_addFav(
                    :nombrereceta,
                    :tipocomida, 
                    :cantidadp,
                    :nivel,
                    :ingredientes,
                    :nnacionalidad,
                    :pasos,
                    :img,
                    :usuario
                )";   
    
                $connection = $this->db->connect();
                $query = $connection->prepare($sql);
    
                if($query->execute($data)){
                    $result = 1;
                }else{
                    $result = 0;
                }
    
            }catch(PDOException $e){
                echo $e;
                $result = 0;
            }
    
            return $result;
        
        }

        function updateFav($data){
            $result = false;
    
            try{
    
                $sql = "CALL sp_updateFav(
                    :favorito,
                    :usuario,
                    :nombrereceta
                )";   
    
                $connection = $this->db->connect();
                $query = $connection->prepare($sql);
    
                if($query->execute($data)){
                    $result = 1;
                }else{
                    $result = 0;
                }
    
            }catch(PDOException $e){
                echo $e;
                $result = 0;
            }
    
            return $result;
        }
        
        function getAll(){

            $items = [];
            
            try{
    
                $sql = "SELECT * FROM recetas order by nombrereceta";
                $connection = $this->db->connect();
    
                $query = $connection->prepare($sql);
    
                $query->execute();
                
                if($query->rowCount() > 0){
                    
                    while($row = $query->fetch()){
                        //$item = $row;
                        
                        $item = array(
                            'nombrereceta'   => $row['nombrereceta'],
                            'tipocomida'     => $row['tipocomida'],
                            'cantidadp'      => $row['cantidadp'],
                            'nivel'          => $row['nivel'],
                            'ingredientes'   => $row['ingredientes'],
                            'nnacionalidad'  => $row['nnacionalidad'],
                            'pasos'          => $row['pasos'],
                            'img'            => $row['img']
                        );
                        
                        array_push($items, $item);
                    }
                    
                    //var_dump($items);
                }
    
            }catch(PDOException $e){
                $items = array(0);
            }
    
            return $items;
        }

        function getOneReceat($nombrereceta){

            $items = [];
            
            try{
    
                //$sql = "SELECT * FROM recetas where nombrereceta = p_nombrereceta order by nombrereceta";
                $sql = "CALL sp_getOneReceat(?)";
                $connection = $this->db->connect();
    
                $query = $connection->prepare($sql);
                $query->bindValue(1,$nombrereceta);

                $query->execute();
                
                if($query->rowCount() > 0){
                    
                    while($row = $query->fetch()){
                        //$item = $row;
                        
                        $item = array(
                            'nombrereceta'   => $row['nombrereceta'],
                            'tipocomida'     => $row['tipocomida'],
                            'cantidadp'      => $row['cantidadp'],
                            'nivel'          => $row['nivel'],
                            'ingredientes'   => $row['ingredientes'],
                            'nnacionalidad'  => $row['nnacionalidad'],
                            'pasos'          => $row['pasos'],
                            'img'            => $row['img']
                        );
                        
                        array_push($items, $item);
                    }
                    
                    //var_dump($items);
                }
    
            }catch(PDOException $e){
                $items = array(0);
            }
    
            return $items;
        }

        function getOneFav($usuario, $nombrereceta){

            $items = [];
            
            try{
                
                //$sql = "SELECT favorito FROM favorito WHERE usuario = '".$usuario."' and nombrereceta = '".$nombrereceta."'";
                $sql = "CALL sp_GetOneFav('".$usuario."','".$nombrereceta."')";
                $connection = $this->db->connect();
    
                $query = $connection->prepare($sql);
                


                $query->execute();
                
                if($query->rowCount() > 0){
                    
                    while($row = $query->fetch()){
                        //$item = $row;
                        
                        $item = array(
                            'Mensaje'   => $row['Mensaje'],
                            'nombrereceta'   => $row['nombrereceta'],
                            'usuario'   => $row['usuario'],
                            'favorito'  => $row['favorito']
                        );
                        
                        array_push($items, $item);
                    }
                    
                    //var_dump($items);
                }
    
            }catch(PDOException $e){
                $items = array(0);
            }
    
            return $items;
        }

        function getStateFav($usuario, $nombrereceta){
            $items = [];
            
            try{
                
                //$sql = "SELECT favorito FROM favorito WHERE usuario = '".$usuario."' and nombrereceta = '".$nombrereceta."'";
                $sql = "select favorito from favorito
                        where nombrereceta = '".$nombrereceta."' and usuario = '".$usuario."'";
                $connection = $this->db->connect();
    
                $query = $connection->prepare($sql);
                


                $query->execute();
                
                if($query->rowCount() > 0){
                    
                    while($row = $query->fetch()){
                        //$item = $row;
                        
                        $item = array(
                            'favorito'  => $row['favorito']
                        );
                        
                        array_push($items, $item);
                    }
                    
                    //var_dump($items);
                }
    
            }catch(PDOException $e){
                $items = array(0);
            }
    
            return $items;
        }
      
    }
?>