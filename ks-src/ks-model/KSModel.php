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
        $this->table_name = basename(str_replace('\\', '/', get_class($this)))."s";
        $this->validate_table();
    }

    function __destruct()
    {
        $this->properties = null;
        $this->table_name = null;
    }

    private function validate_table(){

        $dbh = $this::pdo();
        $existing_table = gettype($dbh->exec("SELECT count(*) FROM $this->table_name")) == 'integer';
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
            echo "Table ".$this->table_name." was is not yet created, trying to create";
            echo"<br>";
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
                    uuid varchar(36) NOT NULL,
                    ".$columns."
                    created_at TIMESTAMP DEFAULT NOW(),
                    updated_at TIMESTAMP DEFAULT NOW(),
                    PRIMARY KEY (uuid)
                )";

        if($this::is_debug_on())
        {
            echo $sql;
        }

        try {
            $result = $dbh->query($sql);
            if($this::is_debug_on())
            {
                echo var_dump($result);
            }
        } catch(PDOExecption $e) {
            $dbh->rollback();
            if(self::is_debug_on())
            {
                print "Error!: " . $e->getMessage() . "</br>";
            }
        }
    }

    public function save()
    {
        $this->__construct();

        $keys = "";
        $values = "";
        foreach ($this->properties as $key => $value) {
            if ($key == "properties" || $key == "table_name"){
                continue;
            }

            $keys .= $key.", ";
            $values .= "'".$value."', ";
        }

        $sql = "
        INSERT INTO  ks.".$this->table_name." (
            uuid,
            ".$keys." 
            created_at, 
            updated_at
        ) 
        VALUES 
	    (
            '".self::UUID()."', 
            ".$values."
            '2017-04-17 00:00:00', 
            '2017-04-17 00:00:00'
	    )
        ";

        if(self::is_debug_on())
        {
            echo "<br>".$sql."<br>";
        }

        $dbh = $this::pdo();

        try {
            $result = $dbh->query($sql);
            if($this::is_debug_on())
            {
                echo var_dump($result);
            }
        } catch(PDOExecption $e) {
            $dbh->rollback();
            if(self::is_debug_on())
            {
                print "Error!: " . $e->getMessage() . "</br>";
            }
        }
    }

    public function update()
    {

    }

    public function delete()
    {

    }
}

