<?php namespace ConnorVG\Transform;

use Illuminate\Support\Facades\Facade;

/**
 * Class TransformFacade
 * @package ConnorVG\Transform
 */
class TransformFacade extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'transform'; }

}
