<?php

    /**
     * Returns the singleton object for compiling the views in blade format.
     *
     * @param string $blade
     * @param array $variables
     * @return string
     */
    function view(string $blade, array $variables)
    {
        try {
            echo App\BladeCompiler::instance()->run($blade, $variables);
        }
        catch (Exception $e)
        {
            die($e->getMessage());
        }
    }