<div class="pulldown  page-min-height" >
<?php
$this->pageTitle=Yii::app()->name . ' - Reset Password';
$this->breadcrumbs=array(
	'Reset',
);

Yii::import('bootstrap.widgets.input.*');
?>

<h1 class="page-header">Password Reset</h1>

<div class="form">
	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'password-form',
    'layout'=>'horizontal',
	'enableClientValidation'=>true,
	'htmlOptions'=>array('class'=>''),
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->PasswordFieldControlGroup($model, 'password', array('placeholder'=>'password','help' => 'Enter your new password')); ?>

    <?php echo $form->hiddenField($model, 'key', array('value'=>$key,'class'=>'span3'));?>
    <?php echo $form->hiddenField($model, 'email', array('value'=>$email,'class'=>'span3'));?>


    <?php echo TbHtml::formActions(array(
        TbHtml::submitButton('Submit', array('color' => TbHtml::BUTTON_COLOR_PRIMARY, 'icon'=>'ok')),
        TbHtml::resetButton('Reset'),
    )); ?>
	<?php $this->endWidget(); ?>
</div>
</div>