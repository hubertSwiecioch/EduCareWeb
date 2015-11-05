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

    $username = "18632831_edu"; 
    $password = "gnVRyuXXYndEZOutsKh6"; 
    $host = "serwer1552055.home.pl"; 
    $dbname = "18632831_edu"; 

    /***  check the file is less than the maximum file size ***/
    if($_FILES['userfile']['size'] < $maxsize )
        {
        /*** connect to db ***/
        
        $dbh = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password, $options); 

                /*** set the error mode ***/
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            /*** our sql query ***/
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
        /*** throw an exception is image is not of type ***/
        throw new Exception("File Size Error");
        }
    }
else
    {
    // if the file is not less than the maximum allowed, print an error
    throw new Exception("Unsupported Image Format!");
    }
}

function getPhoto(){
    
    $username = "18632831_edu"; 
    $password = "gnVRyuXXYndEZOutsKh6"; 
    $host = "serwer1552055.home.pl"; 
    $dbname = "18632831_edu"; 
    $id = 28;
   
    try    {
          
          $dbh = new PDO("mysql:host=localhost;dbname=testblob", 'username', 'password');
          $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $sql = "SELECT image_type, image_size, image_name FROM testblob WHERE image_id=".$image_id;

          
          $stmt = $dbh->prepare($sql);
                 $stmt->execute(); 

          $stmt->setFetchMode(PDO::FETCH_ASSOC);

          $array = $stmt->fetch();
          if(sizeof($array) === 3)
              {
              echo '<p>This is '.$array['image_name'].' from the database</p>';
              echo '<img '.$array['image_size'].' src="showfile.php?image_id='.$image_id.'">';
              }
          else
              {
              throw new Exception("Out of bounds error");
              }
          }
       catch(PDOException $e)
          {
          echo $e->getMessage();
          }
       catch(Exception $e)
          {
          echo $e->getMessage();
          }
      }
  
?>