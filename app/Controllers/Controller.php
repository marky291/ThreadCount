<?php
/**
 * Created by PhpStorm.
 * User: markhester
 * Date: 2019-02-15
 * Time: 23:34
 */

namespace App\Controllers;

use App\Classes\Request;
use Exception;
use App\Classes\BladeCompiler;

/**
 * Class Controller
 *
 * @package App\Controllers
 */
abstract class Controller
{

    /**
     * Information about current request.
     *
     * @var Request
     */
    protected $request;

    /**
     * Controller constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

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