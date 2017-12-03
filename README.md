# KS PHP

## What is this?

#### A small PHP library for CRUD like apps
- The main design criteria for this library was to make my life easier as a freelance web dev
- It uses an Active record class that creates a table with given model
- The model has convenience methods to interact with the DB records
- HTML Output class that will build Components and Forms based on models

## Prerequisites 

- PHP7
- Strict types enabled
- MySQL or Maria DB

## Plays nice with

- Any shared host with PHP7
- Twitter Bootstrap
- Need REST end points? [Slim](https://www.slimframework.com/) is pretty great

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

#### KS\DB - Convinience methods for DB interaction 

- Execute a SQL statement, returns a PDOStatement 

```php
    DB::sql("SELECT * FROM `cats`")->fetchAll();
```  
- Returns a new instance of PDO with Config.php params

```php
    $pdo = DB::pdo(); 
``` 

#### KS\MODEL - Active Record Classes for BD Interaction

1-Extend a new custom model from KS\Model 

2-Assign public properties with type:

```php
    class Cat extends KS\Model\Model
    {
        public $name = "string"; //string
        public $age = 1; //integer
        public $is_fat = true; //boolean
    }
```  
    
3 - KS\Model will automatically create a table

4 - Use chained methods to manipulate the db
```php
     //Save new Model
     $c = new Cat();
     $c->name = "Odin";
     $c->age = 6;
     $c->is_fat = true;
     $c->save();
     
     //Or save new record with a $_POST array
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
     $c->update(1);
     
     //Delete with id
     Cat::delete(1);
```
     
#### KS\HMTL - for HTML output
     
