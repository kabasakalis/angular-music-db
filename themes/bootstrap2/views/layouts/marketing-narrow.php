<?php $this->beginContent('/layouts/main'); ?>
<div class="container-narrow">
    <div class="">
        <?php
        $flashMessages = Yii::app()->user->getFlashes();
        if ($flashMessages) :?>
            <?php foreach ($flashMessages as $key => $message)  : ?>
                <div class="alert alert-dismissable alert-<?php echo $key; ?>">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong><?php echo   $message;?></strong>
                </div>
            <?php endforeach; ?>
        <?php endif;?>
    </div>
</div>
<div class="container-narrow">
    <div class="masthead">
        <?php $this->widget('zii.widgets.CMenu', array(
            'items' => array(
                array('label' => 'Home', 'url' => array('/site/index')),
                array('label' => 'About', 'url' => array('/site/page', 'view' => 'about')),
                array('label' => 'Contact', 'url' => array('/site/contact')),
                array('label' => 'Sign In', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
                array('label' => 'Sign Up', 'url' => array('/site/register')),
            ),
            'htmlOptions' => array('class' => 'nav nav-pills pull-right')
        )); ?>
        <h3 class="muted">Yii App</h3>
    </div>
</div><!-- /container -->
<div class="container-narrow">
    <div class="row">
        <div class="pull-right">
            <?php if (!app()->user->isGuest): ?>
                <span class="">Welcome,<?php echo app()->user->name; ?>   </span>
                <a class="" href="<?php echo $this->createUrl('site/logout') ?>"> Logout </a>
            <?php endif;?>
        </div>
    </div>
</div>
<div class="container-narrow">
    <?php echo $content; ?>
</div> <!-- /container -->

<div class="container-narrow">
    <hr>
    <div class="footer">
        <p>&copy; Company 2013</p>
    </div>
</div> <!-- /container -->
<?php $this->endContent(); ?>
<?php cs()->registerCssFile($this->getBootstrap2LayoutCssFileURL()); ?>
