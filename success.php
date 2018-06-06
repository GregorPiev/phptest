<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>PHP Test, Success</title>
        <link href="Content/bootstrap.min.css" rel="stylesheet" />
    </head>
    <body>
        <div class="container">
            <div class="row">
                <header class="col-md-12 col-xs-12 text-center">
                    <h1>Success</h1>
                </header>
                <main class="col-md-12 col-xs-12 text-left">
                    <div class="panel">
                        <div class="panel-body panel-success text-center">
                            Success. You are registrated: <?php echo $_SESSION['username'] ?>
                            <p>
                                <a href="index.php">Login</a>
                            </p>
                        </div>
                    </div>

                </main>
                <footer class="col-md-12 col-xs-12 text-center">
                    &copy;Gregory
                </footer>
            </div>
        </div>

        <script src="Scripts/jquery-3.3.1.min.js"></script>
        <script src="Scripts/bootstrap.min.js"></script>
    </body>
</html>