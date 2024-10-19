<?php

class Controller{
    protected function load($view, $data = []) {
        // Extract data array to variables available in the view
        extract($data);

        // Include the requested view file
        $viewPath = 'public/views/' . $view . '.php';

        var_dump($viewPath);

        if (file_exists($viewPath)) {
            include $viewPath;
        } else {
            // Show error if view file does not exist
            echo "View not found: $view";
        }
    }
}