<?php

/**
 * Created by PhpStorm.
 * User: Rick Holtman
 * Date: 6/25/2017
 * Time: 5:19 PM
 */

class validation
{

    public $inputName;
    public $input=false;
    public $error=[];

    public function email($email, $inputName="Email")
    {
        $this->inputName = $inputName;
        if ($email) {
            $this->input = true;
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($this->error, "Invalid email format on " . $this->inputName);
//            $this->error = "Invalid email format";
            }
            return $this;
        }
    }

    public function isText($text, $inputName="Text")
    {
        $this->inputName = $inputName;
        if($text) {
            $this->input = true;
            if(ctype_alpha($text)) {
            } else {
                array_push($this->error,"Only text allowed on " . $this->inputName);
            }
        }
        return $this;
    }

    public function isNumber($number, $inputName="Number")
    {
        $this->inputName = $inputName;
        if($number) {
            $this->input = true;
            if(ctype_digit($number)) {
            } else {
                array_push($this->error,"Only numbers allowed on " . $this->inputName);
            }
        }
        return $this;
    }

    public function lenghtMax($int)
    {
        if($this->input == true) {
            if(strlen($this->input) >= $int){
                array_push($this->error,"Input is to long on " . $this->inputName);
            }
        }
        return $this;
    }

//    TODO required
    public function required()
    {
        if($this->input ==  false) {
                array_push($this->error,"Is required on " . $this->inputName);
            }
        return $this;
    }
}