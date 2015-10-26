<?php

require('EduCare/conf/config.php');

if(!empty($_POST)){

 
    if(empty($_POST['username'])||empty($_POST['password'])||empty($_POST['displayname'])){
        
		$response["success"] = 0; 
			    		
        $response["message"] = "All Fields Required";
                
        die(json_encode($response));
    }
	
    
    $query = "SELECT COUNT(*) AS count 
				   FROM users 
				   WHERE 
				   user_username = :user";
    
    
    $query_params = array(
        ':user' => $_POST['username']
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
					users (user_username, user_password, user_displayname) 
					VALUES 
					(:user, :pass, :displayname)";
    
    
    $encr_user_pass = md5($_POST['password']);
    
    
    
    $query_params = array(
        ':user' => $_POST['username'],
		':pass' =>  $encr_user_pass,
		':displayname' => $_POST['displayname']
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
        
}else{
    ?>

<h1>Register</h1>
<form action="register.php" method="post">
    Username: <br/>
    <input type="text" name="username" placeholder="Username"/><br/>
    Password: <br/>
    <input name="password" type="password" placeholder="Password"/><br/>
    Display Name: <br/>
    <input type="text" name="displayname" placeholder="Display Name"/><br/>
    <input type="submit" value="Register User"/>
</form>
<?php
}

?>