<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 4/17/2017
 * Time: 7:49 PM
 */

declare(strict_types = 1);

namespace KS\Core;

/**-----------------------------------------------------*
 * - Name Space Declarations
 **-----------------------------------------------------*/

use const KS\Config\{DEBUG_MODE,TIME_ZONE};

/**
 * Class KSCore
 * @package KS\Core
 */

abstract class KSCore
{
    function __construct()
    {
        //...
    }

    static protected function set_timezone()
    {
        date_default_timezone_set(TIME_ZONE);
    }

    static protected function log(string $log){
        if (DEBUG_MODE)
        {
            echo $log;
        }
    }

    static protected function UUID():string
    {
        return substr(com_create_guid(), 1, -1);
    }

    static protected function parse_table_name(string $class):string
    {
        return basename(str_replace('\\', '/', $class))."s";
    }
}