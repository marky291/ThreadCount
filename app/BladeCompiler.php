<?php
/**
 * Created by PhpStorm.
 * User: markhester
 * Date: 2019-02-10
 * Time: 12:18
 */

namespace App;

use eftec\bladeone\BladeOne;

/**
 * Class Blade
 *
 * @package App
 */
class BladeCompiler
{
    /**
     * @var BladeOne
     */
    private static $blade;

    /**
     * Location to store the compiled blade files.
     *
     * @var string
     */
    private static $compiled_path = '../views/compiled';

    /**
     * Location where the blade files can be found.
     *
     * @var string
     */
    private static $template_path = '../views/';

    /**
     * Singleton architecture for the blade view compiler.
     *
     * @return BladeOne
     */
    public static function instance(): BladeOne
    {
        if (self::$blade)
        {
            return self::$blade;
        }

        return self::$blade = new BladeOne(self::$template_path, self::$compiled_path);
    }
}