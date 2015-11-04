<?php

/**
 * 
 * @author hswie
 */
class AuthenticationHelper {
    
    private $username;
    private $password;
    
    public function AuthenticationHelper($usr, $pass){
        
        $this->username = $usr;
        $this->password = $pass;
    }
    
    public function Login(){
        require('conf/config.php');
       
        if(empty($this->username)||empty($this->password)){
	
	    $response["success"] = 0;
		
            $response["message"] = "All Fields Required";
		
		
        die(json_encode($response));
    }
	
    $query = "
            SELECT * FROM `carer` 
            WHERE
            carer_username = :user
             ";
			 
    $query_params = array(
        ':user' => $this->username
    );
	
    try {
		
        $stmt = $db->prepare($query);
		
        $result = $stmt->execute($query_params);
    } catch (PDOException $ex) {
	
		
        $response['success'] = 0 ;
        $response['message'] = "Database Error1, Please try Again";
        die(json_encode($response));
    }
	
	$is_login = false;
    
    $encr_user_pass = sha1($this->password);
    
	$row = $stmt->fetch();
	
    if ($row){
        
        if($encr_user_pass === $row['carer_password']){
			
            $is_login = true;
        }
    }
    

    if($is_login){
		
        $response["success"] = 1;
        $response["message"] = "Login Successful";
	
        die(json_encode($response));
    }else{
	
        $response["success"] = 0;
        $response["message"] = "username or password Incorrect";
		
        die(json_encode($response));
    }
}
    
}
