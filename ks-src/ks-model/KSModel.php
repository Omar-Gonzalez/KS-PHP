<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 4/17/2017
 * Time: 3:57 PM
 */
declare(strict_types = 1);

namespace KS\Model;

require __DIR__ . "../../ks-db/KSDB.php";

use KS\DB\KSDB;

abstract class KSModel extends KSDB
{
    private $properties = [];
    private $table_name;

    function __construct()
    {
        $this->properties = get_object_vars($this);
        $this->table_name = basename(str_replace('\\', '/', get_class($this)));
        $this->table_validation();
    }

    private function table_validation(){

        $connection = $this::pdo();
        $existing_table = gettype($connection->exec("SELECT count(*) FROM $this->table_name")) == 'integer';
        $columns = "";

        if($existing_table == 1)
        {
            if($this::is_debug_on())
            {
                echo "Table ".$this->table_name." was already created";
            }
            return;
        }

        if($this::is_debug_on())
        {
            echo "Table ".$this->table_name." was created successfully";
        }

        foreach ($this->properties as $key => $value)
        {
            $colum_type = "";

            if (gettype($value) == "boolean")
            {
                $colum_type = "BOOLEAN";
            }
            if (gettype($value) == "integer")
            {
                $colum_type = "INTEGER";
            }
            if (gettype($value) == "double")
            {
                $colum_type = "FLOAT ";
            }
            if (gettype($value) == "string")
            {
                $colum_type = "TEXT";
            }

            if ($key == "properties" || $key == "table_name"){
                continue;
            }

            $columns .= $key." ".$colum_type.", ";
        }

        $sql = "CREATE TABLE ".$this->table_name." (
                    ID int NOT NULL AUTO_INCREMENT,
                    ".$columns."
                    created_at TIMESTAMP DEFAULT NOW(),
                    updated_at TIMESTAMP DEFAULT NOW(),
                    PRIMARY KEY (ID)
                )";

        if($this::is_debug_on())
        {
            echo $sql;
        }
        $result = $connection->query($sql);

        if($this::is_debug_on())
        {
            echo var_dump($result);
        }
    }

    public function save()
    {

    }

    public function update()
    {

    }

    public function delete()
    {

    }
}