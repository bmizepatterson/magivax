<div class="w3-content w3-section">
    <div class="w3-card">
        <div class="w3-container light-blue">
            <h1>Add a vaccine</h1>
        </div>
        <form method="post" name="newVaccine" id="newVaccine" autocomplete="off">
            <div class="w3-panel">
                <label for="longName">Long Name</label>
                <input class="w3-input" type="text" name="longName" id="longName">

                <label for="shortName">Short Name</label>
                <input class="w3-input" type="text" name="shortName" id="shortName">
            </div>

            <input class="w3-button w3-block light-blue hover-tan" type="submit" value="Add" name="addVaccine" id="addVaccine">
        </form>
    </div>
</div>

<div class="w3-container w3-section">
	<h1>Manage Vaccine Data</h1>
	<div class="w3-container">
		<table class="w3-table-all">
			<tr><th>&nbsp;</th><th>Long name</th><th>Short name</th></tr>
                <?php foreach ($vaccines as $vaccine) {
                    $deleteLink = "<a href=\"admin?delete=1&vaccine={$vaccine->id}\">Delete</a>";
                    echo "<tr><td>{$deleteLink}</td><td>{$vaccine->longname}</td><td>{$vaccine->shortname}</td></tr>";
                } ?>
		</table>
	</div>
</div>
