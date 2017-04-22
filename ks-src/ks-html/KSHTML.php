<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 4/21/2017
 * Time: 1:35 PM
 */

namespace KS\HTML;

require __DIR__ . "../HTMLInterface.php";

abstract class KSHTML implements HTMLInterface
{
    /**-----------------------------------------------------*
     * - HTML Interface Methods
     **-----------------------------------------------------*/

    public function draw()
    {
        echo $this->writteHTML();
    }

    public function html()
    {
        return $this->writteHTML();
    }

}