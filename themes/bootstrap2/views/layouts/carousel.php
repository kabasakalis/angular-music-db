<?php cs()->registerScriptFile(bu() . '/yiistrap_assets/js/holder.js', CClientScript::POS_END); ?>
<?php $this->beginContent('/layouts/main'); ?>
<?php
$flashMessages = Yii::app()->user->getFlashes();
if ($flashMessages) :?>
    <?php foreach ($flashMessages as $key => $message)  : ?>
        <div class="alert alert-dismissable alert-<?php echo $key; ?>">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong><?php echo   $message;?></strong>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
<!-- NAVBAR
================================================== -->
<div class="navbar-wrapper">
    <!-- Wrap the .navbar in .container to center it within the absolutely positioned parent. -->
    <div class="container">
        <div class="navbar navbar-inverse">
            <div class="navbar-inner">
                <!-- Responsive Navbar Part 1: Button for triggering responsive navbar (not covered in tutorial). Include responsive CSS to utilize. -->
                <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="brand" href="#">Yii App</a>
                <!-- Responsive Navbar Part 2: Place all navbar contents you want collapsed withing .navbar-collapse.collapse. -->
                <div class="nav-collapse collapse">
                    <?php $this->widget('zii.widgets.CMenu', array(
                        'encodeLabel' => true,
                        'items' => array(
                            array('label' => 'Home', 'url' => array('/site/index')),
                            array('label' => 'About', 'url' => array('/site/page', 'view' => 'about')),
                            array('label' => 'Contact', 'url' => array('/site/contact')),
                            array('label' => 'Dropdown', 'url' => array('#'), 'itemOptions' => array('class' => 'dropdown'),
                                'linkOptions' => array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown'),
                                'submenuOptions' => array('class' => 'dropdown-menu'),
                                'items' => array(
                                    array('label' => 'Action', 'url' => array('#')),
                                    array('label' => 'Another action', 'url' => array('#')),
                                    array('label' => 'Something else here', 'url' => array('#')),
                                    array('label' => 'Something else here', 'url' => array('#'), 'itemOptions' => array('class' => 'divider')),
                                    array('label' => 'Nav header', 'url' => array('#'), 'itemOptions' => array('class' => 'dropdown-header')),
                                    array('label' => 'Separated link', 'url' => array('#')),
                                    array('label' => 'One more separated link', 'url' => array('#')),
                                )
                            )
                        ),
                        // 'htmlOptions'=>array('class'=>'main-menu')
                        'htmlOptions' => array('class' => 'nav navbar-nav')
                    )); ?>
                    <?php if (app()->user->isGuest): ?>
                        <?php
                        $model = new LoginForm();
                        $form = $this->beginWidget('CActiveForm', array(
                            'id' => 'nav-bar_login-form',
                            'enableClientValidation' => true,
                            'action' => $this->createUrl('site/login'),
                            //'enableAjaxValidation'=>true,
                            'errorMessageCssClass' => 'has-error',
                            'htmlOptions' => array(
                                'id' => 'login-form',
                                'class' => 'navbar-form pull-right',
                                'role' => 'form',
                            ),
                            'clientOptions' => array(
                                'id' => 'nav-bar_login-form',
                                'validateOnSubmit' => true,
                                'errorCssClass' => 'has-error',
                                'successCssClass' => 'has-success',
                                'inputContainer' => '.form-group',
                                'validateOnChange' => true
                            ),
                        ));
                        ?>
                        <form>
                            <?php echo $form->textField($model, 'username', array('max-length' => '10', 'class' => 'span2', 'placeholder' => 'email or username')); ?>
                            <?php echo $form->passwordField($model, 'password', array('max-length' => '10', 'class' => 'span2', 'type' => 'password', 'placeholder' => 'password')); ?>

                            <?php echo CHtml::submitButton('Sign In', array('class' => 'btn btn-primary btn-mini')); ?>
                            <a class="btn btn-primary  btn-mini  btn-warning"
                               href="<?php echo $this->createUrl('site/email_for_reset') ?>">Forgot!</a>
                            <a class=" btn btn-primary btn-mini  btn-info"
                               href="<?php echo $this->createUrl('site/register') ?>">Sign Up</a>
                            <?php $this->endWidget(); ?>
                        </form>
                    <?php else: ?>
                        <div class="pull-right">
                            <span class="brand"><small>Welcome,<?php echo app()->user->name; ?></small></span>
      <span>
          <a class=" btn btn-primary btn-small" href="<?php echo $this->createUrl('site/logout') ?>">
              Logout
          </a>
        </span>
                        </div>
                    <?php endif;?>
                </div>
                <!--/.nav-collapse -->
            </div>
            <!-- /.navbar-inner -->
        </div>
        <!-- /.navbar -->

    </div>
    <!-- /.container -->
</div><!-- /.navbar-wrapper -->
<?php if ($this->action->id == "index"): ?>
    <?php echo $content; ?>
<?php else: ?>
    <div class="container">
        <?php echo $content; ?>
    </div>
<?php endif; ?>


<div class="container">
    <!-- FOOTER -->
    <footer>
        <p class="pull-right"><a href="#">Back to top</a></p>

        <p>&copy; 2013 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
    </footer>

</div><!-- /.container -->

</body>
<script>
    !function ($) {
        $(function () {
            // carousel demo
            $('#myCarousel').carousel()
        })
    }(window.jQuery)
</script>
</html>
<?php $this->endContent(); ?>
<?php cs()->registerCssFile($this->getBootstrap2LayoutCssFileURL()); ?>

