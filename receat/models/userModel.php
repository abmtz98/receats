<?php 

class UserModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function signup($data){
        $result;

        try{
            //$sql = "CALL sp_signup( :email, :password, :username, :name, :lastname01, :lastname02, :phone, :image)";
            
            
            $sql = 
                "INSERT INTO usuarios
                SET
                email       = :email,
                passw       = :passw,
                usuario     = :usuario,
                img         = :img";
            
 
            $connection = $this->db->connect();

            //$query = $connection->query($sql);

            $query = $connection->prepare($sql);

            if($query->execute($data)){
                $dataLogin = array(
                    'email'    => $data['email'], 
                    'passw' => $data['passw']
                );

                $result = $this->login($dataLogin);
            }

        }catch(PDOException $e){
            echo $e;
            $result = array(0);
        }

        return $result;
    
    }

    public function login($data){
        $result;

        try{
            //$sql = "CALL sp_login( :email, :password)";
            
            
            $sql = 
                "SELECT _id, usuario, email, passw, img
                FROM usuarios 
                WHERE email = :email AND passw = :passw;";
            
            
            $connection = $this->db->connect();
            $query = $connection->prepare($sql);
            $query->execute($data);

            if($query->rowCount() > 0){
               
                $row = $query->fetch();

                $user = array(
                    '_id'         => $row['_id'],
                    'email'      => $row['email'],
                    'passw'   => $row['passw'],
                    'usuario'   => $row['usuario'],
                    'img'      => $row['img'],
                );

                $result = $user;
            }else{
                $result = array(0);
            }

        }catch(PDOException $e){
            $result = array(0);
        }

        return $result;
    
    }

    public function check_user($data2){
        $result;

        try{
            $sql = "CALL sp_check_user( :email)";
            $connection = $this->db->connect();
            $query = $connection->prepare($sql);
            $query->execute($data2);

            if($query->rowCount() > 0){
                $result = 1;
            }else{
                $result = 0;
            }

        }catch(PDOException $e){
            $result = 1;
        }
        //echo json_encode($response);
        return $result;
    
    }

    

}

?>