<?php

// Add a vaccine to the DB
if (isset($_POST) and isset($_POST['longName']) and isset($_POST['shortName'])) {
    $DB->insertRecord(
        'INSERT INTO vaccine (shortname, longname) VALUES (?, ?)', 
        array(htmlspecialchars($_POST['shortName']), htmlspecialchars($_POST['longName']))
    );
}

// Select all vaccines in the DB
$vaccines = $DB->getAll('vaccine');

require 'views/admin.view.php';

// echo '<pre>';
// var_dump($_POST);
// echo '</pre>';
