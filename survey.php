<?php require_once('header.php'); ?>


<?php

	if(!isset($_SESSION['customer'])) {
		
		header("Location: index.php");
	}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "xicia_ecommerce";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


if(isset($_POST['survey_submit']) && !empty($_POST['survey_submit'])) {
	 $scid=$_GET['scid']; 	 $sp1=$_POST['sp1']; 	 $sp2=$_POST['sp2'];
	 $sp3=$_POST['sp3']; 	 $sp4=$_POST['sp4'];  	 $sp5=$_POST['sp5'];
	 $q1=$_POST['q1'];	     $q2=$_POST['q2'];     	 $q3=$_POST['q3'];
	 $q4=$_POST['q4'];    	 $q5=$_POST['q5'];
			
			$sql = "INSERT INTO tbl_survey (scid, sp1, q1, sp2, q2, sp3, q3, sp4, q4, sp5, q5) 
			VALUES ('$scid', '$sp1', '$q1', '$sp2', '$q2', '$sp3', '$q3', '$sp4', '$q4', '$sp5', '$q5')";
			

				if ($conn->multi_query($sql) === TRUE) {
				   $sql = "INSERT INTO tbl_points (scid, spoints) VALUES ('$scid', '25')";
				   	if ($conn->multi_query($sql) === TRUE) {
					header("Location: index.php?status=Success");
					}
					
					}
				else {
							//header("Location: survey.php?status=Error");
						echo "Error: " . $sql . "<br>" . $conn->error;
						}
			
	
	  
}
?>

<div class="page-banner" style="background-image: url(assets/uploads/faq-banner.jpg">
    <div class="inner">
        <h1> <?php if (isset($_GET['status']) ){if($_GET['status']='Error') {echo "Error! Submit Again";} } else echo "Online Survey Form";?></h1>
    </div>
</div>



<div class="page">
    <div class="container">
	
        <div class="row">   
		
            <div class="col-md-12">
                <div class="mx-0 mx-sm-auto">
  <div class="card" style="padding:20px;border:1px dashed orange;">
    <div class="card-body">
      <div class="text-center">
        <i class="fa fa-question fa-4x mb-3 text-primary"></i>
        <h4>
          <strong>Welcome to our Price Optimization Survey form.</strong>
        </h4>
        <h5>
           This form is about variety of study in the prices of our products. 
          <strong>Thankyou! </strong>

        </h5>
      </div>

      <hr style="  border-top: 1px dashed orange;">
	  
	  
  <form class=" bg-white px-6" method="post" action="survey.php?scid=<?php if(isset($_SESSION['customer'])) {echo $_SESSION['customer']['cust_id'];} else echo'0';?>">
  
  
  		  <?php 
		  
		  
$sql = "SELECT p_id, p_name, p_current_price FROM tbl_product ORDER BY RAND() LIMIT 5";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  $count=1;
  while($row = $result->fetch_assoc()) {
	  
	  echo  '<h5 class="fw-bold">';
	  $price=$row["p_current_price"] * 0.01;
	  $spid=$row["p_id"];
	  $price= floor($row["p_current_price"] - $price);
	  echo $count . ': Are you interested in buying this <a href="product.php?id='.  $spid.'">' . $row["p_name"].'</a> for '. $price .' pesos?';
	  
	  echo "</h5>";
	 
	  echo '<input name="sp'. $count .'" value="' . $spid . '" style="display:none;visibility:hidden;">';
	  echo '
			 <div class="form-check mb-2">
      <input class="form-check-input" type="radio" name="q'.$count.'"  value= "YES" required />
      <label class="form-check-label" for="radioExample1">
         YES
      </label>
    </div>
    <div class="form-check mb-2">
      <input class="form-check-input" type="radio" name="q'.$count.'"  value="NO" />
      <label class="form-check-label" >
         NO
      </label>
    </div>
			
	  ';
	   $count=$count+1;

  }
} else {
  echo "0 results";
}
$conn->close();
?>
   
  <hr style="  border-top: 1px dashed orange;">
   
	  <div class="card-footer text-end">
      <input type="submit" class="btn btn-primary" name="survey_submit" value="Submit">
    </div>
  </form>

  
  </div>
</div>
			
            
			
			</div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>