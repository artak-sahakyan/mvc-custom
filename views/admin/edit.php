<?php
/* @var \app\models\TaskModel $model */

?>

<div class="container white-block">


    <form class="login100-form validate-form" method="post">
        <span class="login100-form-title p-b-55">
            Edit task
        </span>

        <div class="wrap-input100  validate-input m-b-16" data-validate="Name is required">
            <input class="input100" type="text" name="name" placeholder="Name" value="<?= $model->name ?>">
            <span class="focus-input100"></span>
        </div>

        <div class="wrap-input100 validate-input m-b-16" data-validate="Valid email is required: ex@abc.xyz">
            <input class="input100" type="text" name="email" placeholder="Email" value="<?= $model->email ?>">
            <span class="focus-input100"></span>

        </div>

        <div class="wrap-input100 validate-input m-b-16" data-validate="Task text is required">
            <textarea name="content" class="input100" placeholder="Task text"><?= $model->content ?></textarea>
            <span class="focus-input100"></span>
        </div>
        <input type="hidden" name="id" value="<?= $model->id ?>">

        <div class="container-login100-form-btn p-t-25">
            <button class="login100-form-btn">
                Save
            </button>
        </div>

    </form>


</div>