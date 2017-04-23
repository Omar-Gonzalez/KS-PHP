# KS PHP

## What is this?

- A small PHP library for CRUD like apps

## Prerequisites 

- PHP7
- strict types enabled
- MySQL or Maria DB

## Config

- Fill Config.php
```php
      const DEBUG_MODE = true;
      const TIME_ZONE = "America/Mexico_City";
      const HOST = "host=127.0.0.1:8889";
      const DB = "KS";
      const DB_USER = "root";
      const DB_PW = "1111";
```

## Classes 

#### KSMODEL - Active Record Classes for BD Interaction

1-Extend a new model from KSModel 

2-Assign public properties with type:

```php
    class Cat extends KSModel
    {
        public $name = "string"; //string
        public $age = 1; //integer
        public $is_fat = true; //boolean
    }
```  
    
3 - KSModel will automatically create a table

4 - Use chained methods to manipulate the db
```php
     //Save new Model
     $c = new Cat();
     $c->name = "Odin";
     $c->age = 6;
     $c->is_fat = true;
     $c->save();
     //Or save with $_POST
     $c->save($_POST);
     
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
```
     
#### KSHMTL - Templater for HTML output
     
[\#PHP4life Dawg!](https://twitter.com/_MinightCoffee)

