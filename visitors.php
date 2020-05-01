<!DOCTYPE html>
<html>
	<?php 
		$page = "visitors";
		include 'includes/header.php';
	?>
	<body> 
		<div class="container-fluid text-center top-container">
			<img src="images/prison_icon.png">
		</div>
	<?php
		include "server/connect.php";
		$vis_query = "SELECT * FROM visitors";
    	$vis_result = $conn->query($vis_query);
    ?>    
        <div class='container'>
        <?php include 'includes/nav.php'; ?>
			<div class="row">
				<div class="col-md-12 text-center">
					<h1>Visitor Log</h1>
					<div>
						<table class="table table-hover">
							<thead>
							<tr>
								<th scope="col">Visitor ID</th>
								<th scope="col">First Name</th>
								<th scope="col">Last Name</th>
								<th scope="col">SSN</th>
								<th scope="col">Sex</th>
								<th scope="col">Relation</th>
								<th scope="col">Date of Visit</th>
								<th scope="col">Entry</th>
								<th scope="col">Exit</th>
								<th scope="col">Prisoner</th>  
								<th scope="col">Details</th>
							</tr>
							</thead>
							<tbody>
							<?php while($row = $vis_result->fetch_assoc()) { ?>
								<tr>
									<td scope='row'><?php echo $row["vid"]; ?></td>
									<td scope='row'><?php echo $row["fname"]; ?></td>
									<td scope='row'><?php echo $row["lname"]; ?></td>
									<td scope='row'><?php echo $row["ssn"]; ?></td>
									<td scope='row'><?php echo $row["sex"]; ?></td>
									<td scope='row'><?php echo $row["relation"]; ?></td>
									<td scope='row'><?php echo $row["visit_on"]; ?></td>
									<td scope='row'><?php echo $row["in_time"]; ?></td>
									<td scope='row'><?php echo $row["out_time"]; ?></td>
									<td scope='row'><?php echo $row["pno"]; ?></td>
									<td>
										<form action="visitor_details.php" method="GET">
											<input type="hidden" name="vno" value="<?php echo $row['vid']; ?>"/>
										<button>Details</button>
										</form>
									</td>
								</tr>
							<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>