<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 4/19/2017
 * Time: 5:58 PM
 */

declare(strict_types = 1);

namespace KS\Core\Log;

/**
 * Class Log
 * @package KS\Core\Log
 */

class Log
{
    /**-----------------------------------------------------*
     * - Log Styles
     **-----------------------------------------------------*/
    const LOG_STL = "<div class='ks-log' style='background-color: black; color:yellowgreen; width: 100%;font-family: Arial;margin:5px;padding-bottom:19px;padding-left:20px;border-radius: 3px;'>";
    const LOG_ERROR = "<div class='ks-log' style='background-color: black; color:red; width: 100%;font-family: Arial;margin:5px;padding-bottom:19px;padding-left:20px;border-radius: 3px;'>";
    /**-----------------------------------------------------*
     * - Success Logs
     **-----------------------------------------------------*/
    const TEST = self::LOG_STL."<br>KS:Test log - Executed!<br></div>";
    const OK_NEW_TABLE = self::LOG_STL."<br>KS: New table from model was created successfully<br></div>";
    const OK_NEW_ROW = self::LOG_STL."<br>KS: New row was added to table <br></div>";
    const OK_DEL_ROW = self::LOG_STL."<br>KS: Row was deleted successfully <br></div>";
    const OK_UPDATED_ROW = self::LOG_STL."<br>KS: Row was updated successfully <br></div>";
    /**-----------------------------------------------------*
     * - Error Logs
     **-----------------------------------------------------*/
    const F_PDO_NOT_FOUND = self::LOG_ERROR."<br>KS:PDO Error couldn't find any record with query<br></div>";
    const F_PDO_OPERATION = self::LOG_ERROR."<br>KS:PDO Operation failed<br></div>";
}