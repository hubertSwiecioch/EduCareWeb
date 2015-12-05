<?php

/**
 *
 * @author hswie
 */
class DatabaseHelper {
    
   public function getResidentsList(){
        
        require('conf/config.php');
       
        try {
            // Create connection
           $connection = new mysqli($host, $username, $password, $dbname);
           // Check connection
           if ($connection->connect_error) {
               die("Connection failed: " . $connection->connect_error);
           } 
           
          $sql = "SELECT * FROM resident";
          $residentrray = array();
          if($result = $connection->query($sql)){
          
            while($row = $result->fetch_array(MYSQL_ASSOC)){
            $residentrray[] = $row;
            }          
            echo(json_encode($residentrray));
          }
          
        } catch (PDOException $ex) {
	
		
        $response['success'] = 0 ;
        $response['message'] = "Database Error1, Please try Again";
        die(json_encode($response));
       
        }
        $result->close();
        $connection->close();
    }
    
    public function getCarersList(){
        
        require('conf/config.php');
       
        try {
            // Create connection
           $connection = new mysqli($host, $username, $password, $dbname);
           // Check connection
           if ($connection->connect_error) {
               die("Connection failed: " . $connection->connect_error);
           } 
           
          $sql = "SELECT * FROM carer";
          $carerrray = array();
         
           if($result = $connection->query($sql)){
          
            while($row = $result->fetch_array(MYSQL_ASSOC)){
            $carerrray[] = $row;
            }          
          }
            
          die(json_encode($carerrray));
          
        } catch (PDOException $ex) {
	
		
        $response['success'] = 0 ;
        $response['message'] = "Database Error1, Please try Again";
        die(json_encode($response));
       
        }
        $result->close();
        mysqli_close($connection);
    }
    
    public function getFamilyList(){
        
        require('conf/config.php');
       
        try {
            // Create connection
           $connection = new mysqli($host, $username, $password, $dbname);
           // Check connection
           if ($connection->connect_error) {
               die("Connection failed: " . $connection->connect_error);
           } 
           
          $sql = "SELECT * FROM family";
          $carerrray = array();
         
           if($result = $connection->query($sql)){
          
            while($row = $result->fetch_array(MYSQL_ASSOC)){
            $carerrray[] = $row;
            }          
          }
            
          die(json_encode($carerrray));
          
        } catch (PDOException $ex) {
	
		
        $response['success'] = 0 ;
        $response['message'] = "Database Error1, Please try Again";
        die(json_encode($response));
       
        }
        $result->close();
        mysqli_close($connection);
    }
    
    public function getCarerTasks($carerID){
        
        require('conf/config.php');
       
        try {
            // Create connection
           $connection = new mysqli($host, $username, $password, $dbname);
           // Check connection
           if ($connection->connect_error) {
               die("Connection failed: " . $connection->connect_error);
           } 
           
          $sql = "SELECT * FROM task 
                  WHERE carer_ID = '$carerID' AND is_done = '0'";
          $taskarrary = array();
         
           if($result = $connection->query($sql)){
          
            while($row = $result->fetch_array(MYSQL_ASSOC)){
            $taskarrary[] = $row;
            }          
          }
            
          die(json_encode($taskarrary));
          
        } catch (PDOException $ex) {
	
		
        $response['success'] = 0 ;
        $response['message'] = "Database Error1, Please try Again";
        die(json_encode($response));
       
        }
        $result->close();
        mysqli_close($connection);
    }
    
       public function getCarerMessages($carerID){
        
        require('conf/config.php');
       
        try {
            // Create connection
           $connection = new mysqli($host, $username, $password, $dbname);
           // Check connection
           if ($connection->connect_error) {
               die("Connection failed: " . $connection->connect_error);
           } 
           
          $sql = "SELECT * FROM carer_message 
                  WHERE target_ID = '$carerID'";
          $messagearrary = array();
         
           if($result = $connection->query($sql)){
          
            while($row = $result->fetch_array(MYSQL_ASSOC)){
            $messagearrary[] = $row;
            }          
          }
            
          die(json_encode($messagearrary));
          
        } catch (PDOException $ex) {
	
		
        $response['success'] = 0 ;
        $response['message'] = "Database Error1, Please try Again";
        die(json_encode($response));
       
        }
        $result->close();
        mysqli_close($connection);
    }
    
    public function addCarerMessage($content, $sendDate, $senderID, $title, $targetID){
        
        require('conf/config.php');
       
        try {
            // Create connection
           $connection = new mysqli($host, $username, $password, $dbname);
           // Check connection
           if ($connection->connect_error) {
               die("Connection failed: " . $connection->connect_error);
           } 
               
          
          $sql = "INSERT INTO carer_message (content, send_date, sender_ID, title, target_ID)
            VALUES ('$content', '$sendDate','$senderID', '$title', '$targetID')";

            if ($connection->query($sql) === TRUE) {
               $response['success'] = 1 ;
               $response['message'] = "INSERT_SUCCESS";
                die(json_encode($response));
            } else {
                $response['success'] = 0 ;
               $response['message'] = "Database Error1, Please try Again";
                die(json_encode($response));
            }
         
          
        } catch (PDOException $ex) {
	
		
        $response['success'] = 0 ;
        $response['message'] = "Database Error1, Please try Again";
        die(json_encode($response));
       
        }
        $result->close();
        mysqli_close($connection);
    }
    
