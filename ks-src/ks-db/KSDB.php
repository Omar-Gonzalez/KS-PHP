<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 4/17/2017
 * Time: 7:34 PM
 */

declare(strict_types = 1);

namespace KS\DB;

require __DIR__ . "../../config.php";
require __DIR__ . "../../ks-core/KSCore.php";
require __DIR__ . "../QueryUtils.php";

use const KS\Config\{DB_USER,DB_PW,HOST,DB};
use KS\Core\KSCore;
use KS\DB\QU\QueryUtils;
use PDO;

abstract class KSDB extends KSCore implements QueryUtils
{
    public static $results;

    protected static function pdo():\PDO
    {
        return new PDO("mysql:".HOST.";dbname=".DB, DB_USER, DB_PW);
    }

    public static function get_all_from_table(string $table)
    {
        $dbh = self::pdo();
        $sth = $dbh->prepare("SELECT * FROM ".$table);

        try {
            $sth->execute();
            $result = $sth->fetchAll();
            if(self::is_debug_on())
            {
                print_r(var_dump($result));
            }
            return $result;
        } catch(PDOExecption $e) {
            $dbh->rollback();
            if(self::is_debug_on())
            {
                print "Error!: " . $e->getMessage() . "</br>";
            }
        }
    }

    public function json()
    {
        if (count(self::$results) >= 1)
        {
            return json_encode(self::$results[0]);
        }
        else
        {
            return self::$results;
        }
    }

    public function get()
    {
        if (count(self::$results) >= 1)
        {
            return self::$results[0];
        }
        else
        {
            return self::$results;
        }
    }

    public function array()
    {
        if (count(self::$results) >= 1)
        {
            return self::$results[0];
        }
        else
        {
            return self::$results;
        }
    }
    public function object()
    {
        if (count(self::$results) >= 1)
        {
            return (object)self::$results[0];
        }
        else
        {
            return (object)self::$results;
        }
    }
}