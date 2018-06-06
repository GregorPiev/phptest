<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>PHP Test</title>
        <link href="Content/bootstrap.min.css" rel="stylesheet" />
    </head>
    <body>
        <div class="container">
            <div class="row">
                <header class="col-md-12 col-xs-12 text-center">
                    <h1>Login / Register</h1>
                    <p>
                        <?php
                        print_r($_SESSION);
                        if (isset($_SESSION['error'])) {
                            echo "Session:" . $_SESSION['error'];
                        }
                        ?>
                    </p>
                </header>
                <main class="col-md-12 col-xs-12 text-left">
                    <section class="col-md-6 col-xs-12 text-center">
                        <h2>Login</h2>
                        <form class="form-horizontal" method="post" action="<?php echo htmlspecialchars('/phptest/php/login.php'); ?>" autocomplete="off" >
                            <div class="form-group">
                                <label class="control-label col-md-2 col-xs-12">Email</label>
                                <div class="col-md-10 col-xs-12">
                                    <input type="text" class="form-control" name="email" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2 col-xs-12">Password</label>
                                <div class="col-md-10 col-xs-12">
                                    <input type="password" class="form-control" name="password" >
                                </div>
                            </div>
                            <div class="form-group text-right">
                                <input type="submit" class="btn btn-primary btn-lg" value="Send" name="login" >
                            </div>
                        </form>
                    </section>


                    <section class="col-md-6 col-xs-12 text-center">
                        <h2>Register</h2>
                        <form class="form-horizontal" method="post" action="<?php echo htmlspecialchars('/phptest/php/register.php'); ?>" autocomplete="off" >
                            <div class="form-group">
                                <label class="control-label col-md-2 col-xs-12">Username</label>
                                <div class="col-md-10 col-xs-12">
                                    <input type="text" class="form-control" name="username" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2 col-xs-12">Password</label>
                                <div class="col-md-10 col-xs-12">
                                    <input type="password" class="form-control" name="password" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2 col-xs-12">Email</label>
                                <div class="col-md-10 col-xs-12">
                                    <input type="email" class="form-control" name="email" >
                                </div>
                            </div>
                            <div class="form-group text-right">
                                <input type="submit" class="btn btn-primary btn-lg" value="Send" name="register" >
                            </div>
                        </form>
                    </section>

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