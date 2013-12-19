<div class="pulldown  page-min-height" >
<?php
$this->pageTitle=Yii::app()->name . ' - Email For Reset ';
$this->breadcrumbs=array(
	'Email for Reset',
);

Yii::import('bootstrap.widgets.input.*');
?>

<h1 class="page-header">Password Reset</h1>
<p class="alert alert-info"><?php echo  Yii::t('passwordreset','Please submit your email,we will send you a  password reset link.');?></p>

<div class="form">
	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'email-form',
    'layout'=>'horizontal',
	'enableClientValidation'=>true,
	'htmlOptions'=>array('class'=>''),
	'clientOptions'=>array(
   'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->textFieldControlGroup($model, 'email'); ?>


    <?php echo TbHtml::formActions(array(
        TbHtml::submitButton('Submit', array('color' => TbHtml::BUTTON_COLOR_PRIMARY, 'icon'=>'ok')),
        TbHtml::resetButton('Reset'),
    )); ?>


	<?php $this->endWidget(); ?>
</div>
</div>