<?php
$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>
<div class="page-min-height">
<h2 class="page-header" >Error <?php echo $code; ?></h2>

<div class="alert alert-warning">
<?php echo CHtml::encode($message); ?>
</div>
</div>