    public function setIsReadMessage($messageID, $isRead){
        
        require('conf/config.php');
       
        try {
            // Create connection
           $connection = new mysqli($host, $username, $password, $dbname);
           // Check connection
           if ($connection->connect_error) {
               die("Connection failed: " . $connection->connect_error);
           } 
               
          
          $sql = "UPDATE carer_message
                 SET is_read = '$isRead'
                 WHERE ID= '$messageID'";

            if ($connection->query($sql) === TRUE) {
               $response['success'] = 1 ;
               $response['message'] = "UPDATE_SUCCESS";
                die(json_encode($response));
            } else {
                $response['success'] = 0 ;
               $response['message'] = "Database Error1, Please try Again";
                die(json_encode($response));
            }
         
          
        } catch (PDOException $ex) {
	
		
        $response['success'] = 0 ;
        $response['message'] = "Database Error1, Please try Again";
        die(json_encode($response));
       
        }
        $result->close();
        mysqli_close($connection);
    }
    
    public function addResident($first_name, $last_name, $date_of_adoption, 
                                $birth_date,$address, $city, $image){
        
        require('conf/config.php');
       
        try {
            // Create connection
           $connection = new mysqli($host, $username, $password, $dbname);
           // Check connection
           if ($connection->connect_error) {
               die("Connection failed: " . $connection->connect_error);
           } 
               
          
          $sql = "INSERT INTO resident (first_name, last_name, date_of_adoption, birth_date, address, city, image)
            VALUES ('$first_name', '$last_name', '$date_of_adoption','$birth_date', '$address', '$city', '$image')";

            if ($connection->query($sql) === TRUE) {
               $response['success'] = 1 ;
               $response['message'] = "INSERT_SUCCESS";
                die(json_encode($response));
            } else {
                $response['success'] = 0 ;
               $response['message'] = "Database Error1, Please try Again";
                die(json_encode($response));
            }
         
          
        } catch (PDOException $ex) {
	
		
        $response['success'] = 0 ;
        $response['message'] = "Database Error1, Please try Again";
        die(json_encode($response));
       
        }
        $result->close();
        mysqli_close($connection);
    }
    
    
    public function setTaskIsDone($taskID, $isDone){
        
        require('conf/config.php');
       
        try {
            // Create connection
           $connection = new mysqli($host, $username, $password, $dbname);
           // Check connection
           if ($connection->connect_error) {
               die("Connection failed: " . $connection->connect_error);
           } 
               
          
          $sql = "UPDATE task
                 SET is_done= '$isDone'
                 WHERE ID= '$taskID'";

            if ($connection->query($sql) === TRUE) {
               $response['success'] = 1 ;
               $response['message'] = "UPDATE_SUCCESS";
                die(json_encode($response));
            } else {
                $response['success'] = 0 ;
               $response['message'] = "Database Error1, Please try Again";
                die(json_encode($response));
            }
         
          
        } catch (PDOException $ex) {
	
		
        $response['success'] = 0 ;
        $response['message'] = "Database Error1, Please try Again";
        die(json_encode($response));
       
        }
        $result->close();
        mysqli_close($connection);
    }
    
    public function registerCarer($carer_username, $carer_password, $displayname,$image,$phonenumber){
       
        require('conf/config.php');
       
        try {
            // Create connection
           $connection = new mysqli($host, $username, $password, $dbname);
           // Check connection
           if ($connection->connect_error) {
               die("Connection failed: " . $connection->connect_error);
           } 
           
           $encr_user_pass = sha1($carer_password);
               
          
          $sql = "INSERT INTO carer (carer_username, carer_password, carer_full_name, image, phone_number)
            VALUES ('$carer_username', '$encr_user_pass', '$displayname','$image', '$phonenumber')";

            if ($connection->query($sql) === TRUE) {
               $response['success'] = 1 ;
               $response['message'] = "INSERT_SUCCESS";
                die(json_encode($response));
            } else {
                $response['success'] = 0 ;
               $response['message'] = "Database Error1, Please try Again";
                die(json_encode($response));
            }
         
          
        } catch (PDOException $ex) {
	
		
        $response['success'] = 0 ;
        $response['message'] = "Database Error1, Please try Again";
        die(json_encode($response));
       
        }
        $result->close();
        mysqli_close($connection);
    }
    
    public function registerFamily($family_username, $family_password, $family_fullname, $resident_ID,$phonenumber){
       
        require('conf/config.php');
       
        try {
            // Create connection
           $connection = new mysqli($host, $username, $password, $dbname);
           // Check connection
           if ($connection->connect_error) {
               die("Connection failed: " . $connection->connect_error);
           } 
           
           $encr_user_pass = sha1($family_password);
               
          
          $sql = "INSERT INTO carer (family_username, family_password, family_full_name, resident_ID, phone_number)
            VALUES ('$family_username', '$encr_user_pass', $family_fullname', '$resident_ID', '$phonenumber')";

            if ($connection->query($sql) === TRUE) {
               $response['success'] = 1 ;
               $response['message'] = "INSERT_SUCCESS";
                die(json_encode($response));
            } else {
                $response['success'] = 0 ;
               $response['message'] = "Database Error1, Please try Again";
                die(json_encode($response));
            }
         
          
        } catch (PDOException $ex) {
	
		
        $response['success'] = 0 ;
        $response['message'] = "Database Error1, Please try Again";
        die(json_encode($response));
       
        }
        $result->close();
        mysqli_close($connection);
    }
}
