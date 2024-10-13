<!DOCTYPE html>
<html lang="en">

<?php include ("./inc/head.inc.php"); 
      include ("./inc/other_form_links.inc.php");?>

<body>
  <div class="wrapper">
    
	<?php include ("./inc/navbar.inc.php");
	$proId = $_GET['proid'];
	?>
	    
    <!-- Main Section-->
    <div class="main app form" id="main">



      <!-- Code taken from 'Classes Section' -->
    <div class="pitch" id="classes">


    <div class="limiter">
		<div class="container-login101">
			<div class="wrap-login101 p-l-85 p-r-85 p-t-55 p-b-55">
				<form class="login101-form validate-form flex-sb flex-w" action="php/new-circuit.inc.php" method="post">

				<?php
					if (isset($_GET['error']))
					{
						if ($_GET['error'] == 'emptyfields')
						{
							echo '<p class="error-message"> Fill in all fields. </p>';
						}
						else if ($_GET['error'] == 'sqlerrorselect' || $_GET['error'] == 'sqlerrorinsert')
						{
							echo '<p class="error-message"> There is an error with the database. </p>';
						}
					}
				?>

					<span class="login101-form-title p-b-32">
						New Circuit
					</span>
					


					<!-- Remember mixing GET and POST is difficult, so just use POST -->
					<?php echo '					
					<span class="txt1 p-b-11" style="display: none;">
						Programme ID
					</span>
					<div class="wrap-input101 validate-input m-b-36" data-validate = "Programme ID is required" style="display: none;">
						<input class="input101" type="text" name="proid" value="'.  $proId .'">
						<span class="focus-input101"></span>
					</div>' ?>

					


					<span class="txt1 p-b-11">
						Circuit Title
					</span>
					<div class="wrap-input101 validate-input m-b-36" data-validate = "Circuit title is required">
						<input class="input101" type="text" name="circTitle" >
						<span class="focus-input101"></span>
					</div>
					

					<div id="input-exercise" style="width: 100%;">
						<div style="font-size: 17px; font-weight: bold; text-align: center;">
						-- Exercise --
						</div>
						<span class="txt1 p-b-11">
								Exercise Title
						</span>
						<div class="wrap-input101 validate-input m-b-36" data-validate = "Exercise is required">
							<input class="input101" type="text" name="circEx[]" >
							<span class="focus-input101"></span>
						</div>

						<span class="txt1 p-b-11">
								Execrise Weight
						</span>
						<div class="wrap-input101 validate-input m-b-36" data-validate = "Weight is required">
							<input class="input101" type="text" name="circWeight[]" >
							<span class="focus-input101"></span>
						</div>

						<span class="txt1 p-b-11">
								Exercise Reps
						</span>
						<div class="wrap-input101 validate-input m-b-36" data-validate = "Reps is required">
							<input class="input101" type="text" name="circReps[]" >
							<span class="focus-input101"></span>
						</div>
					</div>

					

				
					<div class="container-login101-form-btn" style="padding-bottom: 30px;">
						<button class="login101-form-btn" id="exercise-button" onclick="addExercise(); return false;">
							Add Exercise
						</button>

						<button class="login101-form-btn" id="exercise-button" style="background-color: red;" onclick="removeExercise(); return false;">
							Reset
						</button>
					</div>

					<span class="txt1 p-b-11">
						Circuit Rounds
					</span>
					<div class="wrap-input101 validate-input m-b-36" data-validate = "Circuit rounds is required">
						<input class="input101" type="text" name="circRounds" >
						<span class="focus-input101"></span>
					</div>

					<span class="txt1 p-b-11">
						Circuit Rest
					</span>
					<div class="wrap-input101 validate-input m-b-36" data-validate = "Circuit rest is required">
						<input class="input101" type="text" name="circRest" >
						<span class="focus-input101"></span>
					</div>
					

					<div class="container-login101-form-btn">
						<button class="login101-form-btn" type="submit" name="new-circuit-submit">
							Create
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
