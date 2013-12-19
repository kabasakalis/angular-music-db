<div class="pulldown  page-min-height" >
<?php
$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);

Yii::import('bootstrap.widgets.input.*');
?>

<h1 class="page-header">Sign In!</h1>
<p>(username:admin,password:1)</p>

<div class="form">
	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'login-form',
    'layout'=>'horizontal',
    'errorMessageCssClass'=>'error',
	'enableClientValidation'=>true,
	'htmlOptions'=>array('class'=>''),
	'clientOptions'=>array(
     'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->textFieldControlGroup($model, 'username'); ?>
    <?php echo $form->PasswordFieldControlGroup($model, 'password'); ?>
    <?php echo $form->error($model,'status'); ?>
    <?php echo $form->checkBoxControlGroup($model, 'rememberMe', array('disabled' => false)); ?>
    <!--<div class="control-group ">
        <div class="controls"><label for="LoginForm_rememberMe" class="checkbox">
            <input
                type="checkbox" value="0" name="LoginForm[rememberMe]" id="LoginForm_rememberMe">
            Remember me next time<span style="display: none" id="LoginForm_rememberMe_em_"
                                       class="help-inline error"></span></label></div>
    </div>-->

    <?php if ($model->getRequireCaptcha()) : ?>
     <?php $this->widget('application.extensions.recaptcha.EReCaptcha',
        array('model'=>$user, 'attribute'=>'verify_code',
              'theme'=>'red', 'language'=>'en',
              'publicKey'=>Yii::app()->params['recaptcha_public_key'] ));?>
    <?php echo CHtml::error($model, 'verify_code'); ?>
    <?php endif; ?>

    <?php echo TbHtml::formActions(array(
        TbHtml::submitButton('Submit', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)),
        TbHtml::resetButton('Reset'),
        TbHtml::linkButton('Forgot My Password,Dammit!',array('url'=>$this->createUrl('site/email_for_reset'), 'icon'=>'exclamation-sign'))
    )); ?>




	<?php $this->endWidget(); ?>
</div><!-- form -->
</div>