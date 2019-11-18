<?php


namespace Libs\Views;


use Config\DirectorySettings;

class View
{
    protected array $_defaultData = [];

    public function __construct()
    {
        $this->_defaultData['escape'] = $this->escape();
    }

    public function render($_file_path_after_templates_dir, $_data = array())
    {
        $_file = DirectorySettings::TEMPLATES_ROOT_DIR
            . $_file_path_after_templates_dir . '.tmp.php';

        extract(array_merge($this->_defaultData, $_data));

        ob_start();
        ob_implicit_flush(0);
        require $_file;
        $content = ob_get_clean();

        return $content;
    }

    public function escape()
    {
        return function ($string, $echo = true) {
            $value = htmlspecialchars($string, ENT_QUOTES < 'UTF-8');
            if (!$echo)
                return $value;
            echo $value;
        };
    }
}