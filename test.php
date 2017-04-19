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

require __DIR__ . '/ks-src/ks-model\KSModel.php';
require __DIR__ . '/ks-src/models.php';

$m = new Cat();
$d = new Dog();


$yoko = new Cat();
$yoko->name = "Yoko";
$yoko->age = 1;
$yoko->hair_count = 36364874;
$yoko->is_fat = true;
$yoko->save();

$ema = new Cat();
$ema->name = "Ema";
$ema->age = 2;
$ema->hair_count = 222334.44;
$ema->is_fat = false;
$ema->save();


$nico = new Dog();
$nico->name = "Nico";
$nico->color = "Beige";
$nico->weight = 45;
$nico->is_long_hair = true;
$nico->save();

echo"<br>";
echo"-----------------";
echo"<br>";
//
var_dump(Dog::find(6)->get());

$results = Dog::find(6)->array();

$json = Dog::find(1)->json();

echo $json;

foreach ($results as $r) {
    echo $r."<br>";
}

echo"<br>";
echo"-----------------";
echo"<br>";

var_dump(Dog::find(6)->object());
