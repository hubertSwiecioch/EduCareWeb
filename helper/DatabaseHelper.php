<?php

/**
 *
 * @author hswie
 */
class DatabaseHelper {
    
    private function createConnection(){
        
        require('conf/config.php');
        
         // Create connection
                $connection = new mysqli($host, $username, $password, $dbname);
                $connection -> query ('SET NAMES utf8');
                $connection -> query ('SET CHARACTER_SET utf8_unicode_ci');
        
        // Check connection
           if ($connection->connect_error) {
               die("Connection failed: " . $connection->connect_error);
           } 
           
           
           return $connection;
    }


    public function getResidentsList(){
        
        try {
           $connection = $this->createConnection();
           
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
        
    
        try {
          
          $connection = $this->createConnection();
           
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
         
        try {
            
           $connection = $this->createConnection();
           
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
        
       
       
        try {
          
            $connection = $this->createConnection();
           
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
   
        try {
            
          $connection = $this->createConnection();
           
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
        
       
        try {
            
           $connection = $this->createConnection();
               
          
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
        
        
        try {
          
          $connection = $this->createConnection();
          
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
        
     
        try {
         
          $connection = $this->createConnection();
            
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
    
    public function updateResident($residentID, $first_name, $last_name, $date_of_adoption, 
                                $birth_date,$address, $city, $image){
        
        try {
            
          $connection = $this->createConnection();
          
          $sql = "UPDATE resident
                 SET first_name = '$first_name', last_name = '$last_name', date_of_adoption = '$date_of_adoption',
                                        birth_date = '$birth_date', address = '$address', city = '$city', image = '$image', 
                 WHERE ID= '$residentID'";

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
    
    public function removeResident($residentID){
        
         try {
            
          $connection = $this->createConnection();
          
          $sql = "DELETE from resident
                  WHERE ID = '$residentID'";

            if ($connection->query($sql) === TRUE) {
               $response['success'] = 1 ;
               $response['message'] = "REMOVE_SUCCESS";
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
        
        try {
            
          $connection = $this->createConnection();
          
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
       
        try {
           
           $connection = $this->createConnection();
           
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
    
    public function updateCarer($carerID, $carer_username, $carer_password, $displayname,$image,$phonenumber){
        
        try {
            
          $connection = $this->createConnection();
          
           $encr_user_pass = sha1($carer_password);
          
          $sql = "UPDATE carer
                 SET carer_username = '$carer_username', carer_password = '$encr_user_pass', carer_full_name = '$displayname',
                                        image = '$image', phone_number = '$phonenumber'
                 WHERE ID= '$carerID'";

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
    
    public function removeCarer($carerID){
        
         try {
            
          $connection = $this->createConnection();
          
          $sql = "DELETE from carer
                  WHERE ID = '$carerID'";

            if ($connection->query($sql) === TRUE) {
               $response['success'] = 1 ;
               $response['message'] = "REMOVE_SUCCESS";
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
    
    
    
    public function registerFamily($family_username, $family_password, $family_fullname, $resident_ID, $phonenumber){
       
        
        try {
           $connection = $this->createConnection();
           
           $encr_user_pass = sha1($family_password);
               
          
          $sql = "INSERT INTO family (family_username, family_password, family_full_name, resident_ID, phone_number)
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
    
    public function updateFamily($familyID, $family_username, $family_password, $family_fullname, $resident_ID, $phonenumber){
        
        try {
            
          $connection = $this->createConnection();
          
          $encr_user_pass = sha1($family_password);
          
          $sql = "UPDATE family
                 SET family_username = '$family_username', family_full_name = '$family_fullname', family_password = '$encr_user_pass', resident_ID = '$resident_ID',
                                        phone_number = '$phonenumber'
                 WHERE ID= '$familyID'";

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
    
    public function removeFamily($familyID){
        
         try {
            
          $connection = $this->createConnection();
          
          $sql = "DELETE from family
                  WHERE ID = '$familyID'";

            if ($connection->query($sql) === TRUE) {
               $response['success'] = 1 ;
               $response['message'] = "REMOVE_SUCCESS";
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
    
    public function addMedicine($name, $dose, $residentID, $startDate, $endDate,$carerID){
        
       
        try {
            
           $connection = $this->createConnection();
               
          
          $sql = "INSERT INTO prescribed_medicines (name, dose, resident_ID, start_date, end_date, carer_ID)
            VALUES ('$name', '$dose','$residentID', '$startDate', '$endDate', '$carerID')";

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
    
    public function updateMedicine($medicineID, $name, $dose, $residentID, $startDate, $endDate,$carerID){
        
        try {
            
          $connection = $this->createConnection();
          
          $sql = "UPDATE prescribed_medicines
                 SET name= '$name',dose= '$dose',resident_ID = '$residentID',start_date= '$startDate',end_date= '$endDate',
                     carer_ID= '$carerID',
                 WHERE ID= '$medicineID'";

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
    
    public function removeMedicine($medicineID){
        
         try {
            
          $connection = $this->createConnection();
          
          $sql = "DELETE from prescribed_medicines
                  WHERE ID = '$medicineID'";

            if ($connection->query($sql) === TRUE) {
               $response['success'] = 1 ;
               $response['message'] = "REMOVE_SUCCESS";
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
