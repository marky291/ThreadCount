<?php
/**
 * Created by PhpStorm.
 * User: markhester
 * Date: 2019-02-10
 * Time: 12:18
 */

namespace App\Classes;

use eftec\bladeone\BladeOne;

/**
 * Class Blade
 *
 * @package App
 */
class Template extends BladeOne
{
    /**
     * Location to store the compiled blade files.
     *
     * @var string
     */
    private static $compiled_path = '../views/compiled';

    /**
     * BladeView constructor.
     *
     * @param null $template_path
     */
    public function __construct($template_path = null)
    {
        parent::__construct($template_path, self::$compiled_path);
    }
}