
<script>
function showhideForm(showform) {
    if (showform == "1") {
        document.getElementById("div1").style.display = 'block';
        document.getElementById("div2").style.display = 'none';
        document.getElementById("div3").style.display = 'none';
        document.getElementById("div4").style.display = 'block';
        document.getElementById("div5").style.display = 'none';
        document.getElementById("div6").style.display = 'none';
       
    }
    } 
    if (showform == "2") {
        document.getElementById("div2").style.display = 'block';
        document.getElementById("div1").style.display = 'none';
        document.getElementById("div3").style.display = 'none';
        document.getElementById("div5").style.display = 'block';
        document.getElementById("div6").style.display = 'none';
        document.getElementById("div4").style.display = 'none';

    } 
    if (showform == "3") {
        document.getElementById("div3").style.display = 'block';
        document.getElementById("div2").style.display = 'none';
        document.getElementById("div1").style.display = 'none';
        document.getElementById("div6").style.display = 'block';
        document.getElementById("div5").style.display = 'none';
        document.getElementById("div4").style.display = 'none';

    } 

</script>
<?php
include 'connection.php';
$name =  $_SESSION['farmerFname'] . " ". $_SESSION['farmerLname'];
$farmer_id = $_SESSION['farmerId'];

function generateFarmId() {
  // Define the list of characters to choose from
  $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
  
  // Generate a random string of 6 characters
  $random_string = '';
  for ($i = 0; $i < 6; $i++) {
    $random_string .= $chars[rand(0, strlen($chars) - 1)];
  }
  
  // Return the generated farm ID
  return 'FRM-' . $random_string;
}

if (isset($_POST['add_farm_btn'])) {
  $farm_id = generateFarmId();
  $farmname = $_POST['farm_name'];
  $farmlocation = $_POST['county_id'];
  $farmsize = $_POST['farm_size'];
  $owner_id = $_POST['owner_id'];

  if (empty($farmname)) {
    array_push($errors, "Farm name is required");
  }
  if (empty($farmlocation)) {
    array_push($errors, "Enter farm location");
  }
  if (empty($farmsize)) {
    array_push($errors, "Input farm size");
  }
  if (count($errors) == 0) {
   
    $add_farm_query = "INSERT INTO `farm_details`(`farm_id`, `farm_name`, `farm_location`, `farm_size`)VALUES ('$farm_id','$farmname','$farmlocation','$farmsize')";
    $results = mysqli_query($db, $add_farm_query);

    $update_owner_query = "INSERT INTO `farmer_owner_details`(`farm_id`, `owner_id`) VALUES ('$farm_id','$owner_id')";
    $result_owner = mysqli_query($db, $update_owner_query);
  }
  
      header('location: farms.php');
    }
?>
<!DOCTYPE html>
<html>
<head>
     
     <title>Manage farm</title>
     <?php
include './components/header.php';
?>
     
 </head>
    <body class="w3-responsive w3-mobile">
  
<?php
include './components/navbar.php';
?>

<div class="container">

<div class="row">
<div class="col-sm-2"></div>
  <div class="col-sm-8">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Add Farm</h5>
        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
        <a href="#" class="btn btn-primary" onclick="myFunction('Demo1')">Add Farm</a>
      </div>
      <hr>
      <div id="Demo1" class="w3-accordion-content w3-container">
      <form method="post" action="">
        <h2 class="text-center">Farm Details</h2>
        <div class="form-group">
          <label for="exampleInputEmail1">Farm Name</label>
          <input type="text" class="form-control" id="exampleInputEmail1" hidden autocomplete="false" name="owner_id" aria-describedby="emailHelp"  readonly value="<?php echo $farmer_id; ?>" required>
          <input type="text" class="form-control" id="exampleInputEmail1" autocomplete="false" name="farm_name" aria-describedby="emailHelp"placeholder="Enter farm name" required>
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Farm Location</label>
          <select class="form-control" id="County_id" name="county_id" required>
                                <option value="">Select County..</option>
                                <?php 
    // Retrieve the departments from the database
    $sql=mysqli_query($db,"select * from county_details");
    while ($rw=mysqli_fetch_array($sql)) {
    ?>
                                <option value="<?php echo htmlentities($rw['county_id']);?>">
                                    <?php echo htmlentities($rw['county_name']);?> County</option>
                                <?php
    }
    ?>
                            </select>
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Farm Size (In hacteres)</label>
          <input type="number" class="form-control" id="exampleInputEmail1" autocomplete="false" name="farm_size" aria-describedby="emailHelp"placeholder="Enter farm size in Ha">
        </div>
                <input type="submit" name="add_farm_btn" class="btn btn-success btn-block" value="Add Farm">
      </form>
</div>

    </div>
  </div>
 <div class="col-sm-2"></div>


</div>
  <br>
 

            <div id="main">
              
            <?php
include './components/footer.php';
?>
        </div>
            <script>
function myFunction(id) {
    document.getElementById(id).classList.toggle("w3-show");
}
</script>
<?php
include './components/scripts.php';
?>

    </body>
</html>
