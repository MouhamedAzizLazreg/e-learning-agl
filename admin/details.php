<?php 
include('../config/db_connect.php');

$user = NULL;

if(isset($_POST['delete'])){
    $id_to_delete = mysqli_real_escape_string($conn,$_POST['id_to_delete']);
    $sql= "DELETE FROM register WHERE mail = '$id_to_delete'";
    if(mysqli_query($conn,$sql)){
        header('Location: admin.php');
    }else{
        echo'query error' . mysqli_error($conn);
    }
}
if(isset($_GET['id'])){
    $id= mysqli_real_escape_string($conn,$_GET['id']);
    $sql="select * from register where mail = '$id'";
    $result = mysqli_query($conn,$sql);
    $user= mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    mysqli_close($conn);
}
if(isset($_POST['upgrade'])){
    
    $id_to_delete = mysqli_real_escape_string($conn,$_POST['id_to_delete']);
    $id_to_delete=$_POST['id_to_delete'];
    $sql= "UPDATE `register` SET `userType`='tutor' WHERE `mail`='$id_to_delete'";
    if(mysqli_query($conn,$sql)){
        header('Location: admin.php');
    }else{
        echo'query error' . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include('adminheader.php'); ?>
<div class="container center">
<?php if($user): ?>
<h4><?php echo htmlspecialchars($user['firstName']).' '.htmlspecialchars($user['lastName']) ; ?></h4>
<p><?php echo htmlspecialchars($user['mail']); 
?></p>
<p><?php echo htmlspecialchars($user['password']); ?></p>
<p><?php echo date($user['joinDate']); ?></p>
<p><?php echo htmlspecialchars($user['gender']); ?></p>
<p><?php echo htmlspecialchars($user['birthDate']); ?></p>
<form method="POST" action="details.php">
<input type="hidden" name="id_to_delete" value="<?php echo $user['mail'] ?>" />
<input type="submit" name="upgrade" value="upgrade to tutor" class="btn brand z-depth-0">
<input type="submit" name="delete" value="delete" class="btn brand z-depth-0">
</form>
<?php else: ?>
    <h5>That user does not exist</h5>
    <?php endif; ?>
</div>
<?php include('adminfooter.php'); ?>
</html>
