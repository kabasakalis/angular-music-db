<?php cs()->registerCssFile($this->getBootstrap2LayoutCssFileURL()); ?>
<?php $this->beginContent('/layouts/main'); ?>
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container-fluid">
                <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="brand" href="#">Yii App</a>

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
                        'htmlOptions' => array('class' => 'nav')
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
        </div>
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
<?php endif; ?>

    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span3">
                <div class="well sidebar-nav">
                    <ul class="nav nav-list">
                        <li class="nav-header">Sidebar</li>
                        <li class="active"><a href="#">Link</a></li>
                        <li><a href="#">Link</a></li>
                        <li><a href="#">Link</a></li>
                        <li><a href="#">Link</a></li>
                        <li class="nav-header">Sidebar</li>
                        <li><a href="#">Link</a></li>
                        <li><a href="#">Link</a></li>
                        <li><a href="#">Link</a></li>
                        <li><a href="#">Link</a></li>
                        <li><a href="#">Link</a></li>
                        <li><a href="#">Link</a></li>
                        <li class="nav-header">Sidebar</li>
                        <li><a href="#">Link</a></li>
                        <li><a href="#">Link</a></li>
                        <li><a href="#">Link</a></li>
                    </ul>
                </div>
                <!--/.well -->
            </div>
            <!--/span-->

            <div class="span9">
                <?php echo $content; ?>
            </div>
        </div>
        <!--/row-->
        <hr>
        <footer>
            <p>&copy; Company 2013</p>
        </footer>

    </div><!--/.fluid-container-->

<?php $this->endContent(); ?>