<?php
if(isset($_POST['logOut'])) {
    
    header("Location:index.php"); 
}
?>
<head>
    <title>E-Learning</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
   
            <style type="text/css">
                .brand{
                    background: #a1a1a1 !important;
                }
                .brand-text{
                    color: #a1a1a1 !important;
                }
                form{
                    max-width :460px;
                    margin: 20px auto;
                    padding: 20px;
                }
              nav .badge{
                position:relative;
                top:30px;
                right:27px !important;
              }

            </style>
</head>
<body class="grey lighten-2">
    
<nav class="nav-wraper white z-depth-0">
<div class="container">

<a href="#" class="brand-logo brand-text grey-text text-darken-4 left"><span style="color:purple;">E</span>-Learning</a>
  
<ul class="right">
    <li><a href="#" class="btn brand grey lighten-5 grey-text text-darken-4 z-depth-0 waves-effect waves-dark">Home</a></li>
    <li><a href="#" class="btn brand grey lighten-5 grey-text text-darken-4 z-depth-0 waves-effect waves-dark">Courses</a></li>
    <li><a href="#" class="btn brand grey lighten-5 grey-text text-darken-4 z-depth-0 waves-effect waves-dark">Mentors</a></li>
    <li><a href="#" class="btn brand grey lighten-5 grey-text text-darken-4 z-depth-0 waves-effect waves-dark">About</a></li>
<li><a href="#" class="btn-floating indigo darken-4 z-depth-0">
    <i class="material-icons">notifications</i>
</a></li>
<li><span class="badge white-text pink new">5</span></li>
<li><a href="index.php" name="logOut" class="btn brand grey lighten-2 grey-text text-darken-4 z-depth-0 waves-effect waves-dark">Log Out</a></li>
</ul>
</div>
</nav>
