<!DOCTYPE html>
<html>
    <?php 
		include 'includes/header.php';
	?>
	<body> 
		<div class="container-fluid text-center top-container">
			<img src="images/prison_icon.png">
		</div>
	<?php
		include "server/connect.php";
		$sql = "SELECT fname,lname,pno,bdate,sex,cellno,block_name FROM prisoners,cells,blocks where cellno = cell_no and block_id = bid ORDER BY pno";
		$result = $conn->query($sql);
	?>   
        <div class='container'>
        <?php include 'includes/nav.php'; ?>
			<div class="row">
				<div class="col-md-12 text-center">
					<h1>Prisoners</h1>
					<form class="form-inline">
						<!-- enter select options here -->
					</form>
					<div>
						<table class="table table-hover">
							<thead>
							<tr>
								<th scope="col">Prisoner No.</th>
								<th scope="col">First Name</th>
								<th scope="col">Last Name</th>
								<th scope="col">Date Of Birth</th>
								<th scope="col">Sex</th>
								<th scope="col">Cell No.</th>
								<th scope="col">Block</th>
								<th scope="col">Details</th>  
							</tr>
							</thead>
							<tbody>
							
							<?php while($row = $result->fetch_assoc()) { ?>
							<tr>
								<td scope='row'><?php echo $row["pno"]; ?></td>
								<td><?php echo $row["fname"]; ?></td>
								<td><?php echo $row["lname"]; ?></td>
								<td><?php echo $row["bdate"]; ?></td>
								<td><?php echo $row["sex"]; ?></td>
								<td><?php echo $row["cellno"]; ?></td>
								<td><?php echo $row["block_name"]; ?></td>
								<td>
									<form action="prisoner_details.php" method="GET">
										<input type="hidden" name="pnum" value="<?php $row['pno']; ?>"/>
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