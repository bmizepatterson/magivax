<?php

$config = require_once('config.php');
require_once('lib.php');
require_once('db/Connection.php');
require_once('db/Query.php');
require_once('Router.php');
require_once('Request.php');

$DB = new Query(Connection::make($config['database']));
