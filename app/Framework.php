<?php
/**
 * Created by PhpStorm.
 * User: markhester
 * Date: 2019-02-16
 * Time: 00:24
 */

namespace App;

use App\Classes\Request;
use App\Classes\RouteProvider;
use App\Interfaces\RoutingInterface;

/**
 * Class Framework
 *
 * @package App
 */
class Framework
{
    /**
     * @var RoutingInterface
     */
    private $router;

    /**
     * Framework constructor.
     *
     * @param RouteProvider $router
     */
    public function __construct(RouteProvider $router)
    {
        $this->router = $router;
    }

    /**
     * This dispatches the controller on the framework, which
     * handles the rest of the response.
     *
     * @param Request $request
     * @return mixed
     */
    public function dispatchController(Request $request)
    {
        $controller = __NAMESPACE__.'\\Controllers\\'.$this->router->controller();

        //@todo: catch failures as 404 page.

        return (new $controller($request))->{$this->router->action()}();
    }
}