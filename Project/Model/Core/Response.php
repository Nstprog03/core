<?php 

class Model_Core_Response
{
    public function render($content)
    {
        echo $content;
    }

    public function setHeader($key, $value)
    {
        header("$key: $value");
        return $this;
    }
}
