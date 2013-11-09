<?php
    session_start();
    include 'db.ini';

    if(isset($_SESSION['connected']))
    {
        header('Location: index.php');
    }

    if(isset($_POST['username']) && isset($_POST['password']))
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
    }
    else
    {
        $username = '';
        $password = '';
    }

    $request = 'SELECT * FROM auth WHERE nickname=:nickname AND password=:password';

    try
    {
        $pdo = new PDO("mysql:dbname=$dbname;host=$dbhost", $dbuser, $dbpassword);
    }
    catch (PDOException $e)
    {
        echo 'Erreur de connection : ' . $e->getMessage();
        exit();
    }

    $prepared_request = $pdo->prepare($request);
    $prepared_request->bindParam(':nickname', $username);
    $prepared_request->bindParam(':password', $password);
    $prepared_request ->execute();

    if($prepared_request->rowCount())
    {
        # Successfull auth
        $_SESSION['connected'] = true;
        header('Location: index.php');
    }
    else
    {
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>
        <title>Evenements à feillens</title>
        <meta charset="UTF-8" />
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="" />
        <meta name="keywords" content="" />

        <!-- css -->
        <link rel="stylesheet" type="text/css" href="css/normalize.css" />
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/component.css" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="css/font-awesome-ie7.min.css" />

        <!-- favicon -->
        <link rel="shortcut icon" href="img/favicon.png">

        <!-- js -->
        <script src="js/modernizr.custom.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
        <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.min.js"></script>
    </head>
    <body>
        <div class="container">
            <ul id="gn-menu" class="gn-menu-main">
                <li><a id="displayLogin" class="codrops-icon codrops-icon-login" href="#"><span>Connexion</span></a></li>
            </ul>
            <div id="modalLogin">
                <div class="inner">
                    <form action="auth.php" id="loginForm" method="post">
                        <div class="controls">
                            <label for="username">Nom d'utilisateur</label>
                            <input id="username" type="text" name="username" placeholder="Nom d'utilisateur">
                        </div>
                        <div class="controls">
                            <label for="password">Mot de passe</label>
                            <input id="password" type="password" name="password" placeholder="Mot de passe">
                        </div>
                        <div class="controls">
                            <button class="btn-flat btn-flat-brown" type="submit">Connexion</button>
                        </div>
                    </form>
                </div>
            </div>
            <header>
                <h1><img src="img/ball.png" alt="Feillens à Roland"> Connectez-vous à l'application <span><?php echo 'Mauvaise combinaison login/mot de passe, veuillez vous reconnecter'; ?></span></h1>
            </header>
        </div><!-- /container -->
        <script src="js/classie.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>
<?php
    }
?>
