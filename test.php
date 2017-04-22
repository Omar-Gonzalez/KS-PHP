<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 4/17/2017
 * Time: 3:28 PM
 */
declare(strict_types = 1);

require_once __DIR__ . '/vendor/autoload.php';

use KS\Model\Cat;

$c = new Cat();
$c->name = "Odin";
$c->age = 100;
$c->hair_count = 1111;
$c->is_fat = true;
$c->save();




