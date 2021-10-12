<?php require_once('header.php'); ?>



                   <?php 
					if(isset($_SESSION['customer'])) {			
					$scid=$_SESSION['customer']['cust_id'];
					$spoint="0";
					$stmt = $pdo->query("SELECT spoints FROM tbl_points WHERE scid='$scid'");
					while ($row = $stmt->fetch()) {
					   
						$spoint=$spoint + $row['spoints'];
					}					
					if($spoint=="0") {echo "0";} 
					
					else
					{ 
					$spoint = -1 * abs($spoint);
				    $stmt = $pdo->query( "INSERT INTO tbl_points (scid, spoints) VALUES ('$scid', '$spoint')");
				   	
					}
					}
					
					?>
						
					
					
<div class="page">
    <div class="container">
        <div class="row">            
            <div class="col-md-12">
			<img src="assets/uploads/Image_success.jpg">
			<p>
                    <h3 style="margin-top:20px;"><?php echo LANG_VALUE_121; ?> Need a chance to Win Bonus Points?</h3>
                    <a href="survey.php" class="btn btn-success">Fill Out Survey</a>
                
                    <a href="dashboard.php" class="btn btn-success"><?php echo LANG_VALUE_91; ?></a>
                </p>
				
				
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>