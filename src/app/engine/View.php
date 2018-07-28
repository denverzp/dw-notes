<?php

namespace DWNotes\App\Engine;

/**
 * Class View.
 */
class View
{
    private $template;

    /**
     * View constructor.
     *
     * @param $template
     */
    public function __construct($template)
    {
        $this->template = DW_NOTES_DIR.$template;
    }

    /**
     * @param array $data
     */
    public function render(array $data)
    {
        if (file_exists($this->template)) {

            extract($data, EXTR_OVERWRITE);

            ob_start();

            require $this->template;

            $output = ob_get_contents();

            ob_end_clean();

            return $output;
        }

        trigger_error('Error: Could not load template '.$this->template.'!');
        exit();
    }
}
