<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 4/18/2017
 * Time: 9:17 PM
 */

namespace KS\DB\QU;


interface QueryUtils
{
    public function get();
    public function json();
    public function array();
    public function object();

    public function error_handler($results);
}