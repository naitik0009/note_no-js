<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

</head>
<body>
<?php
$tits="";
$cont="";
$update =false;

// require_once 'capture.php';

// if(isset($session['message'])){
//   echo '<div class="alert alert-success" role="alert">
//  succed!
// </div>';
// }
$servername = "localhost";
$username = "root";
$password = "";
$database = "without";

$connection = mysqli_connect($servername,$username,$password,$database);

// if ($connection){
//     echo "connection successfull";
// }
// else{
//     die(mysqli_connect_error());
// }

if(isset($_POST['submit'])){
    $title = $_POST['title'];
    $content = $_POST['content'];
    $insert = "INSERT INTO `notes` (title,content) VALUES ('$title','$content')";
    $ok = mysqli_query($connection,$insert);
    $session['message'] = 'Record has been posted';
    $session['msg_type'] = 'success';
    // header("location : index.php");
}
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $delete = "DELETE FROM `notes` WHERE `notes`.`id` = '$id' ";
    $sets = mysqli_query($connection,$delete);
    $session['message'] = 'Record has been deleted';
    $session['msg_type'] = 'success';
    // header("location : index.php");
}
if (isset($_GET['edit'])){
  $ID = $_GET['edit'];
  $update = true;

  $edits = "SELECT * FROM `notes` WHERE id= '$ID'  ";


 $edit = mysqli_query($connection,$edits);

  

  while($sho = mysqli_fetch_array($edit)){
  $tits = $sho['title'];
  $cont = $sho['content'];
  }

}
if(isset($_POST['update'])){
  $id=$_POST['id'];
//  $id= $_GET['edit'];
  $ti = $_POST['title'];
  $co = $_POST['content'];
  $upd = "UPDATE `notes` SET `title` =  '$ti' , `content` = '$co' WHERE `id` = '$id' ";
  $q = mysqli_query($connection,$upd);
  if($q){
    echo "wow";
  }
  else{
    die(mysqli_connect_error());
  }
  header('location: index.php');
}
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Notes</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#">about</a>
      </li>
   
      <li class="nav-item active">
        <a class="nav-link" href="#" >contact us</a>
      </li>
    </ul>
    <!-- <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form> -->
  </div>
</nav>

<div class="container">
<form action="index.php" method="POST">
<input type="hidden" name=id value="<?php  $id=$_GET['edit']; echo $id; ?>" >
  <div class="form-group">
    <label for="exampleInputEmail1">title</label>
    <input type="text" class="form-control" value="<?php echo $tits; ?>" id="exampleInputEmail1" name="title" aria-describedby="emailHelp">
   
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">content</label>
    <textarea class="form-control"  id="exampleFormControlTextarea1" name="content" rows="3"><?php echo "".$cont; ?></textarea>
  </div>
  <div class="form-group form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <?php
  if($update==true): ?>
  <button type="submit" name="update" class="btn btn-primary">update</button> 
  
 
  <?php 
  else: ?>
  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
<?php endif ?>
</form>
</div>
<br>
<div class="container">
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">id</th>
      <th scope="col">Title</th>
      <th scope="col">Content</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $database = "without";
  
  $connection = mysqli_connect($servername,$username,$password,$database);
  // include 'capture.php';
  $i=0;
  $select = "SELECT * FROM `notes`";
  $bring = mysqli_query($connection,$select);
  while($fetch = mysqli_fetch_assoc($bring)){
    $i++;
    echo "
<tr>
<th scope='row'>".$i."</th>
<td>".$fetch['title']."</td>
<td>".$fetch['content']."</td>
 <td><a href='index.php?edit=".($fetch['id'])."'class='btn btn-info' >edit</a> <a href='index.php?delete=".($fetch['id'])."'class='btn btn-danger'>delete</a></td>
</tr>
";
  }
?>
  </tbody>
</table>

</div>
</body>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</html>
