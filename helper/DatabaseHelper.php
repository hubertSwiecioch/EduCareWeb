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
            echo(json_encode($carerrray));
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
}
