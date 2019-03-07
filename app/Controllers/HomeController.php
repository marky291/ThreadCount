<?php
/**
 * Created by PhpStorm.
 * User: markhester
 * Date: 2019-02-27
 * Time: 17:16
 */

namespace App\Controllers;

/**
 * Class HomeController
 *
 * @package App\Controllers
 */
class HomeController extends Controller
{
    public function index()
    {
        $this->render('master', ['variable' => 'Framework loaded']);
    }
}