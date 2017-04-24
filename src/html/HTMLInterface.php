<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 4/21/2017
 * Time: 1:37 PM
 */

namespace KS;


interface HTMLInterface
{
    /**-----------------------------------------------------*
     * - draw()  Will Draw HTML in the Spot
     **-----------------------------------------------------*/
    public function draw();
    /**-----------------------------------------------------*
     * - html() Will return a HTML String 
     **-----------------------------------------------------*/
    public function html();

}