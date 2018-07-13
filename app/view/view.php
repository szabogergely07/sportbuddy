<?php
namespace app\view;

class view
{
private $data = array();

private $render = FALSE;

public function __construct($template)
{
    try {
        $file = 'app/views/' . strtolower($template) . '.php';

        if (file_exists($file)) {
            $this->render = $file;

        } else {
            throw new customException('Template ' . $template . ' not found!');
        }
    }
    catch (customException $e) {
        echo $e->errorMessage();
    }

}

public function assign($variable, $value)
{
    $this->data[$variable] = $value;
}

public function __destruct()
{
    extract($this->data);
    
    ob_start();
    require 'app/views/layout/layout_start.php';
    $HTML_START = ob_get_contents();
    ob_end_clean();
    
    ob_start();
    require 'app/views/layout/layout_end.php';
    $HTML_END = ob_get_contents();
    ob_end_clean();

    include($this->render);

}
}