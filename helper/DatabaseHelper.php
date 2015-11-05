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

          $result = mysqli_query($connection, $sql) or die("Error in Selecting " . mysqli_error($connection));
          
           $carertrray = array();
            while($row =  mysqli_fetch_assoc($result))
            {
            $carerrray[] = $row;
            }
            
          die(json_encode($carerrray));
          
        } catch (PDOException $ex) {
	
		
        $response['success'] = 0 ;
        $response['message'] = "Database Error1, Please try Again";
        die(json_encode($response));
       
        }
        mysqli_close($connection);
    }
}
