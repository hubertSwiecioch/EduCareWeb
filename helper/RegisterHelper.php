<?php

/**
 *
 * @author hswie
 */
class RegisterHelper {
   
    private $username;
    private $password;
    private $displayname;
    
    public function RegisterHelper($username, $password, $displayname){
        
        $this->username = $username;
        $this->password = $password;
        $this->displayname = $displayname;
        
    }
    
    public function Register(){
       
        require('conf/config.php');
        
        if(empty($this->username)||empty($this->password)||empty($this->displayname)){
        
		$response["success"] = 0; 
			    		
        $response["message"] = "All Fields Required";
                
        die(json_encode($response));
    }
	
    
    $query = "SELECT COUNT(*) AS count 
				   FROM carer 
				   WHERE 
				   carer_username = :user";
    
    
    $query_params = array(
        ':user' => $this->username
    ); 
    
    try{
       
        $stmt = $db->prepare($query);
		
        $result = $stmt->execute($query_params);
		
		
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$username_count = $row["count"];
		
		}
			
			if ($username_count > 0) {
			
				
				$response["success"] = 0;
				$response["message"] = "That username is already taken. Please try again.";
				
				die(json_encode($response));
				
		}

		
    }catch(PDOException $ex){
        
		
        $response["success"] = 0;
        $response["message"] = "Something went wrong. Please try again later";

		
        die(json_encode($response));
        
    }
   
	
    $query = "INSERT INTO 
					carer (carer_username, carer_password, carer_full_name) 
					VALUES 
					(:user, :pass, :displayname)";
    
    
    $encr_user_pass = sha1($this->password);
    
    
    
    $query_params = array(
        ':user' => $this->username,
		':pass' =>  $encr_user_pass,
		':displayname' => $this->displayname
    );
    
    
    try {
        $stmt = $db->prepare($query);
        $result = $stmt->execute($query_params);
               
    } catch (PDOException $ex) {
       
        $response["success"] = 0;
        $response["message"] = "The username is already in use, please try again later!";

        die(json_encode($response));
    }
	
    $response["success"] = 1;
    $response["message"] = "Username Successfully Added";
	
    echo json_encode($response);
        
    }
}
