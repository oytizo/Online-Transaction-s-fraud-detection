<?php
require('connection.inc.php');
require('function.inc.php');
$categories="";
$msg="";
if(isset($_GET['id']) && ($_GET['id']!='')) {
  $id=get_safe_value($con,$_GET['id']);
  $edit_sql="select * from categories where id='$id'";
  $res=mysqli_query($con,$edit_sql);
  $row=mysqli_fetch_assoc($res);
  $categories=$row['categories'];
  
}

if(isset($_POST['submit'])) {
$categories=get_safe_value($con,$_POST['categories']);

if(isset($_GET['id']) && ($_GET['id']!='')) {
  $update_sql="update categories set categories='$categories' where id='$id'";
  mysqli_query($con,$update_sql);
  header('location:cards.php');
  die();
}
else {
  $insert_sql="insert into categories (categories,status) values('$categories','1')";
  $res_cat=mysqli_query($con,"select * from categories where categories='$categories'");
  $check=mysqli_num_rows($res_cat);
  if($check>0){
    if(isset($_GET['id']) && ($_GET['id']!='')) {
      $res=mysqli_fetch_assoc($res_cat);
      if($_GET['id']==$res['id']){
       
      }
      else {
        $msg='Already Exists';
      }
    }
    else {
       $msg='Already Exists';
  }
  }
if($msg==''){
    mysqli_query($con,$insert_sql);
  header('location:cards.php');
}
}
}





?>

<!DOCTYPE html>
<html>
<head>
<title>info</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>

<h2>Categories</h2>
<form method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Categories</label>
    <input type="text" class="form-control" name="categories"  placeholder="categories" required value="<?php echo $categories; ?>">
    
  </div>
  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
  
</form><br>
<?php echo $msg; ?>

</body>
</html>