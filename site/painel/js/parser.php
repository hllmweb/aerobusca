<?php
require_once "../lib/js.composer.class.php";
$composer = new JSComposer();

$files = array('site.js');
$composer->run($files, "packed.js");