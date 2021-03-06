<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 4/20/2017
 * Time: 7:14 PM
 */

namespace KS\HTML\Form;

use KS\HTML;
use KS\Model;

class Form extends HTML
{
    private $properties;
    private $method;
    private $action;

    function __construct(Model $model, string $method, string $action)
    {
        $this->properties = get_object_vars($model);
        $this->action = $action.".php";
        $this->method = $method;
    }

    protected function writteHTML():string
    {
        $html = "<hr><form method='".$this->method."' action='".$this->action."'>";

        foreach ($this->properties as $key => $value) {
            $html.= "<label>$key</label><br>";
            switch (gettype($value) ){
                case "boolean":
                    $html.= "
                    <select name='".$key."'>
                        <option>TRUE</option>
                        <option>FALSE</option>
                    </select><br>
                    ";
                    break;
                case "integer":
                    $html.= "<input type='number' name='".$key."'><br>";
                    break;
                case "double":
                    $html.= "<input type='number' name='".$key."'><br>";
                    break;
                case "string":
                    $html.= "<input type='text' name='".$key."'><br>";
                    break;
                default:
                    $html.= "<input type='text' name='".$key."'><br>";
                    break;
            }
        }

        $html.= "<br><button type='submit'>Save</button><hr>";
        $html.= "</form>";

        return $html;
    }
}