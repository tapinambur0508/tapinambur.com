<!DOCTYPE HTML>
<html>
    <head>
        <title><?php echo $title ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="public/css/style.css" rel="stylesheet">
        <link href="public/css/sign-style.css" rel="stylesheet">
        <link href="public/css/bootstrap.css" rel="stylesheet">
        <link href="public/css/font-awesome.css" rel="stylesheet">

        <?php 
            require_once 'app/include/function.php';
            $publication = getPublication();
        ?>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script> 
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <script src="public/js/bootstrap.js"></script>
    </head>
    <body>
        <header class="navbar navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="fa fa-bars fa-2x" aria-hidden="true"></span>
                    </button>
                    <a class="navbar-brand name" href="/">tapinambur</a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav menu">
                        <li><a href="/news.php" class="fa fa-newspaper-o" aria-hidden="true">&nbsp;Новини</a></li>
                        <li><a href="/" class="fa fa-paragraph dropdown-toggle" aria-hidden="true" 
                            data-toggle="dropdown">&nbsp;Публікації&nbsp;<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <?php foreach ($publication as $item): ?>
                                    <li>
                                        <a href="/publication.php?href=<?=$item["href"] ?>">
                                            <?=$item["name"] ?></a>
                                    <li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                        <li><a href="#" class="fa fa-shopping-basket" aria-hidden="true">&nbsp;Магазин</a></li>
                    </ul>
                        <?php
                            if (isset($_COOKIE['login'])) {
                                echo(
                                        '<span class="nav navbar-right sign">
                                            <a class="btn btn-success" href="/enter.php">'.$_COOKIE['login'].'</a>
                                            <a class="btn btn-primary" href="/enter.php">Вихід</a>
                                        </span>'
                                    );
                            } else {
                                echo(

                                        '<span class="nav navbar-right sign">
                                            <a class="btn btn-primary" href="/signIn.php">Вхід</a>
                                        </span>'
                                    );
                            }
                        ?>
                </div>
            </div>
        </header>

        <script>
            $(document).ready(function () {
                $("a").focus(function () {
                    this.blur();
                });

                $("button").focus(function () {
                    this.blur();
                });
            });
        </script>