<?php

use Manticoresearch\Client;

require_once $_SERVER["DOCUMENT_ROOT"] . '/vendor/autoload.php';

$configSearch = ['host'=>'127.0.0.1','port'=>9308];
$clientSearch = new Client($configSearch);
$indexSearch = $clientSearch->index('movies');
