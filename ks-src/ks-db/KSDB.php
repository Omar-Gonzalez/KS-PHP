<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 4/17/2017
 * Time: 7:34 PM
 */

declare(strict_types = 1);

namespace KS\DB;

require __DIR__ . "../../ks-config.php";
require __DIR__ . "../../ks-core/KSCore.php";

use const KS\Config\{DB_USER,DB_PW,HOST,DB};
use KS\Core\KSCore;
use PDO;

abstract class KSDB extends KSCore
{
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

    public static function get_last_row_from_table(string $table)
    {

    }
}