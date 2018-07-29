<?php

namespace DWNotes\App\Engine;

if (!function_exists('view')) {
    /**
     * @param $template
     * @param array $data
     *
     * @return string
     */
    function view($template, array $data = [])
    {
        $view = new \DWNotes\App\Engine\View($template);

        return $view->render($data);
    }
}
