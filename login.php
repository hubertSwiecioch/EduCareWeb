<?php

require('conf/config.php');


if(!empty($_POST)){
    
	
    if(empty($_POST['username'])||empty($_POST['password'])){
	
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
        ':user' => $_POST['username']
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
    
    $encr_user_pass = md5($_POST['password']);
    
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
    
}else{
?>
<h1>Login</h1>
<form action="login.php" method="post">
    Username: <br/>
    <input type="text" name="username" placeholder="Username"/><br/>
    Password:<br/>
    <input type="password" name="password" placeholder="Password"/><br/>
    <input type="submit" value="Login"/>
    <a href="helper/register.php">Register</a>
</form>
<?php
}
?>

