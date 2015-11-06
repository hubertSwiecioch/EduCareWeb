<?php


/**
 *
 * @author hswie
 */
class ImageHelper {
   
  

public function uploadPhoto(){
    
    require('conf/config.php');
    
    /*** check if a file was uploaded ***/
    if(is_uploaded_file($_FILES['userfile']['tmp_name']) && getimagesize($_FILES['userfile']['tmp_name']) != false)
    {
    /***  get the image info. ***/
    $size = getimagesize($_FILES['userfile']['tmp_name']);
    /*** assign our variables ***/
    $type = $size['mime'];
    $imgfp = fopen($_FILES['userfile']['tmp_name'], 'rb');
    $size = $size[3];
    $name = $_FILES['userfile']['name'];
    $maxsize = 99999999;

//    $username = "18632831_edu"; 
//    $password = "gnVRyuXXYndEZOutsKh6"; 
//    $host = "serwer1552055.home.pl"; 
//    $dbname = "18632831_edu"; 

    /***  check the file is less than the maximum file size ***/
    if($_FILES['userfile']['size'] < $maxsize )
        {
        /*** connect to db ***/
        
        $dbh = $db;

        /*** set the error mode ***/
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $dbh->prepare("INSERT INTO images (image_type ,image, image_size, image_name) VALUES (? ,?, ?, ?)");

        /*** bind the params ***/
        $stmt->bindParam(1, $type);
        $stmt->bindParam(2, $imgfp, PDO::PARAM_LOB);
        $stmt->bindParam(3, $size);
        $stmt->bindParam(4, $name);

        /*** execute the query ***/
        $stmt->execute();
        }
        else
        {
        throw new Exception("File Size Error");
        }
    }
else
    {
    throw new Exception("Unsupported Image Format!");
    }
}

function getPhoto($id){
    require('conf/config.php');
    
    try{
    $mysqli = new mysqli($host,$username,$password,$dbname);
    $sql = "SELECT * FROM images WHERE image_id ='$id' ";
    $results =$mysqli->query($sql);

    $spots = array();  //array to parse jason from

    while($spot = $results->fetch_assoc()){
        $spots[] = $spot;                                                           
    }

    echo json_encode($spots);
    }catch (PDOException $ex) {
    }
    
    }       
 }


