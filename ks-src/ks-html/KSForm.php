<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 4/20/2017
 * Time: 7:14 PM
 */

namespace KS\HTML\Form;

use KS\Core\KSCore;
use KS\Model\KSModel;

class KSForm extends KSCore
{
    private $properties;

    function __construct(KSModel $model)
    {
        $this->properties = get_object_vars($model);
    }

    public function draw(){
        echo "<form method='post' action=''>";

        foreach ($this->properties as $key => $value) {

            switch (gettype($value) ){
                case "boolean":
                    echo "
                    <select name='".$key."'>
                        <option>TRUE</option>
                        <option>FALSE</option>
                    </select><br>
                    ";
                    break;
                case "integer":
                    echo "<input type='number' name='".$key."'><br>";
                    break;
                case "double":
                    echo "<input type='number' name='".$key."'><br>";
                    break;
                case "string":
                    echo "<input type='text' name='".$key."'><br>";
                    break;
                default:
                    echo "<input type='text' name='".$key."'><br>";
                    break;
            }
        }

        echo "</form>";
    }
}