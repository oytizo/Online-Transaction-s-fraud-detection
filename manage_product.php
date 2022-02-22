<?php
require('connection.inc.php');
require('function.inc.php');
$categories_id='';
$name='';
$mrp='';
$price='';
$qty='';
$image='';
$short_desc='';
$description='';
$meta_title='';
$meta_description='';
$meta_keyword='';

$msg="";
if(isset($_GET['id']) && ($_GET['id']!='')) {
  $id=get_safe_value($con,$_GET['id']);
  $edit_sql="select * from product where id='$id'";
  $res=mysqli_query($con,$edit_sql);
  $row=mysqli_fetch_assoc($res);

  $categories_id=$row['categories_id'];
  $name=$row['product_name'];
  $mrp=$row['mrp'];
  $price=$row['price'];
  $qty=$row['qty'];
  $short_desc=$row['short_desc'];
  $description=$row['description'];
  $meta_title=$row['meta_title'];
  $meta_description=$row['meta_desc'];
  $meta_keyword=$row['meta_keyword'];

  
}

if(isset($_POST['submit'])) {
$categories_id=get_safe_value($con,$_POST['categories_id']);
$name=get_safe_value($con,$_POST['name']);
$mrp=get_safe_value($con,$_POST['mrp']);
$price=get_safe_value($con,$_POST['price']);
$qty=get_safe_value($con,$_POST['qty']);
$short_desc=get_safe_value($con,$_POST['short_desc']);
$description=get_safe_value($con,$_POST['description']);
$meta_title=get_safe_value($con,$_POST['meta_title']);
$meta_description=get_safe_value($con,$_POST['meta_description']);
$meta_keyword=get_safe_value($con,$_POST['meta_keyword']);


if(isset($_GET['id']) && ($_GET['id']!='')) {
  if($_FILES['image']['name']!='') {
    $image=rand(11111,99999)._. $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH.$image);
  
    $update_sql="update product set categories_id='$categories_id',product_name='$name',mrp='$mrp',price='$price',qty='$qty',short_desc='$short_desc',description='$description',meta_title='$meta_title',meta_desc='$meta_desc',meta_keyword='$meta_keyword' image='$image' where id='$id'";
  }
  else {
    $update_sql="update product set categories_id='$categories_id',product_name='$name',mrp='$mrp',price='$price',qty='$qty',short_desc='$short_desc',description='$description',meta_title='$meta_title',meta_desc='$meta_desc',meta_keyword='$meta_keyword' where id='$id'";
  }
  
  mysqli_query($con,$update_sql);
  header('location:product.php');
  die();
}
else {
  
  $res_cat=mysqli_query($con,"select * from product where product_name='$name'");
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
       
  }
  }
if($msg==''){

    $image=rand(11111,99999)._. $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH.$image);
  
    $insert_sql="insert into product (categories_id,product_name,mrp,price,qty,short_desc,description,meta_title,meta_desc,meta_keyword,status,image) values('$categories_id','$name','$mrp','$price','$qty','$short_desc','$description','$meta_title','$meta_desc','$meta_keyword',1,'$image')";

    mysqli_query($con,$insert_sql);
    header('location:product.php');
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

<div class="container-fluid">
<h2 style="text-align:center;">Categories</h2>
<form method="post"  enctype="multipart/form-data">
<div class="form-group">
    <label for="exampleInputEmail1">Categories</label>
 
  <select name="categories_id" class="form-control" id="">
  <option value="">Select Catagories</option>
  <?php
  $res=mysqli_query($con,"select id,categories from categories order by categories asc");
  while($row=mysqli_fetch_assoc($res)){
    if($row['id']==$categories_id){
      echo "<option selected value=".$row['id'].">" .$row['categories']."</option>";
    }
    else {
      echo "<option value=".$row['id'].">" .$row['categories']."</option>";
    }
   
  }
  ?>
  </select>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Product Name</label>
    <input type="text" class="form-control" name="name"  placeholder="product name" required value="<?php echo $name ?>">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">MRP</label>
    <input type="text" class="form-control" name="mrp"  placeholder="mrp" required value="<?php echo $mrp ?>">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Price</label>
    <input type="text" class="form-control" name="price"  placeholder="price" required value="<?php echo $price ?>">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Qty</label>
    <input type="text" class="form-control" name="qty"  placeholder="qty" required value="<?php echo $qty ?>">
  </div> 
  <div class="form-group">
    <label for="exampleInputEmail1">Image</label>
    <input type="file" class="form-control" name="image" required>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Short Description</label>
    <textarea  name="short_desc"  placeholder="short_desc" class="form-control"  required ><?php echo $short_desc ?>
    </textarea>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Description</label>
    <textarea  name="description"  placeholder="description" class="form-control"  required ><?php echo $description ?>
    </textarea>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Meta Title</label>
    <textarea  name="meta_title"  placeholder="meta_title" class="form-control"  required ><?php echo $meta_title ?>
    </textarea>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Meta Description</label>
    <textarea  name="meta_description"  placeholder="meta_description" class="form-control"  required ><?php echo $meta_description ?>
    </textarea>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Meta keyword</label>
    <textarea  name="meta_keyword"  placeholder="meta_keyword" class="form-control"  required ><?php echo $meta_keyword ?>
    </textarea>
  </div>
  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
  
</form><br>
<?php echo $msg; ?>
</div>

</body>
</html>