<?php require_once('header.php'); ?>

<?php
// Check if the customer is logged in or not
if(!isset($_SESSION['customer'])) {
    header('location: '.BASE_URL.'logout.php');
    exit;
} else {
    // If customer is logged in, but admin make him inactive, then force logout this user.
    $statement = $pdo->prepare("SELECT * FROM tbl_customer WHERE cust_id=? AND cust_status=?");
    $statement->execute(array($_SESSION['customer']['cust_id'],0));
    $total = $statement->rowCount();
    if($total) {
        header('location: '.BASE_URL.'logout.php');
        exit;
    }
}
?>

<div class="page">
    <div class="container">
        <div class="row">            
            <div class="col-md-12"> 
                <?php require_once('customer-sidebar.php'); ?>
            </div>
            <div class="col-md-12">
                <div class="user-content">
                    <h3 class="text-center">
                        <?php echo LANG_VALUE_90; ?>
						<br>
                    </h3>
					
					<p class="text-center"><b>Bonus Points:</b> 
					
					<?php 
					$scid=$_SESSION['customer']['cust_id'];
					$spoint="0";
					$stmt = $pdo->query("SELECT spoints FROM tbl_points WHERE scid='$scid'");
					while ($row = $stmt->fetch()) {
					   
						$spoint=$spoint + $row['spoints'];
					}					
					if($spoint=="0") echo "0" ;
					else echo $spoint;
						
					?> 
					
					</p>
                </div>                
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>