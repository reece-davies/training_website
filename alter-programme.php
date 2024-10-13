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
				<form class="login101-form validate-form flex-sb flex-w" action="php/alter-programme.inc.php" method="post">
					

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
						Change Programme
					</span>


					<!-- Remember mixing GET and POST is difficult, so just use POST 
					style="display: none;" -->
					<?php echo '					
					
					<div class="wrap-input101 validate-input m-b-36" data-validate = "Programme ID is required" style="display: none;">
						<input class="input101" type="text" name="proId" value="'.  $proId .'">
						<span class="focus-input101"></span>
					</div>' ?>

					<!--
					<span class="txt1 p-b-11">
						Programme Title
					</span>
					<div class="wrap-input101 validate-input m-b-36" data-validate = "Programme title is required">
						<input class="input101" type="text" name="proTitle">
						<span class="focus-input101"></span>
					</div>
					-->

					
					<?php
						require 'php/dbh.inc.php';

						$sql = "SELECT * FROM programmes where programme_id=" . $proId;
						$stmt = mysqli_stmt_init($conn);

						if (!mysqli_stmt_prepare($stmt, $sql))
						{
							header("Location: /programmes.php?error=sqlerror");
							exit();
						}
						else
						{
							mysqli_stmt_execute($stmt);
							$result = mysqli_stmt_get_result($stmt);

							// Loop through the programmes to get title value               
							while ($row = mysqli_fetch_assoc($result))
							{
								$proTitle = $row["programme_title"];

								// Paste out the input box (with the value inside)
								echo '<span class="txt1 p-b-11">
									Programme Title
								</span>
								<div class="wrap-input101 validate-input m-b-36" data-validate = "Programme title is required">
									<input class="input101" type="text" name="proTitle" value="'.  $proTitle .'">
									<span class="focus-input101"></span>
								</div>';
							}
						}
					?>

									


					<div class="container-login101-form-btn">
						<button class="login101-form-btn" type="submit" name="alter-programme-submit">
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
