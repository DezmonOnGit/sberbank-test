<?php

namespace Extyl\Spasibo\Partners\Orm;

use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main;
use Bitrix\Main\Entity\ScalarField;
use Exception;
use Extyl\Spasibo\Partners\Entity\Result;

/**
 * Class DataManager
 * @package Malltech\Orm
 */
class DataManager extends Main\ORM\Data\DataManager
{
    protected static $handlers = [];

    public static function addHandler($eventname, $callback)
    {
        $eventname = explode(' ', mb_strtolower($eventname));
        foreach ($eventname as $item) {
            static::$handlers[static::class][$item][] = $callback;
        }
    }

    public static function removeHandler($eventname, $callback = null)
    {
        $eventname = explode(' ', mb_strtolower($eventname));
        foreach ($eventname as $item) {
            if ( ! static::$handlers[static::class][$item]) {
                continue;
            }

            if ( ! $callback) {
                unset(static::$handlers[static::class][$item]);
                continue;
            }

            foreach (static::$handlers[static::class][$item] as $k => $handler) {
                if ($handler === $callback) {
                    unset(static::$handlers[static::class][$item][$k]);
                }
            }
        }
    }

    protected static function triggerEvent($eventName, $stopOnFalse = false, $options = [])
    {
        $eventName = mb_strtolower($eventName);
        $res = true;
        if (is_array(static::$handlers[static::class][$eventName])) {
            foreach (static::$handlers[static::class][$eventName] as $handler) {
                $handlerRes = call_user_func_array($handler, $options);
                $res = $res && $handlerRes;
                if (
                    $stopOnFalse
                    && $handlerRes === false
                ) {
                    break;
                }
            }
        }

        return ! ($stopOnFalse && ! $res);
    }

    /**
     * @param \Bitrix\Main\Result$res
     */
    protected static function clearTags($res)
    {
        if ($res->isSuccess()) {
            bxCacheManager()->ClearByTag(static::getTableName());
        }
    }

    /**
     * @param $filter
     *
     * @return mixed
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    protected static function getRealPrimaries($filter)
    {
        $fieldsList = static::getMap();

        $primaries = [];
        foreach ($fieldsList as $key => $item) {
            if (is_array($item)) {
                if ($item['primary']) {
                    $primaries[] = $key;
                }
            } elseif (
                is_subclass_of($item, ScalarField::class)
                && $item->isPrimary()
            ) {
                $primaries[] = $item->getName();
            }
        }

        $res = static::getList([
            'select' => $primaries,
            'filter' => $filter,
            'limit' => 1,
        ])->fetch()
        ;

        return $res;
    }

    public static function hasTimestamps()
    {
        $hasCreatedAt = false;
        $hasUpdatedAt = false;
        foreach (static::getMap() as $k => $item) {
            if ($item instanceof Main\ORM\Fields\Field) {
                if ($item->getName() === 'created_at') {
                    $hasCreatedAt = true;
                } elseif ($item->getName() === 'updated_at') {
                    $hasUpdatedAt = true;
                }
            } elseif (is_array($item)) {
                if ($k === 'created_at') {
                    $hasCreatedAt = true;
                } elseif ($k === 'updated_at') {
                    $hasUpdatedAt = true;
                }
            }
            if ($hasUpdatedAt && $hasCreatedAt) {
                return true;
            }
        }

        return $hasUpdatedAt && $hasCreatedAt;
    }

    public static function add(array $data)
    {
        if (static::triggerEvent(static::EVENT_ON_BEFORE_ADD, true, [null, &$data])) {

            if (
                ! array_key_exists('created_at', $data)
                && static::hasTimestamps()
            ) {
                $data['created_at'] = new Main\Type\DateTime();
            }
            if (
                ! array_key_exists('updated_at', $data)
                && static::hasTimestamps()
            ) {
                $data['updated_at'] = new Main\Type\DateTime();
            }

            $res = parent::add($data);

            static::triggerEvent(static::EVENT_ON_AFTER_ADD, false, [$res, $res->getPrimary(), $data]);
            static::clearTags($res);
        } else {
            $res = new Main\ORM\Data\AddResult();
            $res
                ->setData($data)
                ->addError(new Main\Error('Prevented by `OnBeforeAdd` handler'))
            ;
        }

        return $res;
    }

    public static function update($primary, array $data)
    {
        if (static::triggerEvent(static::EVENT_ON_BEFORE_UPDATE, true, [&$primary, &$data])) {

            if (
                ! array_key_exists('updated_at', $data)
                && static::hasTimestamps()
            ) {
                $data['updated_at'] = new Main\Type\DateTime();
            }
            $res = parent::update($primary, $data);

            static::triggerEvent(static::EVENT_ON_AFTER_UPDATE, false, [$res, $primary, $data]);
            static::clearTags($res);
        } else {
            $res = new Main\ORM\Data\UpdateResult();
            $res
                ->setData($data)
                ->addError(new Main\Error('Prevented by `OnBeforeUpdate` handler'))
                ->setPrimary($primary)
            ;
        }

        return $res;
    }

    /**
     * @param mixed $primary
     *
     * @return Main\ORM\Data\DeleteResult
     * @throws Exception
     */
    public static function delete($primary)
    {
        if (static::triggerEvent(static::EVENT_ON_BEFORE_DELETE, true, [&$primary, null])) {
            if (is_array($primary)) {
                $primary = static::getRealPrimaries($primary);
            }
            $data = [];
            if (static::$handlers[mb_strtolower(static::EVENT_ON_AFTER_DELETE)]) {
                $data = static::getByPrimary($primary, ['limit' => 1])->fetch();
            }

            $res = parent::delete($primary);

            static::clearTags($res);
            static::triggerEvent(static::EVENT_ON_AFTER_DELETE, false, [$res, $primary, $data]);
        } else {
            $res = new Main\ORM\Data\DeleteResult();
            $res
                ->setData($primary)
                ->addError(new Main\Error('Prevented by `OnBeforeDelete` handler'))
            ;
        }

        return $res;
    }

