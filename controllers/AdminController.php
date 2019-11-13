<?php

namespace app\controllers;

use app\components\BaseController;
use app\components\Session;
use app\models\TaskModel;

class AdminController extends BaseController
{
    public function __construct($name)
    {
        parent::__construct($name);

        if (!Session::getValue('adminId')) {
            $this->redirect('/site/login');
        }
    }

    public function actionEdit($id)
    {
        $model = TaskModel::findById($id);
        if (!$model) {
            throw new \Exception('Not Found!!!!');
        }
        if ($_POST) {
            $oldText = $model->content;
            $model->load($_POST);
            if ($oldText != $model->content) {
                $model->status = TaskModel::STATUS_CHANGED;
            }
            $model->save();
            $this->redirect('/');
        }
        return $this->render('edit', compact('model'));
    }

    public function actionApprove($id)
    {
        $model = TaskModel::findById($id);
        if (!$model) {
            throw new \Exception('Not Found!!!!');
        }
        $model->status = TaskModel::STATUS_DONE;
        $model->save();
        $this->redirect('/');
    }


}

