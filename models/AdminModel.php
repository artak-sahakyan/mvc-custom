<?php

namespace app\models;

use app\components\BaseModel;
use app\components\Database;

class AdminModel extends BaseModel
{

    public $username;
    public $password;

    protected $requiredFields = [
        'username',
        'password'
    ];

    public function getTableName()
    {
        return 'admins';
    }

    public function validate()
    {
        $this->checkRequiredFields();

        if ($this->checkValid()) {
            $db = Database::getDb();
            $admin = $db->fetch_single_row($this->getTableName(), 'username', $this->username);
            if (!$admin) {
                $this->errorMessages['username'] = 'Invalid username or password';
                return false;
            }
            if (!password_verify($this->password, $admin->password_hash)) {
                $this->errorMessages['username'] = 'Invalid username or password';
                return false;
            }
            $this->id = $admin->id;

            return true;
        }

        return false;
    }

}