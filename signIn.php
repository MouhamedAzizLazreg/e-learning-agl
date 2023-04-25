
<?php  
include('config/db_connect.php');
$errors = array('email'=>'','password'=>'');
$email=$password="";
if(isset($_POST ['logIn'])){
    
    if(empty($_POST['email'])){
        $errors['email']=  "a email is required <br/>";
    }else{
        $email=$_POST ['email'];
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors['email']= 'you shall enter a valid email address <br/>';
        }else{
            $email = mysqli_real_escape_string($conn, $_POST['email']);
$sql = "SELECT * FROM register WHERE mail = '$email'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

if (!$user) {
  $errors['email'] = "This email Does not exist<br>";
}else{
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $hashed_password = $user['password'];
    if ($password == $hashed_password) { if($password=='adminadmin'&&$email=="admin@admin.com"){
        header('location:admin/admin.php');
    }else{
        header('location:loggedHeader.php');}
    } else {
      $errors['password'] = "Incorrect password<br>";
    }
}
        }
    }}
    if(isset($_POST ['cancel'])){
        header('location:index.php');
    }
    
    ?>


<!DOCTYPE html>
<html lang="en">
<?php include('templates/header.php'); ?>

<section class="container grey-text">

<h4 class="center">Sign In</h4>
<form  class="white" action="signIn.php" method="POST">
<label>Your Email:</label>
<input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
<div class="red-text"><?php echo $errors['email']; ?></div>

<label>Password:</label>
<input type="password" name="password" value="<?php echo htmlspecialchars($password) ?>">
<div class="red-text"><?php echo $errors['password']; ?></div>

<div class="center">
    <input type="submit" name="logIn" value="Log In" class="btn brand purple darken-1 z-depth-0">
    <input type="submit" name="cancel" value="cancel" class="btn brand grey grey-text text-darken-4 z-depth-0">
    </form>
</div>
</section>
<?php include('templates/footer.php'); ?>

</html>