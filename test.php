<?php
require_once 'functions.php';
spl_autoload_register('Helper\autoLoadClass');
set_exception_handler(['Error', 'handle']);

$db = new Database();
var_dump($db->insert('answers', ['survey' => 1, 'value' => 3]));

