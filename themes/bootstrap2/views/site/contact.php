<?php
$this->pageTitle = Yii::app()->name . ' - Contact Us';
$this->breadcrumbs = array(
    'Contact',
);
?>
<div class="pulldown  page-min-height" >
    <h1 class="page-header">Contact</h1>
<?php if (Yii::app()->user->hasFlash('contact')): ?>
    <div class="contact-success alert alert-info">
        <?php echo Yii::app()->user->getFlash('contact'); ?>
    </div>

<?php else: ?>
    <div class="form">
        <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id' => 'contact-form',
            'layout' => 'horizontal',
           'enableClientValidation' => true,
            'htmlOptions' => array('class' => ''),
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
        )); ?>

        <p class="note">Fields with <span class="required">*</span> are required.</p>

        <?php
        echo $form->errorSummary($model)
        ?>

        <?php echo $form->textFieldControlGroup($model, 'name'); ?>
        <?php echo $form->textFieldControlGroup($model, 'email'); ?>
        <?php echo $form->textFieldControlGroup($model, 'subject'); ?>
        <?php echo $form->textAreaControlGroup($model, 'body', array('span' => 5, 'rows' => 5, 'label' => "Message")); ?>

        <div class="control-group">
            <div class="controls">
                <?php if ($model->getRequireCaptcha()) : ?>
                    <?php $this->widget('application.extensions.recaptcha.EReCaptcha',
                        array('model' => $model, 'attribute' => 'verify_code',
                            'theme' => 'red', 'language' => 'en',
                            'publicKey' => Yii::app()->params['recaptcha_public_key']));?>
                    <?php echo CHtml::error($model, 'verify_code'); ?>
                <?php endif; ?>
            </div>
        </div>
        <?php echo TbHtml::formActions(array(
            TbHtml::submitButton('Submit', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)),
            TbHtml::resetButton('Reset'),
        )); ?>

        <?php $this->endWidget(); ?>
    </div><!-- form -->







<?php endif; ?>

</div>