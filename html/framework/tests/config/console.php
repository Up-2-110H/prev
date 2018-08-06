<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 06.08.18
 * Time: 15:24
 */

$baseDir = __DIR__ . '/../../config';

$config = require($baseDir . '/console.php');
$config['components']['urlManager'] = require($baseDir . '/frontend/urlManager.php');
$config['components']['db'] = require('db.php');

return $config;
