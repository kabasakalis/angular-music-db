<?php $this->beginContent('/layouts/main'); ?>
    <div class="container">
        <div class=" pull-right">
            <?php if (Yii::app()->user->isGuest): ?>
                <a class="btn btn-primary btn-mini" href="/site/login">Sign In</a>
                <a class="btn btn-primary btn-mini" href="/site/register">Register</a>
            <?php else   : ?>
                <div class=" pull-right">
            <span class=""><strong>Welcome <?php echo Yii::app()->user->name; ?></strong>
             <a class="btn btn-primary btn-mini offset3" href="/site/logout">Sign Out</a>
                 <a class="btn btn-primary btn-mini" href="/site/register">Register</a>
            </span>
                </div>
            <?php endif; ?>
        </div>
        <div class="masthead">
            <h3 class="muted">Yii App</h3>

            <div class="navbar">
                <div class="navbar-inner">
                    <div class="container">
                        <?php $this->widget('zii.widgets.CMenu', array(
                            'items' => array(
                                array('label' => 'Home', 'url' => array('/site/index')),
                                array('label' => 'About', 'url' => array('/site/page', 'view' => 'about')),
                                array('label' => 'Contact', 'url' => array('/site/contact')),
                                /* array('label' => 'Register', 'url' => array('/site/register')),*/
                                /*   array('label' => 'Login', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
                                   array('label' => 'Logout (' . (Yii::app()->user->name) . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest)*/
                            ),
                            'htmlOptions' => array('class' => 'nav')
                        )); ?>
                    </div>
                </div>
            </div>
            <!-- /.navbar -->
        </div>
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

        <?php echo $content; ?>

        <hr>
        <div class="footer">
            <p>&copy; Company 2013</p>
        </div>
    </div> <!-- /container -->
<?php $this->endContent(); ?>
<?php cs()->registerCssFile($this->getBootstrap2LayoutCssFileURL()); ?>