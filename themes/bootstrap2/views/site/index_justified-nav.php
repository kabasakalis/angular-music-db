<?php $this->pageTitle = Yii::app()->name; ?>
<!-- Jumbotron -->
<div class="jumbotron">
    <h2>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h2>

    <p class="lead">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Fusce dapibus, tellus ac cursus
        commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
    <a class="btn btn-large btn-success" href="#">Get started today</a>

    <hr>
    <p>You may change the content of this page by modifying the following two files:</p>
    <ol>
        <li>Views file: <?php echo __FILE__; ?></li>
        <li>Layout file: <?php echo $this->getLayoutFile('justified-nav'); ?></li>
    </ol>
    <p>For more details on how to further develop this application, please read
        the <a href="http://www.yiiframework.com/doc/">documentation</a>.
        Feel free to ask in the <a href="http://www.yiiframework.com/forum/">forum</a>
</div>

<hr>

<!-- Example row of columns -->
<div class="row-fluid">
    <div class="span4">
        <h2>Heading</h2>

        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris
            condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod.
            Donec sed odio dui. </p>

        <p><a class="btn" href="#">View details &raquo;</a></p>
    </div>
    <div class="span4">
        <h2>Heading</h2>

        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris
            condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod.
            Donec sed odio dui. </p>

        <p><a class="btn" href="#">View details &raquo;</a></p>
    </div>
    <div class="span4">
        <h2>Heading</h2>

        <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta
            felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum
            massa.</p>

        <p><a class="btn" href="#">View details &raquo;</a></p>
    </div>
</div>