    /**
     * @param $filter
     *
     * @return Main\ORM\Data\DeleteResult
     * @throws Main\ArgumentException
     * @throws Main\ObjectPropertyException
     * @throws Main\SystemException
     */
    public static function deleteFilter($filter)
    {
        $res = static::getList([
            'filter' => $filter,
        ]);

        while ($row = $res->fetch()) {
            $row = static::getRealPrimaries($row);
            $result = parent::delete($row);
        }

        return $result;
    }

    /**
     * @param       $primary
     * @param array $data
     *
     * @return Main\ORM\Data\AddResult|Main\ORM\Data\UpdateResult
     * @throws Main\ArgumentException
     * @throws Main\ObjectPropertyException
     * @throws Main\SystemException
     */
    public static function addUpdate($primary, $data = [], $add = [])
    {
        $res = static::getList([
            'filter' => $primary,
        ]);

        if ($row = $res->fetch()) {
            $primary = static::getRealPrimaries($row);

            return static::update($primary, $data);
        }

        return static::add(array_merge($primary, $data, $add));
    }

    /**
     * @param $data = [
     *              'primary' => array,
     *              'update' => array,
     *              'add' => array,
     *              ]
     *
     * @return \Bitrix\Main\ORM\Data\AddResult|\Bitrix\Main\ORM\Data\UpdateResult
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ArgumentTypeException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    public static function setData($data)
    {
        return static::addUpdate(
            $data['primary'] ?: [],
            $data['update'] ?: [],
            $data['add'] ?: []
        );
    }

    /**
     * @param $parameters = [
     *                    'select' => [],
     *                    'filter' => [],
     *                    'group' => [],
     *                    'order' => [],
     *                    'limit' => int,
     *                    'offset' => int,
     *                    'runtime' => [],
     *                    'cache' => [],
     *                    'asrequested' => bool,
     *                    ]
     *
     * @return \Bitrix\Main\ORM\Query\Result|\Malltech\Entity\Result
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    public static function getList(array $parameters = [])
    {
        if (
            array_key_exists('select', $parameters)
            && $requested = $parameters['asrequested']
        ) {
            $newSelect = [];
            foreach ($parameters['select'] as $alias => $field) {
                if (is_numeric($alias)) {
                    if ($field === '*') {
                        $newSelect[$alias] = $field;
                        continue;
                    }
                    $newSelect[str_replace(['.UF_*', '.', '*'], ['.', '_dot_', ''], $field)] = $field;
                } else {
                    $newSelect[$alias] = $field;
                }
            }
            $parameters['select'] = $newSelect;
        }

        unset($parameters['asrequested']);

        $result = parent::getList($parameters);

        if ( ! $requested) {
            return $result;
        }

        $array = $result->fetchAll();
        foreach ($array as &$item) {
            $newItem = [];
            foreach ($item as $key => $value) {
                $newItem[str_replace('_dot_', '.', $key)] = $value;
            }
            $item = $newItem;
        }
        unset($item);

        $result = Result::fromBxResult($result, $array);

        return $result;
    }

    /** EXTYL */

