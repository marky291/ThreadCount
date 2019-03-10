<?php
/**
 * @author: Mark Hester
 * @kNumber: k00233238
 * @date: 16th February 2019
 * @project: Design a framework and website.
 * @tutor: Brendan Watson
 */

    /**
     * Define where the base path is for loading the bootstrap.
     */
    define('base_path', __DIR__ . '/../');

    /**
     * Composer autoloader (modern design)
     * This eliminates the old messy includes.
     */
    require base_path . 'vendor/autoload.php';

    /**
     * We need to autoload all classes and objects
     * before the sessions starts to allow
     * serialization of objects in the session.
     */
    session_start();

    /**
     * Singleton design for user sessions, since our lifecycle
     * only expects the one instance of a user to ever exist.
     *
     * This singleton design allows usage across multiple files.
     *
     * @note: You can use auth() helper for shorthand version.
     */
    App\Classes\Auth::instance()->setUserSession($_SESSION['user']);

    /**
     * The router is responsible for handling the url
     * and assigning the controller and method names.
     */
    $router = new App\Classes\RouteProvider($_SERVER['PHP_SELF']);

    /**
     * The current request information such as get requests,
     * post requests etc..
     */
    $request = new App\Classes\Request($_GET, $_POST, $_SESSION);

    /**
     * Framework is the glue of the application and brains
     * The app will handle the dispatch of the router to
     * the designated class it provided.
     */
    $app = new App\Framework($router);

    /**
     * From here on the application is handled by the
     * controller which will return a view to the user.
     */
    $app->dispatchController($request);

