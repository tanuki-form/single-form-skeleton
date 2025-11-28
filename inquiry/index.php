<?php

use Tanuki\Tanuki;

require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/functions.php";

$tanuki = new Tanuki();
$form = $tanuki->createForm(getOptions("options"));

formRoute($form);
