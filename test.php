<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 4/17/2017
 * Time: 3:28 PM
 */
namespace KS\Config;
namespace KS\Model;

require __DIR__ . '/ks-src/ks-model\KSModel.php';
require __DIR__ . '../Cat.php';

$m = new Cat();

$m::get_all_from_table('cat');