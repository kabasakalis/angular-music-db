<?php $this->beginContent('/layouts/main'); ?>
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">YiiApp</a>
            </div>
            <div class="navbar-collapse collapse">
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
                            'class' => 'navbar-form navbar-right',
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
                        <div class="form-group">
                            <?php echo $form->textField($model, 'username', array('max-length' => '10', 'class' => 'form-control', 'placeholder' => 'email or username')); ?>
                        </div>
                        <div class="form-group">
                            <?php echo $form->passwordField($model, 'password', array('max-length' => '10', 'class' => 'form-control', 'type' => 'password', 'placeholder' => 'password')); ?>
                        </div>

                        <?php echo CHtml::submitButton('Login', array('class' => 'btn btn-primary btn-sm')); ?>
                        <a class="btn btn-primary  btn-sm  btn-warning"
                           href="<?php echo $this->createUrl('site/email_for_reset') ?>">Forgot!</a>
                        <a class=" btn btn-primary btn-sm  btn-info"
                           href="<?php echo $this->createUrl('site/register') ?>">Sign Up</a>

                        <?php $this->endWidget(); ?>
                    </form>

                <?php else: ?>
                    <div class=" navbar-right">
                        <span class="navbar-brand"><small>Welcome,<?php echo app()->user->name; ?></small></span>
                            <span class="navbar-brand">
                                <a class="navbar-right" href="<?php echo $this->createUrl('site/logout') ?>">
                                    <small>Logout</small>
                                </a></span>
                    </div>
                <?php endif;?>
            </div>
            <!--/.navbar-collapse -->
        </div>
        <!--/.container -->
    </div><!--/.navbar -->
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
        <?php echo $content; ?>
        <!-- Example row of columns -->
        <hr>
        <footer>
            <p>&copy; Company 2013</p>
        </footer>
    </div> <!-- /container -->
<?php $this->endContent(); ?>
<?php cs()->registerCssFile($this->getBootstrap3LayoutCssFileURL()); ?>