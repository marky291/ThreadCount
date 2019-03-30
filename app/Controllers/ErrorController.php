<?php
/**
 * Created by PhpStorm.
 * User: markhester
 * Date: 2019-03-30
 * Time: 11:29
 */

namespace App\Controllers;

/**
 * Class ErrorController
 *
 * @package App\Controllers
 */
class ErrorController extends Controller
{
    public function PageNotFound(): void
    {
        $this->render('errors.404', ['message' => 'Uh oh! Page not found!']);
    }
}