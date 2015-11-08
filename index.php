<?php

require 'helper/AuthenticationHelper.php';
require 'helper/RegisterHelper.php';
require 'helper/DatabaseHelper.php';

      class Index{
           public static function main(){
               
                if(!empty($_FILES)){
                    
                    $target_path  = "./images/residentsImages/";
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
                    
                    elseif ($_POST['mod'] == "Register") {
                        
                     $register = new RegisterHelper($_POST['username'], $_POST['password'], $_POST['displayname']);
                     $register->Register();
                    }
                    
                    elseif ($_POST['mod'] == "getResidentsList") {                  
                        
                        $databaseHelper = new DatabaseHelper();
                        $databaseHelper->getResidentsList();
                    
                    }
                    
                    elseif ($_POST['mod'] == "getCarersList") {
                      
                        $databaseHelper = new DatabaseHelper();
                        $databaseHelper->getCarersList();
                    
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
                <?php
                }
           }
      }
      Index::main();
?>
