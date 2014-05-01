<?php namespace ConnorVG\Transform;

/**
 * Class Transform
 * @package ConnorVG\Transform
 */
class Transform {

    /**
     * @param array $array
     * @param array $defs
     * @param array $aliases
     *
     * @return array
     */
    public static function make($array, Array $defs, Array $aliases = null)
    {
        $toLoop = $array;
        if (!is_array($array))
            if (method_exists($array, 'toArray'))
                $toLoop = $array->toArray();
            else
                return $array;

        $ret = [];

        foreach ($toLoop as $key => $val)
        {
            $n_val = $val;
            $n_name = $key;

            if (is_int($key))
            {
                $inner_defs = isset($defs[0]) ? $defs[0] : [];
                $inner_aliases = isset($aliases[0]) ? $aliases[0] : null;
            }
            else
            {
                $inner_defs = self::define($n_name, $n_val, $defs);
                $inner_aliases = self::alias($n_name, $aliases);
            }

            if (is_array($val))
                $n_val = self::make($n_val, $inner_defs, $inner_aliases);

            if ($n_name !== null)
                $ret[$n_name] = $n_val;
        }

        return $ret;
    }

    /**
     * @param $key
     * @param $alias
     *
     * @return mixed
     */
    private static function alias(&$key, $alias)
    {
        if (!$alias)
            return null;

        if (!array_key_exists($key, $alias))
            return null;

        $old = $key;

        if (is_array($alias[$old]))
        {
            $key = isset($alias[$old][0]) ? $alias[$old][0] : $old;
            $alias = isset($alias[$old][1]) ? $alias[$old][1] : null;
        }
        else
            $key = $alias[$old];

        return $alias;
    }

    /**
     * @param $key
     * @param $val
     * @param $def
     *
     * @return array
     */
    private static function define(&$key, &$val, $def)
    {
        if (!$def)
            return [];

        if (!isset($def[$key]))
            return [];

        if (is_array($def[$key]))
            return $def[$key];

        settype($val, $def[$key]);

        return [];
    }

}
