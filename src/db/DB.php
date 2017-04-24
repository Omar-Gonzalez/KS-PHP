<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 4/17/2017
 * Time: 7:34 PM
 */

declare(strict_types = 1);

namespace KS\DB;

require_once __DIR__ . '../../Config.php';

/**-----------------------------------------------------*
 * - Name Space Definitions
 **-----------------------------------------------------*/

use const KS\Config\{DB_USER,DB_PW,HOST,DB};
use KS\Core\Core;
use KS\DB\QU\QueryUtils;
use PDO;

/**
 * Class DB
 * @package KS\DB
 */

abstract class DB extends Core implements QueryUtils
{
    public static $results;

    /**-----------------------------------------------------*
     * - Returns new instance of PDO
     **-----------------------------------------------------*/
    protected static function pdo():\PDO
    {
        return new PDO("mysql:".HOST.";dbname=".DB, DB_USER, DB_PW);
    }

    /**-----------------------------------------------------*
     * - Query Utils Interface -> Chained Methods
     **-----------------------------------------------------*/
    public function json()
    {
        return json_encode($this->errorHandler(self::$results));
    }

    public function get()
    {
        return $this->errorHandler(self::$results);
    }

    public function array()
    {
        return $this->errorHandler(self::$results);
    }

    public function object()
    {
        return (object)$this->errorHandler(self::$results);
    }

    public function errorHandler($results)
    {
        if(count($results)==0) {
            return $results;
        } else {
            return $results[0];
        }
    }

    /**-----------------------------------------------------*
     * - PDO Execute SQL
     **-----------------------------------------------------*/
    protected static function executeSql($sql):bool
    {
        $dbh = self::pdo();
        try {
            $results = $dbh->query($sql);
            /** The Query Yield No Results */
            if ($results->rowCount() == 0)
            {
                echo var_dump($results->rowCount());
                return false;
            }
            return true;
        } catch(\PDOException $e) {
            $dbh->rollback();
            echo "<br>PDOException : " . $e->getMessage() . "</br>";
            return false;
        }
    }
}