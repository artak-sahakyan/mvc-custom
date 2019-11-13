<?php
/* @var \app\models\TaskModel[] $tasks */
/* @var  $page */
/* @var  $totalPages */
/* @var  $sort */
/* @var  $dir */

/* @var  $isAdmin */

use app\components\BaseModel;

?>

<div class="container white-block">
    <p class="pull-right">
        <?php if ($isAdmin): ?>
            <a class="btn btn-danger" href="/site/logout">Log Out </a>
        <?php else: ?>
            <a class="btn btn-success" href="/site/login">Admin Log In </a>
        <?php endif; ?>
    </p>
    <h1 class="text-center">Tasks</h1>

    <table class="table table-striped">
        <thead>
        <tr>
            <th><a href="<?= BaseModel::getSortLink('name', $page, $sort, $dir) ?>">Name <i
                        class="fa fa-fw fa-sort"></i></a></th>
            <th><a href="<?= BaseModel::getSortLink('email', $page, $sort, $dir) ?>">Email <i
                        class="fa fa-fw fa-sort"></i></a></th>
            <th><a href="<?= BaseModel::getSortLink('content', $page, $sort, $dir) ?>">Text <i
                        class="fa fa-fw fa-sort"></i></a></th>
            <th><a href="<?= BaseModel::getSortLink('status', $page, $sort, $dir) ?>">Status <i
                        class="fa fa-fw fa-sort"></i></a></th>
            <?php if ($isAdmin): ?>
                <th>Edit</th>
            <?php endif; ?>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($tasks as $task): ?>
            <tr>
                <td><?= $task->name ?></td>
                <td><?= $task->email ?></td>
                <td><?= $task->content ?></td>
                <td><?= $task->getStatusLabel() ?></td>
                <?php if ($isAdmin): ?>
                    <th>
                        <a href="/admin/edit/<?=$task->id?>" class="btn btn-primary">Edit</a>
                        <a href="/admin/approve/<?=$task->id?>" class="btn btn-success">Mark as Approved</a>
                    </th>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <nav aria-label="Page navigation">
        <ul class="pagination">
            <li>
                <?php if ($page > 1): ?>
                    <a class="page-link" href="/?page=<?= $page - 1 ?>&sort=<?= $sort ?>&dir=<?= $dir ?>">Previous</a>
                <?php else: ?>
                    <a class="page-link" href="#">Previous</a>
                <?php endif ?>
            </li>
            <li class="page-item"><a class="page-link" href="#"><?= $page ?></a></li>
            <li class="page-item">
                <?php if ($totalPages > $page): ?>
                    <a class="page-link" href="/?page=<?= $page + 1 ?>&sort=<?= $sort ?>&dir=<?= $dir ?>">Next</a>
                <?php else: ?>
                    <a class="page-link" href="#">Next</a>
                <?php endif ?>
            </li>
        </ul>
    </nav>

</div>

<div class="container white-block">


    <form class="login100-form validate-form" method="post">
        <span class="login100-form-title p-b-55">
            Add new task
        </span>

        <div class="wrap-input100  validate-input m-b-16" data-validate="Name is required">
            <input class="input100" type="text" name="name" placeholder="Name">
            <span class="focus-input100"></span>
        </div>

        <div class="wrap-input100 validate-input m-b-16" data-validate="Valid email is required: ex@abc.xyz">
            <input class="input100" type="text" name="email" placeholder="Email">
            <span class="focus-input100"></span>

        </div>

        <div class="wrap-input100 validate-input m-b-16" data-validate="Task text is required">
            <textarea name="content" class="input100" placeholder="Task text"></textarea>
            <span class="focus-input100"></span>
        </div>

        <div class="container-login100-form-btn p-t-25">
            <button class="login100-form-btn">
                Save
            </button>
        </div>

    </form>


</div>