<?php

namespace app\controllers;

use app\components\BaseController;
use app\components\Session;
use app\models\AdminModel;
use app\models\TaskModel;

class SiteController extends BaseController
{
    /**
     * @return bool
     */
    public function actionIndex()
    {

        if ($_POST) {
            $task = new TaskModel();
            $task->load($_POST);
            if ($task->save()) {
                $this->redirect('/');
            }
            echo '<pre>';
            print_r($task->getErrorMessages());
            die;
        }

        $sort = $_GET['sort'] ?? '';
        $dir = $_GET['dir'] ?? '';;

        $page = $_GET['page'] ?? 1;
        $page = intval($page);
        if (!$page) {
            $page = 1;
        }


        $taskModel = new TaskModel();
        $totalCount = $taskModel->getTotalCount();
        $totalPages = ceil($totalCount / ROW_PER_PAGE);

        if ($page > $totalPages) {
            $page = $totalPages;
        }

        $offset = ($page - 1) * ROW_PER_PAGE;


        $tasks = $taskModel->findAll($offset, ROW_PER_PAGE, $sort, $dir);
        $isAdmin = Session::getValue('adminId');

        return $this->render('index', compact('tasks', 'page', 'totalPages', 'sort', 'dir', 'isAdmin'));
    }

    public function actionLogin()
    {
        $admin = new AdminModel();

        if ($_POST) {
            $admin->load($_POST);
            if ($admin->validate()) {
                Session::setValue('adminId', $admin->id);
                $this->redirect('/');
            }
        }
        return $this->render('login', compact('admin'));
    }

    public function actionLogout()
    {
        Session::destroy();
        $this->redirect('/');
    }
}

