<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 4/17/2017
 * Time: 3:57 PM
 */
declare(strict_types = 1);

namespace KS\Model;

/**-----------------------------------------------------*
 * - Name Space Definitions
 **-----------------------------------------------------*/

use KS\Core\Log\KSLog;
use KS\DB\KSDB;
use PDO;

/**
 * Class KSModel
 * @package KS\Model
 */

class KSModel extends KSDB
{
    private $properties = [];
    private $table_name;

    function __construct()
    {
        $this->properties = get_object_vars($this);
        $this->table_name = self::parseTableName(get_class($this));
        $this->validateTable();
        self::setTimezone();
    }

    function __destruct()
    {
        $this->properties = [];
        $this->table_name = null;
    }

    /**-----------------------------------------------------*
     * - Query Builders
     **-----------------------------------------------------*/
    private function sortKeVal()
    {
        $keys = "";
        $values = "";

        foreach ($this->properties as $key => $value) {
            if ($key == "properties" || $key == "table_name" || $key == "results"){
                continue;
            }

            $keys .= $key.", ";
            $values .= "'".$value."', ";
        }

        return ['keys' => $keys, 'values' => $values];
    }

    /**-----------------------------------------------------*
     * - Validate Table - Wil check if table exist if not
     *   Creates a new one
     **-----------------------------------------------------*/
    private function validateTable()
    {
        if ($this->table_name == "ksmodels")
        {
            return;
        }

        $dbh = $this::pdo();
        $existing_table = gettype($dbh->exec("SELECT count(*) FROM $this->table_name")) == 'integer';
        $columns = "";

        if($existing_table == 1)
        {
            return;
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

        $this->executeSql($sql);
        self::log(KSLog::OK_NEW_TABLE);
    }

    /**-----------------------------------------------------*
     * - Save new row with new instance of KSModel
     **-----------------------------------------------------*/
    public function save($post = null)
    {
        if (isset($post)){
            echo "POST IS NOT NULL";
           return;
        }

        echo "POST EXECUTION WASNT INTERRPUTED";

        $this->__construct();

        $sql = "
        INSERT INTO  ks.".$this->table_name." (
            ".$this->sortKeVal()['keys']." 
            created_at, 
            updated_at
        ) 
        VALUES 
	    (
            ".$this->sortKeVal()['values']."
            '".date('Y-m-d h:i:sa')."', 
            '".date('Y-m-d h:i:sa')."'
	    )
        ";

        if($this->executeSql($sql)) {
            self::log(KSLog::OK_NEW_ROW);
        }else{
            self::log(KSLog::F_PDO_OPERATION);
        }
    }

    public function update($id)
    {
        $this->__construct();

        $key_values = "";
        foreach ($this->properties as $key => $value) {
            if ($key == "properties" || $key == "table_name" || $key == "results"){
                continue;
            }
            $key_values .= "`".$key."` = '".$value."',";
        }

        $sql = "
        UPDATE 
            `ks`.`".$this->table_name."` 
        SET 
            ".$key_values."
            `updated_at` = '".date('Y-m-d h:i:sa')."' 
        WHERE 
            `cats`.`id` = ".$id;

        if(self::executeSql($sql)) {
            self::log(KSLog::OK_UPDATED_ROW);
            return true;
        }else{
            self::log(KSLog::F_PDO_OPERATION);
            return false;
        }
    }

    /**-----------------------------------------------------*
     * - Deletes existing row with id
     **-----------------------------------------------------*/
    public static function delete(int $id):bool
    {
        $table_name = self::parseTableName(get_called_class());
        $sql = "DELETE FROM `ks`.`".$table_name."` WHERE `".$table_name."`.`id` = ".$id;
        if(self::execute_sql($sql)) {
            self::log(KSLog::OK_DEL_ROW);
            return true;
        }else{
            self::log(KSLog::F_PDO_OPERATION);
            return false;
        }
    }

    /**-----------------------------------------------------*
     * - Find row with ID returns new instance -> For chained
     *   KSDB method
     **-----------------------------------------------------*/
    public static function find(int $id)
    {
        $table_name = self::parseTableName(get_called_class());
        $dbh = self::pdo();
        $sql = "SELECT * FROM ".$table_name." WHERE id=".$id;

        try {
            $stmt = $dbh->query($sql);
            self::$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return new self;

        } catch(PDOExecption $e) {
            $dbh->rollback();
            echo "<br>PDOException : " . $e->getMessage() . "</br>";
        }
    }

    /**-----------------------------------------------------*
     * - Save _POST
     **-----------------------------------------------------*/

    private function savePost()
    {
        //TODO:Save post method;
    }
}
