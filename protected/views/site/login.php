<?php
$this->pageTitle = Yii::app()->name . ' - Login';
$this->breadcrumbs = array(
    'Login',
);
?>
<div class="container page-min-height">

    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li class="active"><a href="">Login</a></li>
            </ol>
        </div>
    </div>
    <div class="page-header">
        <h1>Sign In
            <small> (username:admin,password:1)</small>
        </h1>
    </div>
    <div class="horizontal-form">
        <?php $form = $this->beginWidget('CActiveForm', array(
            'enableClientValidation' => true,
            //'enableAjaxValidation'=>true,
            // 'errorMessageCssClass'=>'has-error',
            'id' => 'login-form',
            'htmlOptions' => array('class' => 'form-horizontal',
                'role' => 'form',
                'id' => 'login-form'
            ),
            'clientOptions' => array(
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
            <?php echo $form->labelEx($model, 'username', array('class' => 'col-lg-3 control-label')); ?>
            <div class="col-lg-5">
                <?php echo $form->textField($model, 'username', array('class' => 'form-control', 'placeholder' => 'Name')); ?>
                <div class="help-block">
                    <?php echo $form->error($model, 'username'); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model, 'password', array('class' => 'col-lg-3 control-label')); ?>
            <div class="col-lg-5">
                <?php echo $form->textField($model, 'password', array('class' => 'form-control', 'placeholder' => 'Email')); ?>
                <span class="help-block help-inline ">
                <?php echo $form->error($model, 'password'); ?>
                    </span>
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-offset-3 col-lg-10">
                <div class="checkbox">
                    <label>
                        <?php echo $form->checkBox($model, 'rememberMe'); ?> Remember me
                    </label>
                </div>
            </div>
        </div>
        <!--<div class="control-group ">
              <div class="controls"><label for="LoginForm_rememberMe" class="checkbox">
                  <input
                      type="checkbox" value="0" name="LoginForm[rememberMe]" id="LoginForm_rememberMe">
                  Remember me next time<span style="display: none" id="LoginForm_rememberMe_em_"
                                             class="help-inline error"></span></label></div>
          </div>-->
        <div class="form-group">
            <div class="col-lg-offset-3 col-lg-10">
                <?php echo CHtml::submitButton('Login', array('class' => 'btn btn-primary btn-lg')); ?>
                <a class="btn btn-primary col-lg-offset-2 btn-sm"
                   href="<?php echo $this->createUrl('site/email_for_reset') ?>">Forgot My Password,Dammit!</a>
            </div>
        </div>
        <?php if ($model->getRequireCaptcha()) : ?>
            <?php $this->widget('application.extensions.recaptcha.EReCaptcha',
                array('model' => $user, 'attribute' => 'verify_code',
                    'theme' => 'red', 'language' => 'en',
                    'publicKey' => Yii::app()->params['recaptcha_public_key']));?>
            <?php echo CHtml::error($model, 'verify_code'); ?>
        <?php endif; ?>
        <?php $this->endWidget(); ?>
    </div>
</div>




