<?php

try {
    $dbh = new PDO('pgsql:host=postgres;dbname=postgres', 'postgres', 'postgres');
    echo 'true';
}catch(PDOException $e) {
    echo 'false';
}
