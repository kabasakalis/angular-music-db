<?php
$this->pageTitle = Yii::app()->name . ' - Email For Reset ';
$this->breadcrumbs = array(
    'Email for Reset',
);
?>
<div class="container page-min-height">
    <div class="row" xmlns="http://www.w3.org/1999/html">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li class="active"><a href="">Password Reset</a></li>
            </ol>
        </div>
    </div>
    <div class="page-header">
        <h1>Password Reset</h1>
        <strong><?php echo  Yii::t('passwordreset', 'Please submit your email,we will send you a  password reset link.');?></strong>
    </div>
    <div class="horizontal-form">

        <?php $form = $this->beginWidget('CActiveForm', array(
            'enableClientValidation' => true,
            //'enableAjaxValidation'=>true,
            'id' => 'email-form',
            'htmlOptions' => array('class' => 'form-horizontal',
                'role' => 'form',
                'id' => 'email-form'
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
            <?php echo $form->labelEx($model, 'email', array('class' => 'col-lg-3 control-label')); ?>
            <div class="col-lg-5">
                <?php echo $form->emailField($model, 'email', array('class' => 'form-control input-lg', 'placeholder' => 'Your email here')); ?>
                <div class="help-block">
                    <?php echo $form->error($model, 'email'); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-offset-6 col-lg-10">
                <?php echo CHtml::submitButton('Submit', array('class' => 'btn btn-primary btn-lg')); ?>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>




