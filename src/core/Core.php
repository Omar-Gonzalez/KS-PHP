<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 4/17/2017
 * Time: 7:49 PM
 */

declare(strict_types = 1);

namespace KS;

/**-----------------------------------------------------*
 * - Name Space Declarations
 **-----------------------------------------------------*/

use const KS\Config\{DEBUG_MODE,TIME_ZONE};

/**
 * Class Core
 * @package KS\Core
 */

abstract class Core
{
    function __construct()
    {
        //...
    }

    static protected function setTimezone()
    {
        date_default_timezone_set(TIME_ZONE);
    }

    static protected function log(string $log)
    {
        if (DEBUG_MODE) {
            echo $log;
        }
    }

    static protected function UUID():string
    {
        return substr(com_create_guid(), 1, -1);
    }

    static protected function parseTableName(string $class):string
    {
        return basename(str_replace('\\', '/', $class))."s";
    }

}