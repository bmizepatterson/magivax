<?php
echo open_body('Admin | Magivax');
echo user_nav();
?>
<div class="w3-container">
	<h1>Manage Vaccine Data</h1>
	<div class="w3-container">
		<table class="w3-table-all">
			<tr><th>id</th><th>Long name</th><th>Short name</th></tr>
                <?php foreach ($vaccines as $vaccine) {
                    echo "<tr><td>{$vaccine->id}</td><td>{$vaccine->longname}</td><td>{$vaccine->shortname}</td></tr>";
                } ?>
		</table>
	</div>
</div>
<?= close_body(); ?>
