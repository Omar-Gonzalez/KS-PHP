<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 4/22/2017
 * Time: 12:50 AM
 */

require __DIR__ . '/ks-src/Models.php';

$c = new \KS\Model\Cat();
$c->save($_POST);