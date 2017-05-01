<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 4/24/2017
 * Time: 1:57 PM
 */

namespace KS;


trait PDOExecutions
{
    /**-----------------------------------------------------*
     * - Direct SQL : Returns PDO Statement(Data) [Get,Find]
     **-----------------------------------------------------*/
    public static function sql($sql):\PDOStatement
    {
        $dbh = self::pdo();
        try {
            $results = $dbh->query($sql);
            return $results;
        } catch(\PDOException $e) {
            $dbh->rollback();
            echo "<br>PDOException : " . $e->getMessage() . "</br>";
            return false;
        }
    }

    /**-----------------------------------------------------*
     * - PDO Execute SQL - No return data required [Del,Update]
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