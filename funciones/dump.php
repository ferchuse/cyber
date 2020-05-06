<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$database = 'armoniacorporal';
$user = 'armoniacorporal';
$pass = 'Armon1@corporal';
$host = 'armoniacorporal.db.8478954.810.hostedresource.net';
$dir = dirname(__FILE__) . '/dump.sql';
echo "<h3>Backing up database to `<code>{$dir}</code>`</h3>";
exec("mysqldump --user={$user} --password={$pass} --host={$host} {$database} --result-file={$dir} 2>&1", $output);
var_dump($output);

?>