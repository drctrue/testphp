<?php

class View
{

    private $vars = array();

    public function __construct()
    {
        //echo "View";
    }

    public function vars($var_name, $value)
    {
        if (isset($this->vars[$var_name]) == true) {
            trigger_error('Unable to set var `' . $var_name . '`. Already set, and overwrite not allowed.', E_USER_NOTICE);
            return false;
        }

        $this->vars[$var_name] = $value;
        return true;
    }

    public function render($name, $noInclude=false)
    {
        foreach ($this->vars as $key => $value) {
            $$key = $value;
        }
        if ($noInclude == true) {
            foreach ($this->vars as $key => $value) {
                $$key = $value;
            }
            require 'view/' . $name . '.php';

        } else {
            require 'view/header.php';
            require 'view/' . $name . '.php';
            require 'view/footer.php';
            foreach ($this->vars as $key => $value) {
                $$key = $value;
            }
        }

    }
}
