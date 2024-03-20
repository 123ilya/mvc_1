<h1>Create an account</h1>
<?php

use app\core\form\Form;
?>

<?php $form = Form::begin('', 'post') ?>

<?php echo $form->field($model, 'firstname') ?>
<?php echo $form->field($model, 'lastname') ?>
<?php echo $form->field($model, 'email') ?>
<?php echo $form->field($model, 'password') ?>
<?php echo $form->field($model, 'confirmPassword') ?>

<button type="submit" class="btn btn-primary">Submit</button>


<?php Form::end() ?> 

<!-- <form novalidate action="" method="post">
    <div class="row">
        <div class="col">
            <div class="mb-3">
                <label class="form-label">Firstname</label>
                <input type="text" name="firstname" class="form-control <?php //echo $model->hasError('firstname') ? 'is-invalid' : '' ?>" value="<?php //echo $model->firstname ?>">
                <div class="invalid-feedback">
                    <?//php echo $model->getFirstError('firstname') ?>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="mb-3">
                <label class="form-label">Lastname</label>
                <input type="text" name="lastname" class="form-control">
            </div>
        </div>

    </div>

    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Confirm Password</label>
        <input type="password" name="confirmPassword" class="form-control">
    </div>


    <button type="submit" class="btn btn-primary">Submit</button>
</form> -->