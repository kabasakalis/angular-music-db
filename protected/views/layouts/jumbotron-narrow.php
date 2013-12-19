<?php $this->beginContent('/layouts/main'); ?>
<div class="container">
    <div class="header">
        <?php $this->widget('zii.widgets.CMenu', array(
            'items' => array(
                array('label' => 'Home', 'url' => array('/site/index')),
                array('label' => 'About', 'url' => array('/site/page', 'view' => 'about')),
                array('label' => 'Contact', 'url' => array('/site/contact')),
                array('label' => 'Sign In', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
                array('label' => 'Register', 'url' => array('/site/register')),
            ),
            'htmlOptions' => array('class' => 'nav nav-pills pull-right')
        )); ?>
        <h3 class="text-muted">Yii App</h3>
        <?php if (!app()->user->isGuest): ?>
            <div class="pull-right">
                <span class="navbar-brand"><small>Welcome,<?php echo app()->user->name; ?></small></span>
      <span class="navbar-brand"><a class="navbar-right"
                                    href="<?php echo $this->createUrl('site/logout') ?>">
              <small>Logout</small>
          </a></span>
            </div>
        <?php endif;?>
    </div>
</div>
<div class="container">
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

<?php echo $content; ?>

<!-- FOOTER -->

<div class="container">
    <div class="footer">
        <p>&copy; Company 2013</p>
    </div>
</div>
<?php $this->endContent(); ?>
<?php cs()->registerCssFile($this->getBootstrap3LayoutCssFileURL()); ?>









