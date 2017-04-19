<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 4/17/2017
 * Time: 3:28 PM
 */
declare(strict_types = 1);

namespace KS\Config;
namespace KS\Model;

require __DIR__ . '/ks-src/models.php';


$yoko = new Cat();
$yoko->name = "Yoko";
$yoko->age = 1;
$yoko->hair_count = 36364874;
$yoko->is_fat = true;
$yoko->save();

Cat::find(3);
Cat::delete(5);