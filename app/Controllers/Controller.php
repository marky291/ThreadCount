<?php
/**
 * Created by PhpStorm.
 * User: markhester
 * Date: 2019-02-15
 * Time: 23:34
 */

namespace App\Controllers;

use Exception;
use App\BladeCompiler;

/**
 * Class Controller
 *
 * @package App\Controllers
 */
abstract class Controller
{
    /**
     * Render a view with variables.
     *
     * @param string $blade
     * @param array $variables
     */
    public function render(string $blade, array $variables)
    {
        try {
            echo BladeCompiler::instance()->run($blade, $variables);
        }
        catch (Exception $e)
        {
            die($e->getMessage());
        }
    }
}