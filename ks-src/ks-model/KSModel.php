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
use PDO;

class KSModel extends KSDB
{
    private $properties = [];
    private $table_name;

    function __construct()
    {
        $this->properties = get_object_vars($this);
        $this->table_name = self::parse_table_name(get_class($this));
        $this->validate_table();
        self::set_timezone();
    }

    function __destruct()
    {
        $this->properties = null;
        $this->table_name = null;
    }

    private function validate_table()
    {
        if ($this->table_name == "ksmodels")
        {
            if($this::is_debug_on())
            {
                echo "<br>KS:Table trying to create a table out of the wrong instance<br>";
            }
            return;
        }
        $dbh = $this::pdo();
        $existing_table = gettype($dbh->exec("SELECT count(*) FROM $this->table_name")) == 'integer';
        $columns = "";

        if($existing_table == 1)
        {
            if($this::is_debug_on())
            {
                echo "<br>KS:Table ".$this->table_name." was already created<br>";
            }
            return;
        }

        if($this::is_debug_on())
        {
            echo "<br>KS Table ".$this->table_name." is not yet created, trying to create<br>";
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

            if ($key == "properties" || $key == "table_name" || $key == "results"){
                continue;
            }

            $columns .= $key." ".$colum_type.", ";
        }

        $sql = "CREATE TABLE ".$this->table_name." (
                    id INTEGER NOT NULL AUTO_INCREMENT,
                    ".$columns."
                    created_at TIMESTAMP DEFAULT NOW(),
                    updated_at TIMESTAMP DEFAULT NOW(),
                    PRIMARY KEY (id)
                )";

        try {
            $result = $dbh->query($sql);
            if($this::is_debug_on())
            {
                echo "<br>KS:Table ".$this->table_name." was created<br>".var_dump($result);
            }
        } catch(PDOExecption $e) {
            $dbh->rollback();
            if(self::is_debug_on())
            {
                echo "<br>KS:Error!: " . $e->getMessage() . "</br>";
            }
        }
    }

    public function save()
    {
        $this->__construct();

        $keys = "";
        $values = "";
        foreach ($this->properties as $key => $value) {
            if ($key == "properties" || $key == "table_name" || $key == "results"){
                continue;
            }

            $keys .= $key.", ";
            $values .= "'".$value."', ";
        }

        $sql = "
        INSERT INTO  ks.".$this->table_name." (
            ".$keys." 
            created_at, 
            updated_at
        ) 
        VALUES 
	    (
            ".$values."
            '".date('Y-m-d h:i:sa')."', 
            '".date('Y-m-d h:i:sa')."'
	    )
        ";

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
                echo "<br>Error!: " . $e->getMessage() . "</br>";
            }
        }
    }

    public function update()
    {

    }

    public static function delete(int $id):bool
    {
        $table_name = self::parse_table_name(get_called_class());
        $dbh = self::pdo();

        try {
            $stmt = $dbh->prepare("DELETE FROM ".$table_name." WHERE id=:id");
            $stmt->bindValue(':id', $id, PDO::PARAM_STR);
            $stmt->execute();
            $affected_rows = $stmt->rowCount();
            if ($affected_rows == 1)
            {
                if(self::is_debug_on())
                {
                    echo "<br>KS:SQL row with id: ".$id." was deleted<br>";
                }
                return true;
            }
            else
            {
                if(self::is_debug_on())
                {
                 echo "<br>KS:SQL Error unable to delete row with id:".$id."<br>";
                }
                return false;
            }

        } catch(PDOExecption $e) {
            $dbh->rollback();
            if(self::is_debug_on())
            {
                echo "<br>Error!: " . $e->getMessage() . "</br>";
                return false;
            }
        }
    }

    public static function find(int $id)
    {
        $table_name = self::parse_table_name(get_called_class());

        $dbh = self::pdo();
        $sql = "SELECT * FROM ".$table_name." WHERE id=".$id;

        try {
            $stmt = $dbh->query($sql);
            self::$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(self::is_debug_on())
            {
                var_dump(self::$results);
            }
            return new self;

        } catch(PDOExecption $e) {
            $dbh->rollback();
            if(self::is_debug_on())
            {
                echo "<br>Error!: " . $e->getMessage() . "</br>";
            }
        }
    }
}
