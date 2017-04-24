<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 4/21/2017
 * Time: 1:35 PM
 */

namespace KS;


abstract class HTML implements HTMLInterface
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