    /**
     * @var array
     */
    public $hidden = [];

    /**
     * @var array
     */
    public $select = null;

    /**
     * @var array
     */
    private $data;

    /**
     * @throws Exception
     */
    public function save()
    {
        $result = $this::add($this->data);

        if ( ! $result->isSuccess()) {
            throw new Exception(implode('|', $result->getErrorMessages()));
        } else {
            $this->data['ID'] = $result->getId();
        }
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     *
     * @return $this
     */
    public function new(array $data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return mixed
     * @throws Main\ArgumentException
     * @throws Main\ObjectPropertyException
     * @throws Main\SystemException
     */
    public function getHlId()
    {
        $arHl = HighloadBlockTable::getList(
            [
                'select' => ['ID'],
                'filter' => ['TABLE_NAME' => static::getTableName()],
                'limit' => 1,
            ])->fetch()
        ;

        return $arHl['ID'];
    }

    /**
     * @param array|null $select
     * @param array|null $filter
     * @param int|null   $limit
     * @param int|null   $offset
     * @param array|null $group
     *
     * @return $this
     * @throws Main\ArgumentException
     * @throws Main\ObjectPropertyException
     * @throws Main\SystemException
     */
    public function get(
        array $select = null,
        array $filter = null,
        int $limit = null,
        int $offset = null,
        array $group = null
    ) {
        $parameters = [];

        if ( ! empty($select)) {
            $parameters['select'] = $select;
        } elseif ($this->select) {
            $parameters['select'] = $this->select;
        }

        if ( ! empty($filter)) {
            $parameters['filter'] = $filter;
        }

        if ( ! empty($limit)) {
            $parameters['limit'] = $limit;
        }

        if ( ! empty($offset)) {
            $parameters['offset'] = $offset;
        }

        if ( ! empty($group)) {
            $parameters['group'] = $group;
        }

        $rsItems = static::getList($parameters);

        $this->data = $rsItems->fetchAll();

        return $this;

    }

    /**
     * @param            $id
     * @param array|null $select
     *
     * @return $this
     * @throws Main\ArgumentException
     * @throws Main\ObjectPropertyException
     * @throws Main\SystemException
     */
    public function first($id, array $select = null)
    {
        $filter = [
            '=ID' => $id,
        ];

        return $this->get($select, $filter, 1);
    }

    /**
     * @param            $id
     * @param array|null $select
     *
     * @return $this
     * @throws Main\ArgumentException
     * @throws Main\ObjectPropertyException
     * @throws Main\SystemException
     * @throws Exception
     */
    public function firstOrFail($id, array $select = null)
    {

        if (isset($this->first($id, $select)->getData()[0])) {
            return $this;
        }

        throw new Exception('Not found');
    }

    /**
     * @param array $data
     *
     * @return array
     */
    protected function prepareFields(array $data): array
    {
        $prepared = [];
        foreach (self::getSchema() as $apiKey => $bdKey) {
            if (isset($data[$bdKey])) {
                $prepared[$apiKey] = $data[$bdKey];
            }
        }

        return $prepared;
    }

    /**
     * @param $data
     *
     * @return array
     */
    public static function prepareStatic($data)
    {

        foreach ($data as $k => $v) {
            $nk = $k;
            if (substr($k, 0, 3) === 'UF_') {
                $nk = substr($k, 3);
                $data[$nk] = $v;
            }
            if ($nk != $k) {
                unset($data[$k]);
            }

            if (is_array($v)) {
                $data[$nk] = self::prepareStatic($v);
            }

        }

        return array_change_key_case($data);

    }

    public static function getObjectClass()
    {
        $class = preg_replace('/^(.*?)Orm(\\\\.*)Table$/', '$1Model$2Object', static::class);
        if ( ! class_exists($class)) {
            return static::compileObjectClass(static::class, true);
        }

        return $class;
    }

//    public static function compileObjectClass($dataClass, $internalCall = false)
//    {
//        $dataClass = Entity::normalizeEntityClass($dataClass);
//
//        preg_match('/(.+)(\\\\)([^\\\\]*)/', $dataClass, $matches);
//        $classParts = [
//            'namespace' => $matches[1],
//            'name' => $matches[3],
//        ];
//
//        if ( ! $internalCall && class_exists($dataClass::getObjectClass())
//            && is_subclass_of($dataClass::getObjectClass(), EntityObject::class))
//        {
//            // class is already defined
//            return $dataClass::getObjectClass();
//        }
//
//        $baseObjectClass = '\\'.EntityObject::class;
//        $objectClassName = preg_replace('/table$/i', 'Object', $classParts['name']);
//        $classParts['namespace'] = ltrim(str_ireplace('orm', 'Model', $classParts['namespace']), '\\');
//        $fullname = '\\' . $classParts['namespace'] . '\\' . $objectClassName;
//
//        $eval = '';
//        if($classParts['namespace'] <> '')
//        {
//            $eval .= "namespace {$classParts['namespace']} {\n";
//        }
//        $eval .= "class {$objectClassName} extends {$baseObjectClass} {\n";
//        $eval .= "static public \$dataClass = '{$dataClass}';\n";
//
//        foreach ($dataClass::getMap() as $k => $value) {
//            if ($value instanceof ScalarField) {
//
//                $basetype = null;
//                if (
//                    $value instanceof Main\ORM\Fields\StringField
//                    && $value->isSerialized() !== true
//                ) {
//                    $basetype = 'string';
//                }
////                if (
////                    $value instanceof Main\ORM\Fields\StringField
////                    && $value->isSerialized() === true
////                ) {
////                    $basetype = 'array';
////                }
//                if ($value instanceof Main\ORM\Fields\IntegerField) {
//                    $basetype = 'int';
//                }
//
//                $eval .= 'public function get' . Strings::toCamelUpper(Strings::fromSnake($value->getName())) . '()'.($basetype !== null ? ':?' . $basetype : '').' {';
//                $eval .= 'return $this->__call(__FUNCTION__, func_get_args());}'."\n";
//                $eval .= 'public function set'
//                    . Strings::toCamelUpper(Strings::fromSnake($value->getName())) . '($value = null)'.':'.$fullname.' {';
//                $eval .= '$this->_currentValues[\''.$value->getName().'\'] = $value;return $this;}'."\n";
//                $eval .= 'public function has'
//                    . Strings::toCamelUpper(Strings::fromSnake($value->getName())) . '($value = null)'.':bool {';
//                $eval .= 'return $this->__call(__FUNCTION__, func_get_args());}'."\n";
//                $eval .= 'public function fill' . Strings::toCamelUpper(Strings::fromSnake($value->getName())) . '() {';
//                $eval .= 'return $this->__call(__FUNCTION__, func_get_args());}'."\n";
//                $eval .= 'public function addTo'
//                    . Strings::toCamelUpper(Strings::fromSnake($value->getName())) . '($value = null) {';
//                $eval .= 'return $this->__call(__FUNCTION__, func_get_args());}'."\n";
//                $eval .= 'public function unset'
//                    . Strings::toCamelUpper(Strings::fromSnake($value->getName())) . '() {';
//                $eval .= 'return $this->__call(__FUNCTION__, func_get_args());}'."\n";
//                $eval .= 'public function reset'
//                    . Strings::toCamelUpper(Strings::fromSnake($value->getName())) . '() {';
//                $eval .= 'return $this->__call(__FUNCTION__, func_get_args());}'."\n";
//            }
//        }
//
//        $eval .= "}\n"; // end class
//        if($classParts['namespace'] <> '')
//        {
//            $eval .= "}\n"; // end namespace
//        }
//
//        $path = ltrim($classParts['namespace'], '\\');
////        dd($path);
//        $path = mb_substr($path, mb_strlen(malltech()::getBaseNamespace()));
//        $path = malltech()::getBaseDir() . str_replace('\\', '/', $path);
//        if ( ! file_exists($path)) {
//
//            if ( ! mkdir($path, BX_DIR_PERMISSIONS, true) && ! is_dir($path)) {
//                throw new \RuntimeException(sprintf('Directory "%s" was not created', $path));
//            }
//        }
//
//        file_put_contents($path . '/' . $objectClassName . '.php', '<?php '.$eval);
//        require_once $path . '/' . $objectClassName . '.php';
//
//        return $fullname;
//    }

    /**
     * @param array $data
     *
     * @return array|bool|int
     */
    public function prepare()
    {
        return self::prepareStatic($this->data);
    }

    /**
     * @param array $data
     * @param array $hidden
     *
     * @return array
     */
    public static function clearStatic(array $data, array $hidden)
    {
        $result = [];

        foreach ($data as $k => $v) {

            $result[$k] = array_diff_key($v, array_flip($hidden));

        }

        return $result;
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function clear()
    {
        return self::clearStatic($this->data, $this->hidden);
    }
}