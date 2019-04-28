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
        $this->render('errors.404', ['message' => "Uh oh! That page couldn't be found!"]);
    }

    public function DatabaseError(string $error_message): void
    {
        $this->render('errors.database', ['message' => $error_message]);
    }

    public function UnauthorizedError(): void
    {
        $this->render('errors.unauthorized', ['message' => 'HALT! You are not allowed to be here.']);
    }
}