<?php include('../loggedHeader.php'); ?>
<html>

<div class="row">
<?php 
include('../config/db_connect.php');
$sql="SELECT * FROM videos ORDER BY id DESC";
$res= mysqli_query($conn, $sql);
if(mysqli_num_rows($res)>0){
 while($video=mysqli_fetch_assoc($res)){ ?>
<div class="col s6 md3">
    <div class="card z-depth-0">
    <div class="card-contect center">
        <br>
        <ul>
            <li><h4 class =" grey-text text-darken-2"><?php echo $video['title']; ?></h4></li>
            <li>
            <video src="videos/<?=$video['video_url']?>" controls></video>
            </li>
        </ul>
    </div>

    
    </div>
</div>
<?php  
 }
}else{
    echo"<h3>No videos uploaded yet</h3>";
}
?>
</html>
<?php include('../templates/footer.php');?>