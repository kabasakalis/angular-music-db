<div class="pulldown  page-min-height" >
<?php
$this->pageTitle=Yii::app()->name . ' - Register';
$this->breadcrumbs=array(
	'Register',
);

Yii::import('bootstrap.widgets.input.*');
?>

<h1 class="page-header">Sign Up!</h1>

<div class="form">
	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'register-form',
    'layout'=>'horizontal',
	'enableClientValidation'=>true,
	'htmlOptions'=>array('class'=>''),
	'clientOptions'=>array(
'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php
       echo $form->errorSummary($model)
         ?>
		 
		 <?php echo $form->textFieldControlGroup($model, 'email'); ?>
		  <?php echo $form->textFieldControlGroup($model, 'username'); ?>
		 <?php echo $form->PasswordFieldControlGroup($model, 'new_password'); ?>
		 <?php echo $form->PasswordFieldControlGroup($model, 'password_confirm'); ?>

    <div class="control-group">
        <div class="controls">
   <?php echo CHtml::activeLabel($model, 'verify_code'); ?>
    <?php $this->widget('application.extensions.recaptcha.EReCaptcha',
       array('model'=>$model, 'attribute'=>'verify_code',
             'theme'=>'red', 'language'=>'en',
             'publicKey'=>Yii::app()->params['recaptcha_public_key'] )); ?>
    <?php echo CHtml::error($model, 'verify_code');?>
        </div>
    </div>

<?php echo TbHtml::formActions(array(
    TbHtml::submitButton('Submit', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)),
    TbHtml::resetButton('Reset'),
)); ?>

	<?php $this->endWidget(); ?>
</div><!-- form -->
</div>