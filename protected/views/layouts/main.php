<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="/libs/bootstrap/assets/ico/favicon.png">
    <title><?php  echo CHtml::encode($this->pageTitle); ?></title>
    <!-- Bootstrap core assets  are  registered by Yii in components/Controller.php -->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<?php  if (app()->params->render_switch_form): ?>
    <div id="switchform-container">
        <?php $this->renderPartial('/layouts/_switch');?>
    </div>
<?php endif;?>

<?php  echo $content; ?>

</body>
</html>
