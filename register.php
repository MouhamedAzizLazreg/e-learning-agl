<?php 
include('config/db_connect.php');

$errors = array('email'=>'','firstName'=>'','lastName'=>'','password'=>'','gender'=>'','date'=>'');
$email=$firstName=$lastName=$password=$gender="";
$date='0000-00-00';

if(isset($_POST ['submit'])){
    // echo htmlspecialchars($_POST ['email']);
    // echo htmlspecialchars($_POST ['title']);
    // echo htmlspecialchars($_POST ['ingredients']);
    
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

if ($user) {
  $errors['email'] = "This email is already taken. Please try with a different email address.<br>";
}
        }
    }
    if(empty($_POST['date'])){
        $errors['date']=  "a birth date is required <br/>";
    }
    if(empty($_POST['password'])){
        $errors['password']=  "a password is required <br/>";
    }else{
        $password=$_POST['password'];
        if(strlen($password)<8 ){
            $errors['password']=  "password too weak <br/>";
        }
    }
    if(empty($_POST['firstName'])){
        $errors['firstName'] = "First Name is required <br/>";
    }else{ 
        $firstName=$_POST['firstName'];
        if(!preg_match('/^[a-zA-Z\s]+$/',$firstName)){
            $errors['firstName'] = 'First Name must be letters and spaces only <br/>';
        }
    }
    if(empty($_POST['lastName'])){
        $errors['lastName'] = "Last Name is required <br/>";
    }else{ 
        $lastName=$_POST['lastName'];
        if(!preg_match('/^[a-zA-Z\s]+$/',$lastName)){
            $errors['lastName'] = 'Last Name must be letters and spaces only <br/>';
        }
    }
    if(empty($_POST['gender'])){
        $errors['gender']= "a gender is required <br/>";
    }else{
        $gender=$_POST['gender'];
        if(!preg_match('/^[a-zA-Z\s]+$/',$gender)){
            $errors['gender'] = 'gender must be seperated with commas (,) <br/>';
        }
    }

    if(!array_filter($errors)){

        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
        $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $gender = mysqli_real_escape_string($conn, $_POST['gender']);
        $date = mysqli_real_escape_string($conn, $_POST['date']);
        $sql = "INSERT INTO register (password,firstName,lastName,mail,gender,birthDate) VALUES ('$password','$firstName','$lastName','$email','$gender','$date')";
        //save to db and check
        if(mysqli_query($conn,$sql)){

           

        }else {
            echo 'query error:'. mysqli_error($conn); 
        }
        header('location: index.php');
    }
   
}
if(isset($_POST ['cancel'])){
    header('location:index.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<?php include('templates/header.php'); ?>

<section class="container grey-text">

<h4 class="center">Create Account</h4>
<form  class="white" action="register.php" method="POST">

<label>First Name:</label>
<input type="text" name="firstName" value="<?php echo htmlspecialchars($firstName) ?>">
<div class="red-text"><?php echo $errors['firstName']; ?></div>

<label>Last Name:</label>
<input type="text" name="lastName" value="<?php echo htmlspecialchars($lastName) ?>">
<div class="red-text"><?php echo $errors['lastName']; ?></div>

<label>Your Email:</label>
<input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
<div class="red-text"><?php echo $errors['email']; ?></div>

<label>Password:</label>
<input type="password" name="password" value="<?php echo htmlspecialchars($password) ?>">
<div class="red-text"><?php echo $errors['password']; ?></div>
<label>Gender:</label>
<div>
  <label>
    <input type="radio" name="gender" value="male" <?php if($gender == 'male') echo 'checked' ?>>
    <span>Male</span>
  </label>
  <label>
    <input type="radio" name="gender" value="female" <?php if($gender == 'female') echo 'checked' ?>>
    <span>Female</span>
  </label>
</div>
<div class="red-text"><?php echo $errors['gender']; ?></div>
<label>Birth Date:</label>
<input type="date" name="date" value="<?php  echo htmlspecialchars($date) ?>">
<div class="red-text"><?php echo $errors['date']; ?></div>
<div class="center">
    <input type="submit" name="submit" value="Register" class="btn brand purple darken-1 z-depth-0">
    <input type="submit" name="cancel" value="Cancel" class="btn brand grey grey-text text-darken-4 z-depth-0" formnovalidate>
    </form>
</div>
</section>
<?php include('templates/footer.php'); ?>

</html>