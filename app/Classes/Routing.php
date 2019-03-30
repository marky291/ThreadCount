<?php
/**
 * Created by PhpStorm.
 * User: markhester
 * Date: 2019-02-15
 * Time: 23:32
 */

namespace App\Classes;

use App\Interfaces\RoutingInterface;

/**
 * Class RequestRouter
 *
 * @package App
 */
class Routing implements RoutingInterface
{
    /**
     * @var string
     */
    private $fragments;

    /**
     * The default controller that will be used if no controller specified.
     *
     * @var string
     */
    private $defaultController = 'Threads';

    /**
     * The default method that will be used if no method specified.
     *
     * @var string
     */
    private $defaultControllerMethod  = 'index';

    /**
     * RequestRouter constructor.
     *
     * @param string $route
     */
    public function __construct(string $route)
    {
        $this->fragments = $this->explodeRoute($route);
    }

    /**
     * The controller named formed from the route.
     *
     * @return mixed
     */
    public function controller()
    {
        if ($this->hasValidControllerName()) {
            return $this->controllerNamespace($this->controllerName());
        }

        return $this->controllerNamespace($this->defaultController);
    }

    /**
     * Return a class namespace as autoloader would oad.
     *
     * @param string $toClass
     * @return string
     */
    private function controllerNamespace(string $toClass): string
    {
        return "App\\Controllers\\{$toClass}Controller";
    }

    /**
     * The method name formed by the route.
     *
     * @return mixed
     */
    public function action()
    {
        if (isset($this->fragments[1])) {
            return ucfirst($this->fragments[1]);
        }

        return $this->defaultControllerMethod;
    }

    /**
     * Explode the string and for parts.
     *
     * @param string $route
     * @return array
     */
    private function explodeRoute(string $route): array
    {
        return explode('/', ltrim($route, '/'));
    }

    /**
     * @return bool
     */
    private function hasValidControllerName(): bool
    {
        return isset($this->fragments[0]) && $this->fragments[0] !== '';
    }

    /**
     * Get the controller name.
     *
     * @return string
     */
    public function controllerName(): string
    {
        return ucfirst($this->fragments[0]);
    }
}