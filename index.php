<?php

require('helper/AuthenticationHelper.php');

 //index.php
      class Index{
           public static function main(){
               
                if(!empty($_POST)){
                    if($_POST['mod'] == 'LogIn'){
                        
                        $authentication = new AuthenticationHelper($_POST['username'], $_POST['password']);
                        $authentication->Login();
                    }
                }else{
                ?>
                <h1>Login</h1>
                <form action="index.php" method="post">
                    <input type='hidden' name='mod' value='LogIn'/>
                    Username: <br/>
                    <input type="text" name="username" placeholder="Username"/><br/>
                    Password:<br/>
                    <input type="password" name="password" placeholder="Password"/><br/>
                    <input type="submit" value="Login"/>
                    <a href="helper/register.php">Register</a>
                </form>
                <?php
                }
           }
      }
      Index::main();
?>
