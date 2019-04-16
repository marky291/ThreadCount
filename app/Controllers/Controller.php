<?php
/**
 * Created by PhpStorm.
 * User: markhester
 * Date: 2019-02-15
 * Time: 23:34
 */

namespace App\Controllers;

use App\Classes\Request;
use App\Gates\GateInterface;
use App\Gates\GuestAccessGate;
use App\Gates\UserAccessGate;
use App\Gates\RequestPostGate;
use eftec\bladeone\BladeOne;
use App\Exceptions\Exception;
use App\Exceptions\GateNotFoundException;

/**
 * Class Controller
 *
 * @package App\Controllers
 */
abstract class Controller
{
    /**
     * @var array
     */
    protected $gates = [
        'auth' => UserAccessGate::class,
        'guest' => GuestAccessGate::class,
        'post' => RequestPostGate::class,
    ];

    /**
     * Information about current request.
     *
     * @var Request
     */
    protected $request;

    /**
     * @var BladeOne
     */
    protected $template;

    /**
     * Controller constructor.
     *
     * @param Request $request
     * @param BladeOne $blade
     */
    public function __construct(Request $request, BladeOne $blade)
    {
        $this->request = $request;

        $this->template = $blade;
    }

    /**
     * Render a view with variables.
     *
     * @param string $blade
     * @param array $variables
     */
    public function render(string $blade, array $variables = []): void
    {
        try {
            echo $this->template->run($blade, $variables);
        }  catch (\Exception $e) {
            die($e->getMessage());
        }
    }

    public function respondWithJson(array $attributes)
    {
        header('Content-type: application/json');

        echo json_encode($attributes);
    }

    /**
     * Security gates requiring authorization and checks.
     *
     * @param array $guards
     * @return Controller
     */
    public function gates($guards = []): Controller
    {
        if (!is_array($guards)) {
            throw new GateNotFoundException('Gates must be in array format');
        }

        foreach ($guards as $guard)
        {
            if (isset($this->gates[$guard]))
            {
                /** @var GateInterface $class */
                $class = new $this->gates[$guard];

                // each gate must be authorized to continue request.
                $class->authorize();

                return $this;
            }
            else
            {
                throw new GateNotFoundException("Unable to locate gate key '{$guard}'");
            }
        }

        return $this;
    }
}