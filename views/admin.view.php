<div class="w3-content w3-section">
    <div class="w3-card">
        <div class="w3-container light-blue">
            <?php 
                if ($edit) {
                    echo "<h1>Update $edit->longname</h1>";
                } else {
                    echo '<h1>Add a vaccine</h1>';
                }
            ?>
        </div>
        <form method="post" name="newVaccine" id="newVaccine" autocomplete="off" action="admin">
            <div class="w3-panel">
                <p>
                <label for="longName">Long Name</label>                
                <?php if ($edit): ?>
                    <input class="w3-input" type="text" name="longName" id="longName" value="<?= $edit->longname ?>">
                <?php else: ?>
                    <input class="w3-input" type="text" name="longName" id="longName">
                <?php endif ?>
                </p>

                <p>
                <label for="shortName">Short Name</label>
                <?php if ($edit): ?>
                    <input class="w3-input" type="text" name="shortName" id="shortName" value="<?= $edit->shortname ?>">
                <?php else: ?>
                    <input class="w3-input" type="text" name="shortName" id="shortName">
                <?php endif ?>
                </p>
            </div>

            <?php if ($edit): ?>
                <input type="hidden" name="id" value="<?= $edit->id ?>">
                <input class="w3-button w3-block light-blue hover-tan" type="submit" value="Update" name="updateVaccine" id="updateVaccine">
            <?php else: ?>
                <input class="w3-button w3-block light-blue hover-tan" type="submit" value="Add" name="addVaccine" id="addVaccine">
            <?php endif ?>
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
                    $editLink = "<a href=\"admin?edit=1&vaccine={$vaccine->id}\">Edit</a>";
                    echo "<tr><td>{$deleteLink} / {$editLink}</td><td>{$vaccine->longname}</td><td>{$vaccine->shortname}</td></tr>";
                } ?>
		</table>
	</div>
</div>
