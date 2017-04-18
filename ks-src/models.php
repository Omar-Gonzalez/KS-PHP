<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 4/18/2017
 * Time: 12:54 AM
 */
declare(strict_types = 1);

namespace KS\Model;

class Cat extends KSModel
{
    public $name = "string";
    public $age = 1;
    public $hair_count = 1.0;
    public $is_fat = false;
}

class Dog extends KSModel
{
    public $name = "string";
    public $weight = 0.0;
    public $color = "string";
    public $is_long_hair = false;
}