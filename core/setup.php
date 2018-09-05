<?php

require_once('lib.php');
require_once('database/connection.php');
require_once('database/query.php');

$DB = new Query(Connection::make());
