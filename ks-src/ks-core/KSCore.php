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

class KSCore
{
    function __construct()
    {
        //...
    }

    static public function is_debug_on()
    {
        return DEBUG_MODE;
    }
}