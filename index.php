<?php

require 'helper/AuthenticationHelper.php';
require 'helper/RegisterHelper.php';
require 'helper/DatabaseHelper.php';

      class Index{
           public static function main(){
               
                if(!empty($_FILES)){
                    
                   
                    function parseRequestHeaders() {
                    $headers = array();
                    foreach($_SERVER as $key => $value) {
                        if (substr($key, 0, 5) <> 'HTTP_') {
                            continue;
                        }
                        $header = str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))));
                        $headers[$header] = $value;
                    }
                    return $headers;
                    }
                    
                    $headers = parseRequestHeaders();

                    foreach ($headers as $header => $value) {
                        echo "$header: $value <br />\n";
                        if ($value == 'resident'){                           
                            $target_path  = "./images/residentsImages/";
                        }
                        
                        if ($value == 'carer'){                        
                            $target_path  = "./images/carersImages/";
                        }  
                    }
                    
                     

                                       
                     
                    $target_path = $target_path . basename( $_FILES['uploadedfile']['name']);
                    if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) 
                    {
                        echo "The file ".  basename( $_FILES['uploadedfile']['name']).
                     " has been uploaded";
                    } 
                    else
                    {
                        echo "There was an error uploading the file, please try again!";
                    }
                
                }
               
                if(!empty($_POST)){
                   
                    if($_POST['mod'] == 'LogIn'){
                        
                        $authentication = new AuthenticationHelper($_POST['username'], $_POST['password']);
                        if(!empty($_POST['onlineTestTime'])){
                            
                            $authentication->setOnlineTime($_POST['onlineTestTime']);
                        }
                        $authentication->Login();
                    }
                    
                    elseif ($_POST['mod'] == "registerCarer") {
                        
                       $databaseHelper = new DatabaseHelper();
                       $databaseHelper->registerCarer($_POST['carer_username'],$_POST['carer_password'], $_POST['carer_full_name'],
                               $_POST['image'], $_POST['phone_number']);
                        
                    }
                    
                    elseif ($_POST['mod'] == "registerFamily") {
                        
                       $databaseHelper = new DatabaseHelper();
                       $databaseHelper->registerFamily($_POST['familyUsername'], $_POST['familyPassword'], $_POST['familyFullName'],
                               $_POST['residentID'], $_POST['phonenumber']);
                        
                    }
                    
                    elseif ($_POST['mod'] == "getResidentsList") {                  
                        
                        $databaseHelper = new DatabaseHelper();
                        $databaseHelper->getResidentsList();
                    
                    }
                    
                    elseif ($_POST['mod'] == "getCarersList") {
                      
                        $databaseHelper = new DatabaseHelper();
                        $databaseHelper->getCarersList();
                    
                    }
                    
                    elseif ($_POST['mod'] == "getCarerTasks") {
                      
                        $databaseHelper = new DatabaseHelper();
                        $databaseHelper->getCarerTasks($_POST['carerID']);
                    
                    }
                    
                    elseif ($_POST['mod'] == "setTaskIsDone") {
                      
                        $databaseHelper = new DatabaseHelper();
                        $databaseHelper->setTaskIsDone($_POST['ID'],$_POST['isDone'] );
                    
                    }                                  
                    elseif ($_POST['mod'] == "addTask") {
                      
                        $databaseHelper = new DatabaseHelper();
                        $databaseHelper->addTask($_POST['carerID'], $_POST['residentID'], $_POST['header'],
                                                 $_POST['date'], $_POST['description']);
                    
                    }
                    
                    elseif ($_POST['mod'] == "getCarerMessages") {
                      
                        $databaseHelper = new DatabaseHelper();
                        $databaseHelper->getCarerMessages($_POST['carerID']);
                    
                    }
                    
                    elseif ($_POST['mod'] == "addCarerMessage") {
                      
                        $databaseHelper = new DatabaseHelper();
                        $databaseHelper->addCarerMessage($_POST['content'], $_POST['sendDate'], $_POST['isRead'],
                                                 $_POST['senderID'], $_POST['title'], $_POST['targetID']);
                    
                    }
                    
                     elseif ($_POST['mod'] == "setIsReadMessage") {
                      
                        $databaseHelper = new DatabaseHelper();
                        $databaseHelper->setIsReadMessage($_POST['messageID'],$_POST['isRead'] );
                    
                    } 
                    
                    elseif ($_POST['mod'] == "addResident") {
                      
                        $databaseHelper = new DatabaseHelper();
                        $databaseHelper->addResident($_POST['firstname'],$_POST['lastname'],$_POST['dateofadoption'],
                                $_POST['birthdate'],$_POST['address'],
                                $_POST['city'],$_POST['image']);
                    
                    }
                    
                    
                    
                    elseif ($_POST['mod'] == "RegisterBrowser") {
                        ?>
                            <h1>Register</h1>
                            <form action="index.php" method="post">
                                <input type='hidden' name='mod' value='Register'/>
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
                    
                }else{
                ?>
                <h1>Login</h1>
                <form action="index.php" method="post">
                    <input type='hidden' name='mod' value='LogIn'/>
                    Username: <br/>
                    <input type="text" name="username" placeholder="Username"/><br/>
                    Password:<br/>
                    <input type="password" name="password" placeholder="Password"/><br/><br/>
                    <input type="submit" value="Login"/>       
                </form>
                
                 <form action="index.php" method="post">
                    <input type='hidden' name='mod' value='RegisterBrowser'/>
                    <input type="submit" value="Register"/>   
                </form>
                
                 <form action="index.php" method="post">
                    <input type='hidden' name='mod' value='getResidentsList'/>
                    <input type="submit" value="ResidentList"/>   
                </form>
                
                 <form action="index.php" method="post">
                    <input type='hidden' name='mod' value='getCarersList'/>
                    <input type="submit" value="CarerList"/>   
                </form>
                
                <form action="index.php" method="post">
                    <input type='hidden' name='mod' value='addResident'/>
                    <input type="submit" value="Add resident"/>   
                </form>
                 <form action="index.php" method="post">
                    <input type='hidden' name='mod' value='getCarerTasks'/>
                    <input type="submit" value="Get carer tasks"/>   
                </form>
                <?php
                }
           }
      }
      Index::main();
?>
