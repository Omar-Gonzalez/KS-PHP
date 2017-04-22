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
    public $name = "string"; //string
    public $age = 1; //integer
    public $hair_count = 0.5;
    public $is_fat = true; //boolean
}

class Dog extends KSModel
{
    public $name = "string";
    public $weight = 0.0;
    public $color = "string";
    public $is_long_hair = false;
}

class Person extends KSModel
{
    public $name = "string";
    public $age = 0;
}

class Bird extends KSModel
{
    public $color = "string";
}

class Computer extends KSModel
{
    public $cpu = "string";
}

class Job extends KSModel
{
    public $salary = 0;
}

class House extends KSModel
{
    public $location = "string";
}