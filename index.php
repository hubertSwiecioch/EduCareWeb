<?php

require 'helper/AuthenticationHelper.php';
require 'helper/RegisterHelper.php';

      class Index{
           public static function main(){
               
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
                <?php
                }
           }
      }
      Index::main();
?>
