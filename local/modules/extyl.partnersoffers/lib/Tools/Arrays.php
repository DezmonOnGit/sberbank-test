<?php
/**
 * @author Alex Yashin <ayashin@extyl-pro.ru>
 * Date: 04.06.2019
 * Time: 14:33
 */

namespace Extyl\Spasibo\Partners\Tools;

class Arrays
{
    /**
     * The fastest way to check if array is multidimensional or not
     *
     * @param $arr
     *
     * @return bool
     */
    public static function isMultiArray($arr)
    {
        if (is_array($arr))
        {
            foreach ($arr as $item)
            {
                if ( ! is_array($item))
                {
                    return false;
                }
            }
        }
        else
        {
            return false;
        }

        return true;
    }

    /**
     * Sorts array keys withing $keys
     *
     * Example:
     *     static::sortByKeyOrder(
     *         [
     *             'b' => 1,
     *             'a' => '4',
     *             'hello' => true,
     *             'c' => []
     *         ],
     *         ['hello', 'a', 'b', 'c']
     *     )
     * will return
     *     [
     *         'hello' => true,
     *         'a' => '4',
     *         'b' => 1,
     *         'c' => [],
     *     ]
     *
     * @param array $array
     * @param string[]|int[] $order
     * @param bool $filter
     *
     * @return array
     */
    public static function sortByKeyOrder($array, $order, $filter = true)
    {
        $sorter = function($ar) use ($order, $filter)
        {
            $arr = [];
            foreach ($order as $key)
            {
                if (
                    ! $filter
                    || (
                        $filter
                        && array_key_exists($key, $ar)
                    )
                ) {
                    $arr[$key] = $ar[$key];
                }
            }

            if ( ! $filter)
            {
                foreach ($ar as $key => $value)
                {
                    if ( ! array_key_exists($key, $arr))
                    {
                        $arr[$key] = $value;
                    }
                }
            }

            return $arr;
        };

        $return = [];
        if (static::isMultiArray($array))
        {
            foreach ($array as $item)
            {
                $return[] = $sorter($item);
            }
        }
        else
        {
            $return = $sorter($array);
        }

        return $return;
    }

    /**
     * Sorts multideminsional array items just like SQL `ORDER BY $key $direction` does
     *
     * @param array[]    $array
     * @param string|int $key
     * @param int        $direction
     *
     * @return array
     */
    public static function sortByInternalKey($array, $key, $direction = SORT_ASC, $autocast = false)
    {
        if ( ! static::isMultiArray($array))
        {
            throw new \InvalidArgumentException('$array must be a multidimensional array');
        }

        if (
            $direction !== SORT_ASC
            && $direction !== SORT_DESC
        ) {
            throw new \InvalidArgumentException('$direction must be equal to either SORT_ASC or SORT_DESC');
        }

        uasort($array, function($a, $b) use ($key, $direction, $autocast) {

            $vA = $a[$key];
            $vB = $b[$key];

            if ($autocast)
            {
                $vA = static::autocast($vA);
                $vB = static::autocast($vB);
            }

            if ($vA == $vB)
            {
                return 0;
            }

            return (
                (
                    $vA > $vB
                    && $direction === SORT_ASC
                )
                || (
                    $vA < $vB
                    && $direction === SORT_DESC
                )
            ) ? 1 : -1;
        });

        return $array;
    }

    /**
     * Sorts multidimensional array items by $key in certain $order
     *
     * @param array[]        $array
     * @param string|int     $key
     * @param string[]|int[] $order
     *
     * @return array
     */
    public static function sortByInternalKeyOrder($array, $key, $order, $filter = false)
    {
        if ( ! static::isMultiArray($array))
        {
            throw new \InvalidArgumentException('$array must be a multidimensional array');
        }

        $order = array_flip($order);

        uasort($array, function($a, $b) use ($key, $order) {

            if ($order[$a[$key]] == $order[$b[$key]])
            {
                return 0;
            }

            return ($order[$a[$key]] > $order[$b[$key]]) ? 1 : -1;
        });

        if ($filter)
        {
            $order = array_flip($order);

            foreach ($array as $k => $value)
            {
                if ( ! in_array($value[$key], $order))
                {
                    unset($array[$k]);
                }
            }
        }

        return $array;
    }

    /**
     * Makes plain array from any data
     * Multidimensional arrays are also converted to plain
     *
     * @param mixed $arr
     *
     * @return array
     */
    public static function toPlain($arr)
    {
        $result = [];

        if ( ! is_array($arr))
        {
            $arr = [$arr];
        }

        foreach ($arr as $v)
        {
            if (is_array($v))
            {
                $result = array_merge($result, static::toPlain($v));
            }
            else
            {
                $result[] = $v;
            }
        }

        return $result;
    }

    protected static function autocast($val)
    {
        if ($time = strtotime($val))
        {
            return $time;
        }
        if (is_numeric($val))
        {
            if (
                strpos($val, '.') !== false
                || strpos($val, ',') !== false
            ) {
                return (float) $val;
            }
            return (int) $val;
        }
        return $val;
    }
}
