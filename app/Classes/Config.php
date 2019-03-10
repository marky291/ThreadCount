<?php
/**
 * Created by PhpStorm.
 * User: markhester
 * Date: 2019-03-06
 * Time: 16:46
 */

namespace App\Classes;

use Adbar\Dot;

/**
 * Class Configuration
 *
 * @package App
 */
class Config
{
    /**
     * Holds the configuration keys and their values created
     * by their file counterparts from the config folder.
     *
     * @var Dot
     */
    public $items;

    /**
     * Singleton Instance
     *
     * @var Config
     */
    private static $instance;

    /**
     * Config constructor.
     *
     * @param string $folder
     */
    public function __construct(string $folder)
    {
        $this->items = new Dot;

        $this->loadConfigurationFileFrom($folder);
    }

    /**
     * Singleton Class design
     *
     * Allows only once instance to exist and be used throughout the whole app.
     *
     * Since this is a small application and we are only loading from a static directory,
     * but gives cleaner coding and nice dynamic design.
     *
     * @return Config
     */
    public static function instance(): Config
    {
        return self::$instance ?? self::$instance = new self(__DIR__ . '/../../config/');
    }

    /**
     * Load all files from directory as a configuration location
     *
     * We merge the key as the file name, and the contents as the value.
     *
     * Dot notation is used for all stuff relating to the configuration items.
     *
     * @param string $folder
     */
    private function loadConfigurationFileFrom(string $folder)
    {
        $files = scandir($folder, SCANDIR_SORT_ASCENDING);

        foreach ($files as $file) {
            if (is_file($folder . $file)) {
                $this->items->merge(pathinfo($file, PATHINFO_FILENAME), include $folder . $file);
            }
        }
    }
}