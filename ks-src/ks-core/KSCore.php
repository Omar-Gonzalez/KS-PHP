<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 4/17/2017
 * Time: 7:49 PM
 */

declare(strict_types = 1);

namespace KS\Core;

//require __DIR__ . "../../ks-config.php";

use const KS\Config\DEBUG_MODE;

abstract class KSCore
{
    function __construct()
    {
        //...
    }

    static protected function is_debug_on():bool
    {
        return DEBUG_MODE;
    }

    static protected function UUID():string
    {
        //return com_create_guid();
        return substr(com_create_guid(), 1, -1);
    }
}