<!DOCTYPE html>
<html lang="en">

<?php include ("./inc/head.inc.php"); 
      include ("./inc/other_form_links.inc.php");?>


<body>
  <div class="wrapper">
    
	<?php include ("./inc/navbar.inc.php");
	$proId = $_GET['proid'];
	$circuitId = $_GET['circid'];
	$exerciseId = $_GET['exid'];
	?>
	    
    <!-- Main Section-->
    <div class="main app form" id="main">



      <!-- Code taken from 'Classes Section' -->
    <div class="pitch" id="classes">


    <div class="limiter">
		<div class="container-login101">
			<div class="wrap-login101 p-l-85 p-r-85 p-t-55 p-b-55">
				<form class="login101-form validate-form flex-sb flex-w" action="php/alter-circuit-exercise.inc.php" method="post">
					
				<?php
					if (isset($_GET['error']))
					{
						if ($_GET['error'] == 'emptyfields')
						{
							echo '<p class="error-message"> Fill in all fields. </p>';
						}
						else if ($_GET['error'] == 'sqlerror')
						{
							echo '<p class="error-message"> There is an error with the database. </p>';
						}
					}
				?>
				
				
				<span class="login101-form-title p-b-32">
						Change Exercise
					</span>


					<!-- Remember mixing GET and POST is difficult, so just use POST 
					style="display: none;" -->
					<?php
					
						echo '	
						
						<div class="wrap-input101 validate-input m-b-36" data-validate = "Programme ID is required" style="display: none;">
							<input class="input101" type="text" name="proId" value="'.  $proId .'">
							<span class="focus-input101"></span>
						</div> 
						
						<div class="wrap-input101 validate-input m-b-36" data-validate = "Circuit ID is required" style="display: none;">
							<input class="input101" type="text" name="circId" value="'.  $circuitId .'">
							<span class="focus-input101"></span>
						</div> 
						

						<div class="wrap-input101 validate-input m-b-36" data-validate = "Exercise ID is required" style="display: none;">
							<input class="input101" type="text" name="exId" value="'.  $exerciseId .'">
							<span class="focus-input101"></span>
						</div>';


						require 'php/dbh.inc.php';

						$sql = "SELECT * FROM exercises where exercise_id=" . $exerciseId;
						$stmt = mysqli_stmt_init($conn);

						if (!mysqli_stmt_prepare($stmt, $sql))
						{
							echo '<p class="error-message"> There is an error with the database. </p>';
							exit();
						}
						else
						{
							mysqli_stmt_execute($stmt);
							$result = mysqli_stmt_get_result($stmt);

							// Loop through the programmes to get title value               
							while ($row = mysqli_fetch_assoc($result))
							{
								$exerciseTitle = $row["exercise_title"];
								$exerciseWeight = $row["weight"];
								$exerciseReps = $row["reps"];

								// Paste out the input box (with the value inside)
								echo '<span class="txt1 p-b-11">
								Exercise Title
							</span>
							<div class="wrap-input101 validate-input m-b-36" data-validate = "Exercise title is required">
								<input class="input101" type="text" name="exTitle" value="' . $exerciseTitle . '">
								<span class="focus-input101"></span>
							</div>
		
							<span class="txt1 p-b-11">
								Exercise Weight
							</span>
							<div class="wrap-input101 validate-input m-b-36" data-validate = "Exercise weight is required">
								<input class="input101" type="text" name="exWeight" value="' . $exerciseWeight . '">
								<span class="focus-input101"></span>
							</div>
		
							<span class="txt1 p-b-11">
								Exercise Reps
							</span>
							<div class="wrap-input101 validate-input m-b-36" data-validate = "Exercise reps is required">
								<input class="input101" type="text" name="exReps" value="' . $exerciseReps . '">
								<span class="focus-input101"></span>
							</div>';
							}
						}
					
					?>

					<!--
					<span class="txt1 p-b-11">
						Exercise Title
					</span>
					<div class="wrap-input101 validate-input m-b-36" data-validate = "Exercise title is required">
						<input class="input101" type="text" name="exTitle" >
						<span class="focus-input101"></span>
					</div>

					<span class="txt1 p-b-11">
						Exercise Weight
					</span>
					<div class="wrap-input101 validate-input m-b-36" data-validate = "Exercise weight is required">
						<input class="input101" type="text" name="exWeight" >
						<span class="focus-input101"></span>
					</div>

					<span class="txt1 p-b-11">
						Exercise Reps
					</span>
					<div class="wrap-input101 validate-input m-b-36" data-validate = "Exercise reps is required">
						<input class="input101" type="text" name="exReps" >
						<span class="focus-input101"></span>
					</div>
					-->
									


					<div class="container-login101-form-btn">
						<button class="login101-form-btn" type="submit" name="alter-circuit-exercise-submit">
							Change
						</button>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>


  <?php include ("./inc/footer.inc.php"); ?>
</body>
</html>
