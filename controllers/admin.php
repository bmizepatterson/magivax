<?php

if (!empty($_POST)) {
    // Add a vaccine to the DB
    if (!empty($_POST['addVaccine']) and !empty($_POST['longName']) and !empty($_POST['shortName'])) {
        $DB->insertRecord(
            'INSERT INTO vaccine (shortname, longname) VALUES (?, ?)', 
            array(htmlspecialchars($_POST['shortName']), htmlspecialchars($_POST['longName']))
        );
    }
    // Update the current vaccine
    if (!empty($_POST['updateVaccine']) and !empty($_POST['id']) and !empty($_POST['longName']) and !empty($_POST['shortName'])) {
        $DB->updateRecord(
            'UPDATE vaccine SET longname=:longname, shortname=:shortname
             WHERE id = :id',
            array(
                ':longname'  => htmlspecialchars($_POST['longName']),
                ':shortname' => htmlspecialchars($_POST['shortName']),
                ':id'        => htmlspecialchars($_POST['id'])
            )
        );
    }
}
$edit = false;
if (!empty($_GET)) {
    // Delete a vaccine
    if (!empty($_GET['delete']) and !empty($_GET['vaccine'])) {
        $DB->deleteRecord(
            'DELETE FROM vaccine WHERE id = ?',
            array($_GET['vaccine'])
        );
    }
    if (!empty($_GET['edit']) and !empty($_GET['vaccine'])) {
        $edit = $DB->getRecord(
            'SELECT * FROM vaccine WHERE id = ?',
            array($_GET['vaccine'])
        );
    }
}

// Select all vaccines in the DB
$vaccines = $DB->getAll('vaccine');

echo open_body('Admin | Magivax');
echo user_nav();

require 'views/admin.view.php';

echo close_body();
