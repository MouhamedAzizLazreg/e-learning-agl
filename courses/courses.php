<?php 
include('../loggedHeader.php'); 
include('../config/db_connect.php');
?>

<html>
<?php
$errors = array('title'=>'');
$title="";
if(isset($_POST['submit']) && isset($_FILES['video'])){

  $video_name=$_FILES['video']['name'];
  $tmp_name=$_FILES['video']['tmp_name'];
  $error=$_FILES['video']['error'];
  if(empty($_POST['title'])){
    $errors['title']= "A title is required <br/>";
  } else {
    if($error === 0){
      $title = mysqli_real_escape_string($conn, $_POST['title']);
      $video_ex = pathinfo($video_name, PATHINFO_EXTENSION);
      $video_ex_lc = strtolower($video_ex);
      $allowed_exs = array("mp4", "webm", "avi", "flv");
      if(in_array($video_ex_lc, $allowed_exs)){
        $new_video_name= uniqid("video-",true). '.' . $video_ex_lc;
        $video_upload_path="videos/". $new_video_name;
        move_uploaded_file($tmp_name, $video_upload_path);
        $sql="INSERT INTO videos(video_url, title) VALUES ('$new_video_name','$title')";
        mysqli_query($conn,$sql);
        header('Location:uploaded.php');
      } else {
        $em = "You can't upload this type of file!";
        header("Location:courses.php?error=$em");
      }
    }
  }
}
?>



<form action="courses.php" method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="input-field col s6">
            <label for="">Video Title</label>
            <input id="input_text" type="text" data-length="35" name="title" value="<?php echo htmlspecialchars($title) ?>">
            <div class="red-text"><?php echo $errors['title']; ?></div>
        </div>
    </div>
    <div class="file-field input-field">
        <div class="btn purple darken-1">
            <span>File</span>
            <input type="file" multiple name="video">
        </div>
        <div class="file-path-wrapper">
            <input class="file-path validate" type="text" placeholder="Upload one or more files">
        </div>
    </div>
    <div>
        <?php if(isset($_GET['error'])){ ?>
            <p class="red-text"><?=$_GET['error']?></p>
        <?php } ?>
    </div>
    <div class="center">   
        <input type="submit" name="submit" value="Submit" class="btn brand purple darken-1 z-depth-0">
    </div>
</form>

  
<?php include('../templates/footer.php');?>
