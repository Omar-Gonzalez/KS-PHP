# KS PHP

## What is this?

- A small PHP library I wrote for my freelance work

## Prerequisites 

- PHP7
- strict types enabled

## Config

- Fill Config.php

      const DEBUG_MODE = true;
      const TIME_ZONE = "America/Mexico_City";
      const HOST = "host=127.0.0.1:8889";
      const DB = "KS";
      const DB_USER = "root";
      const DB_PW = "1111";

## Classes 

#### Active Record Classes for BD Interaction

1-Extend a new model from KSModel 

2-Assign public properties with type:

    class Cat extends KSModel
    {
        public $name = "string"; //string
        public $age = 1; //integer
        public $is_fat = true; //boolean
    }
    
3 - KSModel will automatically create a table

4 - Use chained methods to manipulate the db

     $c = new Cat();
     $c->name = "Odin";
     $c->age = 6;
     $c->is_fat = true;
     $c->save();
     
     //Find row with id 
     Cat::find(1)->get();
     
     //Return type json/object
     Cat::find(1)->json();
     Cat::find(1)->object();

     //Update with id 
     $c = new Cat();
     $c->name = "Odin";
     $c->age = 7;
     $c->is_fat = false;
     $c->update();
     
     //Delete with id
     Cat::delete(1);
     
[\#PHP4life Dawg!](https://twitter.com/_MinightCoffee)

