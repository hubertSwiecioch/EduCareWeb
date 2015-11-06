<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

  <html>
  <head><title>File Upload To Database</title></head>
  <body>
  <h2>Please Choose a File and click Submit</h2>
  <form enctype="multipart/form-data" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="post">
  <input type="hidden" name="MAX_FILE_SIZE" value="99999999" />
  <div><input name="userfile" type="file" /></div>
  <div><input type="submit" value="Submit" /></div>
  </form>

</body></html>
<?php
/*** check if a file was submitted ***/
if(!isset($_FILES['userfile']))
    {
    echo '<p>Please select a file</p>';
    }
else
    {
    try    {
        upload();
        /*** give praise and thanks to the php gods ***/
        echo '<p>Thank you for submitting</p>';
        getPhoto();
        }
    catch(Exception $e)
        {
        echo '<h4>'.$e->getMessage().'</h4>';
        }
    }

function upload(){
    
        $filePath = '/EduCare/images/avatar.png';
        $mime = 'image/gif';
        $id = 2;
                
        $blob = fopen($filePath,'rb');

         $sql = "UPDATE images
         SET mime = :mime,
         data = :data
         WHERE ID = :id";
         
        $username = "18632831_edu"; 
        $password = "gnVRyuXXYndEZOutsKh6"; 
        $host = "serwer1552055.home.pl"; 
        $dbname = "18632831_edu"; 

        $connection = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password, $options); 
    
         $stmt = $connection->prepare($sql);

         $stmt->bindParam(':mime',$mime);
         $stmt->bindParam(':data',$blob,PDO::PARAM_LOB);
         $stmt->bindParam(':id',$id);

         return $stmt->execute();
}

function getPhoto(){
    
    $username = "18632831_edu"; 
    $password = "gnVRyuXXYndEZOutsKh6"; 
    $host = "serwer1552055.home.pl"; 
    $dbname = "18632831_edu"; 
    $id = 1;
   
     $connection = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password, $options); 


    $sql = "SELECT mime,
            data
            FROM images
            WHERE ID = :id";
            $stmt = $connection->prepare($sql);
            $stmt->execute(array(":id" => $id));
            $stmt->bindColumn(1, $mime);
            $stmt->bindColumn(2, $data, PDO::PARAM_LOB);

            $stmt->fetch(PDO::FETCH_BOUND);
            $photo = array("mime" => $mime,"image" => base64_encode($data));
             
            echo(json_encode($photo));
    }
