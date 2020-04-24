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
		$sups = $conn->query("SELECT fname,lname,ssn FROM employee");
		while($r = $sups->fetch_assoc()){
			$super_ssns[$r['ssn']] = $r['fname']." ".$r['lname'];
		}
		$sql = "SELECT fname,lname,ssn,bdate,sex,designation,super_ssn,block_name from employee, blocks where bno = bid";
    	$result = $conn->query($sql);
    ?>    
        <div class='container'>
        <?php include 'includes/nav.php'; ?>
			<div class="row">
				<div class="col-md-12 text-center">
					<h1>Employees</h1>
					<form class="form-inline">
						<!-- enter select options here -->
					</form>
					<div>
						<table class="table table-hover">
							<thead>
								<tr>
									<th scope="col">SSN</th>
									<th scope="col">Name</th>
									<th scope="col">DOB</th>
									<th scope="col">Sex</th>
									<th scope="col">Designation</th>
									<th scope="col">Supervisor</th>
									<th scope="col">Block</th>
									<th scope="col">Details</th>
								</tr>
							</thead>
							<tbody>
							
							<?php while($row = $result->fetch_assoc()) { ?>
								<tr>
									<td scope="col"><?php echo $row['ssn']; ?></td>
									<td scope="col"><?php echo ($row['fname']." ".$row['lname']); ?></td>
									<td scope="col"><?php echo $row['bdate']; ?></td>
									<td scope="col"><?php echo $row['sex']; ?></td>
									<td scope="col"><?php echo $row['designation']; ?></td>
									<td scope="col"><?php echo isset($row['super_ssn'])?$super_ssns[$row['super_ssn']]:""; ?></td>
									<td scope="col"><?php echo $row['block_name']; ?></td>
									<td>
										<form action="employee_details.php" method="GET">
											<input type="hidden" name="eno" value="<?php echo $row['ssn']; ?>"/>
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