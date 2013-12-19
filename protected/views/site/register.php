<?php
$this->pageTitle = Yii::app()->name . ' - Register';
$this->breadcrumbs = array(
    'Register',
);
?>

<div class="container page-min-height">
    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li class="active"><a href="">Register</a></li>
            </ol>
        </div>
    </div>

    <div class="page-header">
        <h1>Sign Up </h1>
    </div>

    <div class="horizontal-form">
        <?php $form = $this->beginWidget('CActiveForm', array(
            'enableClientValidation' => true,
            //'enableAjaxValidation'=>true,
            // 'errorMessageCssClass'=>'has-error',
            'htmlOptions' => array('class' => 'form-horizontal',
                'role' => 'form',
                'id' => 'register-form'
            ),
            'clientOptions' => array(
                'id' => 'register-form',
                'validateOnSubmit' => true,
                'errorCssClass' => 'has-error',
                'successCssClass' => 'has-success',
                'inputContainer' => '.form-group',
                'validateOnChange' => true
            ),
        )); ?>

        <div class="form-group">
            <div class="col-lg-3 control-label">
                <div>
                    <p class="note">Fields with <span class="required">*</span> are required.</p>
                </div>
            </div>
            <div class="col-lg-5  has-error">
                <div class="help-block ">
                    <?php echo $form->errorSummary($model); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model, 'email', array('class' => 'col-lg-3 control-label')); ?>
            <div class="col-lg-5">
                <?php echo $form->textField($model, 'email', array('class' => 'form-control', 'placeholder' => 'Email')); ?>
                <span class="help-block help-inline ">
                <?php echo $form->error($model, 'email'); ?>
                    </span>
            </div>
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model, 'username', array('class' => 'col-lg-3 control-label')); ?>
            <div class="col-lg-5">
                <?php echo $form->textField($model, 'username', array('class' => 'form-control', 'placeholder' => 'Choose a username')); ?>
                <div class="help-block">
                    <?php echo $form->error($model, 'username'); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model, 'new_password', array('class' => 'col-lg-3 control-label')); ?>
            <div class="col-lg-5">
                <?php echo $form->passwordField($model, 'new_password', array('class' => 'form-control', 'placeholder' => 'Choose your password')); ?>
                <div class="help-block">
                    <?php echo $form->error($model, 'new_password'); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model, 'password_confirm', array('class' => 'col-lg-3 control-label')); ?>
            <div class="col-lg-5">
                <?php echo $form->passwordField($model, 'password_confirm', array('type' => 'password', 'class' => 'form-control', 'placeholder' => 'Confirm your password', 'rows' => 6, 'cols' => 50)); ?>
                <div class="help-block">
                    <?php echo $form->error($model, 'password_confirm'); ?>
                </div>
            </div>
        </div>
        <!--<div class="form-group">
            <div class="col-lg-5 col-lg-offset-3">
                <?php /*echo CHtml::activeLabel($model, 'verify_code'); */?>
                <?php /*$this->widget('application.extensions.recaptcha.EReCaptcha',
                    array('model' => $model, 'attribute' => 'verify_code',
                        'theme' => 'red', 'language' => 'en',
                        'publicKey' => Yii::app()->params['recaptcha_public_key']));*/?>
                <div class="help-block">
                    <?php /*//echo CHtml::error($model, 'verify_code');*/?>
                </div>
            </div>
        </div>-->
        <div class="form-group">
            <div class="col-lg-offset-3 col-lg-10">
                <?php echo CHtml::submitButton('Sign Up', array('class' => 'btn btn-primary btn-lg')); ?>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>
    <!-- form -->
</div>

