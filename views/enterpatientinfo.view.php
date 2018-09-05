<?php
require_once(dirname(__FILE__) . '/lib.php');
open_body('Enter Patient Info | Magivax');
user_nav();
?>
<div class="w3-content w3-white">
	<div class="w3-container">
		<h1>Enter Patient Information</h1>

		<div class="w3-card w3-section">
			<div class="w3-container light-blue">
				<h2>Basic Information</h2>
			</div>
			<form class="w3-container" action="schedule.php" method="post" autocomplete="off" name="basicInformation" id="basicInformation">
				<div class="w3-row-padding">
					<div class="w3-half">
						<h3><label for="birthDate">Date of birth:</label></h3>
						<input id="birthDate" name="birthDate" class="w3-input" type="date" required="true">
					</div>
					<div class="w3-half">
						<h3>Sex:</h3>
						<p><input id="sexMale" name="sex" class="w3-radio" type="radio" value="male">
						<label for="sexMale">Male</label></p>
						<p><input id="sexFemale" name="sex" class="w3-radio" type="radio" value="female">
						<label for="sexFemale">Female</label></p>
					</div>
				</div>
			</form>
		</div>

		<div class="w3-card w3-section">
			<div class="w3-container gray">
				<h2>Vaccine History</h2>
			</div>
			<div class="w3-container">
				<p>No prior vaccinations.</p>
			</div>
		</div>

		<div class="w3-section">
			<input class="w3-button w3-block light-blue hover-tan" type="submit" value="Generate Vaccination Schedule" form="basicInformation"> 
		</div>
	</div>
</div>

<?php close_body(); ?>