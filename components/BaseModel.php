<?php
namespace app\components;

use ReflectionObject;
use ReflectionProperty;

abstract class BaseModel
{

    protected $properties = [];
    protected $errorMessages = [];

    protected $requiredFields = [];
    protected $filterFields = [];

    public $id;

    abstract public function getTableName();

    public function __construct()
    {
        $this->getProperties();
    }

    public function getProperties()
    {
        $reflection = new ReflectionObject($this);
        $properties = $reflection->getProperties(ReflectionProperty::IS_PUBLIC);
        foreach ($properties as $property) {
            $propertyName = $property->getName();
            $this->properties[$propertyName] = $this->$propertyName;
        }
        return $this->properties;
    }

    public function load($data = [])
    {
        foreach ($data as $property => $value) {
            if($this->propertyExists($property)) {
                $this->$property = $value;
            }
        }
    }

    protected function propertyExists($property)
    {
        return array_key_exists($property, $this->properties);
    }

    abstract public function validate();

    public function checkValid()
    {
        return $this->errorMessages ? false : true;
    }

    public function save()
    {

        if(!$this->validate()) {
            return false;
        }
        $db = Database::getDb();
        if(!$this->id) {

            $properties = $this->getProperties();
            unset($properties['id']);
            $db->insert($this->getTableName(), $properties);
            $this->id = $db->get_last_id();
        } else {
            $db->update($this->getTableName(), $this->getProperties(), $this->id);
        }

        return $this->id;
    }

    protected function checkRequiredFields()
    {
        foreach ($this->requiredFields as $requiredField) {
            if(!$this->$requiredField) {
                $this->errorMessages[$requiredField] = $requiredField.' is required to fill';
            }
        }
    }

    protected function filterFields()
    {
        foreach ($this->filterFields as $filterField) {
            $this->$filterField = htmlentities(trim($this->$filterField));
        }
    }

    public function getErrorMessages()
    {
        return $this->errorMessages;
    }

    public function findAll($offset, $perPage, $sort, $dir)
    {
        $db = Database::getDb();

        $sortQuery = '';
        if($sort && $this->propertyExists($sort)) {
            $dir = $dir == 'asc' ? $dir : 'desc';
            $sortQuery = "ORDER BY $sort $dir";
        }

        $items = $db->fetch_all($this->getTableName(), $offset, $perPage, $sortQuery);
        $data = [];

        foreach ($items as $item) {
            $model = new static();
            $model->load($item);
            $data[] = $model;
        }
        return $data;
    }

    public function getTotalCount()
    {
        $db = Database::getDb();
        return $db->total_count($this->getTableName());
    }

    public static function getSortLink($name, $page, $currentSort, $currentDir)
    {
        return '/?'.http_build_query([
            'page' => $page,
            'sort' => $name,
            'dir' => ($currentSort == $name && $currentDir == 'asc') ? 'desc' : 'asc'
        ]);
    }


}