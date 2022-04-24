
<?php session_start(); ?>
<?php 
if('D:\\textfiles'){opendir('D:/textfiles');}else{mkdir("D:\\textfiles",0700);}
if("D:\\pdffiles"){opendir("D:/pdffiles");}else{mkdir("D:\\pdffiles",0700);}
if("D:\\tsvfiles"){opendir("D:/tsvfiles");}else{mkdir("D:\\tsvfiles");}
if("D:\\hocrfiles"){opendir("D:/hocrfiles");}else{mkdir("D:\\hocrfiles");}
if("D:\\images"){opendir("D:/images");}else{mkdir("D:\\images");}
?>
<?php
if(isset($_POST["submit"]) ){
  $image=$_FILES["image"]["name"];
  $imgname=basename($_FILES["image"]["name"]);
$target="D:\\images\\".basename($_FILES["image"]["name"]);
//    $_SESSION["img"]=$image;
   $txtdoc=substr( basename($_FILES["image"]["name"]),0,-4 );
    $_SESSION["name"]=$txtdoc;
    //$clicked=$_POST["abc"];
    move_uploaded_file($_FILES["image"]["tmp_name"],$target);
    } 
    else{
      $target='';
      $txtdoc='';
      $imgname='';
    //  $_SESSION["target"]='';
    } ?>

<?php 
//echo  $_SESSION["name"] ;

$abc=$_SESSION["name"];

?>

<?php
         $python="tesseract  D:/images/$imgname  D:/textfiles/$txtdoc";
         $out=shell_exec($python);
         echo '<pre>'.$out.'</pre>';        
?>

<?php
         $python="tesseract  D:/images/$imgname  D:/pdffiles/$txtdoc pdf";
         $out=shell_exec($python);
         echo '<pre>'.$out.'</pre>';        
?>
<?php
         $python="tesseract  D:/images/$imgname  D:/tsvfiles/$txtdoc tsv";
         $out=shell_exec($python);
         echo '<pre>'.$out.'</pre>';        
?>

<?php
         $python="tesseract  D:/images/$imgname  D:/hocrfiles/$txtdoc hocr";
         $out=shell_exec($python);
         echo '<pre>'.$out.'</pre>';        
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>project</title>
</head>
<body class="conatiner" style="background-color:coral;">
<header class="container-xxl">
        <div class="container my-5" style="background-image: repeating-radial-gradient(white, lightgreen);border-radius: 2rem;">
        
            <span>OPTICAL IMAGE CONVERSION </span>
        
        </div>
    </header> 
    <section class="container py-2" style="background-color: rgb(233, 200, 91);display:flex;border-radius: 2rem;"> 
    <div class="container">
        <form action="test_input.php" method="post" enctype="multipart/form-data">
    <label for="image" class="my-5" >IMAGE FOR OCR:
    </label>
    <input type="file" class="form-control" id="input_img" name="image">
    <input type="submit" class="mt-2 mb-5" value="upload Image" name="submit">
    <input class="btn btn-primary" type="submit" name="txt" value="txt" >
    <input class="btn btn-primary" type="submit" name="pdf" value="pdf" >
    <input class="btn btn-primary" type="submit" name="tsv" value="tsv" >
    <input class="btn btn-primary" type="submit" name="hocr" value="hocr" >
      </form>
    </div>

     
<div class="container" >
      <form action="test_input.php" class="form-control">
       <label for="output_img">OCRed IMAGE:</label>
      <textarea name="output_img" id="output_img" cols="80" rows="20" class="my-2">
         
      <?php      
      if(isset($_POST["txt"])){  
        echo "txt clicked";     
        echo file_get_contents("D:/textfiles/$abc.txt");
      }
      elseif(isset($_POST["pdf"])){  echo "pdf clicked";     
        echo file_get_contents("D:/pdffiles/$abc.pdf");
    }
      elseif (isset($_POST["tsv"])) {
         echo "tsv clicked";     
        echo file_get_contents("D:/tsvfiles/$abc.tsv");
      }
      elseif (isset($_POST["hocr"])) {
        echo "hocr clicked";     
        echo file_get_contents("D:/files/$abc.hocr");
      }
      
      
      else{echo "not clicked";}
      ?>
           
        </textarea>

      </form>
</div> </section>

   


</body>
</html>