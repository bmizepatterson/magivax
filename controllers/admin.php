<?php

if (!empty($_POST)) {
    // Add a vaccine to the DB
    if (!empty($_POST['longName']) and !empty($_POST['shortName'])) {
        $DB->insertRecord(
            'INSERT INTO vaccine (shortname, longname) VALUES (?, ?)', 
            array(htmlspecialchars($_POST['shortName']), htmlspecialchars($_POST['longName']))
        );
    }
}
if (!empty($_GET)) {

}

// Select all vaccines in the DB
$vaccines = $DB->getAll('vaccine');

echo open_body('Admin | Magivax');
echo user_nav();

require 'views/admin.view.php';

echo '<pre>';
var_dump($_POST);
var_dump($_GET);
var_dump($_SERVER);
echo '</pre>';

echo close_body();
