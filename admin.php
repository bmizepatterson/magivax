<?php
require_once(dirname(__FILE__) . '/lib.php');
$DB = connect_database();
$stmt = $DB->query('SELECT * FROM vaccine ORDER BY longname');
open_body('Admin | Magivax');
user_nav();
?>
<div class="w3-container">
	<h1>Manage Vaccine Data</h1>
	<div class="w3-container">
		<table class="w3-table-all">
			<tr><th>id</th><th>Long name</th><th>Short name</th></tr>
<?php
foreach ($stmt as $row) {
	echo '<tr><td>' . $row->id . '</td><td>' . $row->longname . '</td><td>' . $row->shortname . '</td></tr>';
}
?>
		</table>
	</div>
</div>
<?php close_body(); ?>
