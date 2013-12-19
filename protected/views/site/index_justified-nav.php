<div class="container">
    <!-- Jumbotron -->
    <div class="jumbotron">
        <h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

        <p>You may change the content of this page by modifying the following two files:</p>
        <ul>
            <li>Views file: <?php echo __FILE__; ?></li>
            <li>Layout file: <?php echo $this->getLayoutFile('justified-nav'); ?></li>
        </ul>

        <p>For more details on how to further develop this application, please read
            the <a href="http://www.yiiframework.com/doc/">documentation</a>.
            Feel free to ask in the <a href="http://www.yiiframework.com/forum/">forum</a>

        <p class="lead">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Fusce dapibus, tellus ac cursus
            commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet.</p>

        <p><a class="btn btn-lg btn-success" href="#">Get started today</a></p>
    </div>

    <!-- Example row of columns -->
    <div class="row">
        <div class="col-lg-4">
            <h2>Heading</h2>

            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris
                condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis
                euismod. Donec sed odio dui. </p>

            <p><a class="btn btn-primary" href="#">View details &raquo;</a></p>
        </div>
        <div class="col-lg-4">
            <h2>Heading</h2>

            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris
                condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis
                euismod. Donec sed odio dui. </p>

            <p><a class="btn btn-primary" href="#">View details &raquo;</a></p>
        </div>
        <div class="col-lg-4">
            <h2>Heading</h2>

            <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula
                porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut
                fermentum massa.</p>

            <p><a class="btn btn-primary" href="#">View details &raquo;</a></p>
        </div>
    </div>
</div>