<?php

$vaccines = $DB->selectAll('vaccine');

require 'views/admin.view.php';
