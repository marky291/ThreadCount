<?php
/**
 * Created by PhpStorm.
 * User: markhester
 * Date: 2019-02-16
 * Time: 01:15
 */

namespace App\Interfaces;

/**
 * Interface RoutingInterface
 *
 * @package App\Interfaces
 */
interface RoutingInterface
{
    /**
     * The controller named formed from the route.
     *
     * @return mixed
     */
    public function controller();

    /**
     * The method name formed by the route.
     *
     * @return mixed
     */
    public function method();
}