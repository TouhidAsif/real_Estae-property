<?php include 'header.php'?>

<?php
$mysqli = new mysqli('localhost','root','','property');
if($mysqli->connect_error){
    printf("database can not connect %s\n",$mysqli->connect_error);
    exit();
}

if(isset($_POST['submit'])){
    
    $name=$_POST['name'];
    $monthly=$_POST['monthly'];
    $address=$_POST['address'];
    $access=$_POST['access'];
    $floor=$_POST['floor'];
    $utility=$_POST['utility'];
    $descrip=$_POST['descrip'];
     
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["images"]["name"]);
    $temp_file = $_FILES["images"]["name"];
    move_uploaded_file($_FILES["images"]["tmp_name"], $target_file);
    
    $query="insert into propety(name,monthly,address,access,floor,utility,descrip,images) values('$name','$monthly','$address','$access','$floor','$utility','$descrip','$temp_file')";
    
    $insert=$mysqli->query($query);
    
    $last_id=$mysqli->insert_id;
    $c=count($_FILES['img']['name']);
    
    if($insert){
        
        if($c<10){
            for($i=0;$i<$c;$i++){
                $img_name=$_FILES['img']['name'][$i];
                move_uploaded_file($_FILES['img']['tmp_name'][$i],"uploads/".$img_name);
                $query_multi="insert into details(images,proid) values('$img_name',$last_id)";
                $ins=$mysqli->query($query_multi);
            }
        }
        else{
            echo"max limit exceed!";
        }
    }
    
    
}

?>


<div class="container">
    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
  <fieldset>
    <legend>Add To Property</legend>
    <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Name of Property</label>
      <div class="col-lg-10">
        <input class="form-control" name="name" placeholder="Name of Property" type="text">
      </div>
    </div>
    <div class="form-group">
      <label for="inputPassword" class="col-lg-2 control-label">Monthly Charge</label>
      <div class="col-lg-10">
        <input class="form-control" name="monthly" placeholder="Monthly Charge" type="text">
      </div>
      </div>
      
       <div class="form-group">
      <label for="inputPassword" class="col-lg-2 control-label">Address</label>
      <div class="col-lg-10">
       <textarea class="form-control" rows="3" id="textArea" name="address"></textarea>
      </div>
      </div>
      
      <div class="form-group">
      <label for="inputPassword" class="col-lg-2 control-label">Access</label>
      <div class="col-lg-10">
        <input class="form-control" name="access" placeholder="Access" type="text">
      </div>
      </div>
      
        <div class="form-group">
      <label for="inputPassword" class="col-lg-2 control-label">Flooer Space</label>
      <div class="col-lg-10">
        <input class="form-control" name="floor" placeholder="Floor Space" type="text">
      </div>
      </div>
      
        <div class="form-group">
      <label for="inputPassword" class="col-lg-2 control-label">Utility</label>
      <div class="col-lg-10">
        <input class="form-control" name="utility" placeholder="Utility" type="text">
      </div>
      </div>
      
       <div class="form-group">
      <label for="inputPassword" class="col-lg-2 control-label">Description</label>
      <div class="col-lg-10">
         <textarea class="form-control" rows="3" id="textArea" name="descrip"></textarea>
      </div>
      </div>
         
    <div class="form-group">
      <label for="inputPassword" class="col-lg-2 control-label">Fetured Image</label>
      <div class="col-lg-10">
        <input type="file" name="images">
      </div>
    </div>
    
     <div class="form-group">
      <label for="inputPassword" class="col-lg-2 control-label">Rooms Image</label>
      <div class="col-lg-10">
        <input type="file" name="img[]" multiple>
      </div>
    </div>
    
     
   
    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        <button type="reset" class="btn btn-default">Cancel</button>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </fieldset>
</form>
</div>

 <?php include 'footer.php'?>