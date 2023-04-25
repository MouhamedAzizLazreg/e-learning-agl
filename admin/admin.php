<?php 

$conn= mysqli_connect('localhost','projet','admin','projet');
if(!$conn){
    echo 'Connection error:'. mysqli_connect_error();
}

$sql='SELECT firstName, lastName, mail, birthDate, password, joinDate FROM register order by joinDate';
$result = mysqli_query($conn, $sql);
$users = mysqli_fetch_all($result,MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<?php include('adminheader.php'); ?>
<h4 class="center grey-text">USERS</h4>
<div class="row">
    <?php  foreach($users as $user):   ?>
<div class="col s6 md3">
    <div class="card z-depth-0">
        <img src="user.png" class="user"    >
    <div class="card-contect center">
        <br>
        <h6><?php echo htmlspecialchars($user['firstName']) ?></h6>
        <ul>
            <li>
            <?php echo htmlspecialchars($user['lastName']) ?>
            </li>
        </ul>
    </div>
    <div class="card-action right-align">
        <a class="brand-text" href="details.php?id=<?php echo $user['mail'] ?>">more info</a>
    </div>
    
    </div>
</div>
        <?php endforeach; ?>
</div>
<?php include('adminfooter.php'); ?>
</html>