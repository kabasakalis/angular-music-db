<?php $this->pageTitle = Yii::app()->name; ?>
<div class="jumbotron">
    <div class="container">
        <h1>Hello, world!</h1>

        <p>This is a template for a simple marketing or informational website. It includes a large callout called the
            hero unit and three supporting pieces of content. Use it as a starting point to create something more
            unique.</p>

        <p><a class="btn btn-primary btn-lg">Learn more &raquo;</a></p>
    </div>
</div>
<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>
<p>You may change the content of this page by modifying the following two files:</p>
<ul>
    <li>Views file: <?php echo __FILE__; ?></li>
    <li>Layout file: <?php echo $this->getLayoutFile('jumbotron'); ?></li>
</ul>
<p>For more details on how to further develop this application, please read
    the <a href="http://www.yiiframework.com/doc/">documentation</a>.
    Feel free to ask in the <a href="http://www.yiiframework.com/forum/">forum</a>
<div class="row">
    <div class="col-lg-4">
        <h2>Heading</h2>

        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris
            condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod.
            Donec sed odio dui. </p>

        <p><a class="btn btn-default" href="#">View details &raquo;</a></p>
    </div>
    <div class="col-lg-4">
        <h2>Heading</h2>

        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris
            condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod.
            Donec sed odio dui. </p>

        <p><a class="btn btn-default" href="#">View details &raquo;</a></p>
    </div>
    <div class="col-lg-4">
        <h2>Heading</h2>

        <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta
            felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum
            massa justo sit amet risus.</p>

        <p><a class="btn btn-default" href="#">View details &raquo;</a></p>
    </div>
</div>
