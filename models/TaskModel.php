<?php

namespace app\models;

use app\components\BaseModel;
use app\components\Database;

class TaskModel extends BaseModel
{
    const STATUS_NEW = 0;
    const STATUS_DONE = 1;
    const STATUS_CHANGED = 2;

    public $name;
    public $email;
    public $content;
    public $status = 0;

    protected $requiredFields = [
        'name',
        'email',
        'content'
    ];

    protected $filterFields = [
        'name',
        'email',
        'content'
    ];


    public function getTableName()
    {
        return 'tasks';
    }

    public function validate()
    {
        $this->checkRequiredFields();

        if ($this->email && !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->errorMessages['email'] = 'Invalid email format';
        }
        $this->filterFields();

        return $this->checkValid();
    }

    public static function getStatusLabels()
    {
        return [
            self::STATUS_NEW => 'новый',
            self::STATUS_DONE => 'выполнено',
            self::STATUS_CHANGED => 'отредактировано администратором',
        ];
    }

    public function getStatusLabel()
    {
        return self::getStatusLabels()[$this->status] ?? '';
    }

    public static function findById($id)
    {
        $db = Database::getDb();
        $data = $db->fetch_single_row('tasks', 'id', $id);
        if ($data) {
            $task = new TaskModel();
            $task->load($data);
            return $task;
        }
        return null;

    }
}