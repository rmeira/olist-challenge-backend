<?php
require("../../vendor/autoload.php");
$openapi = \OpenApi\scan('../../app');
header('Content-Type: application/x-yaml');
echo $openapi->toYaml();
