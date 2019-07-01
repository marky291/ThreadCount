<?php
/**
 * Created by PhpStorm.
 * User: markhester
 * Date: 2019-02-16
 * Time: 00:24
 */

namespace App;

use App\Classes\Request;
use App\Classes\Routing;
use App\Controllers\ErrorController;
use App\Exceptions\DatabaseQueryException;
use App\Exceptions\Exception;
use App\Exceptions\UnauthorizedException;
use App\Interfaces\RoutingInterface;
use eftec\bladeone\BladeOne;

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
     * @param Routing $router
     */
    public function __construct(Routing $router)
    {
        $this->router = $router;
    }

    /**
     * This dispatches the controller on the framework, which
     * handles the rest of the response.
     *
     * @param Request $request
     * @param BladeOne $template
     * @return mixed
     */
    public function dispatchController(Request $request, BladeOne $template)
    {
        try {

            $controller = $this->router->controller();

            if (class_exists($controller) && method_exists($controller, $this->router->action())) {
                return (new $controller($request, $template))->{$this->router->action()}();
            }

            return (new ErrorController($request, $template))->PageNotFound();

        }
        catch (DatabaseQueryException $e)
        {
            return (new ErrorController($request, $template))->DatabaseError($e->getMessage());
        }
        catch (UnauthorizedException $e)
        {
            return (new ErrorController($request, $template))->UnauthorizedError();
        }
    }
}