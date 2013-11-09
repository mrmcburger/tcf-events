<?php
    session_start();
    include 'functions.php';
    if(!isset($_SESSION['connected']) or !isset($_SESSION['event']))
    {
        header('Location: index.php');
    }
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>
        <title>Feillens à Roland</title>
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
                <li class="gn-trigger">
                    <a class="gn-icon gn-icon-menu"><span>Menu</span></a>
                    <nav class="gn-menu-wrapper">
                        <div class="gn-scroller">
                            <ul class="gn-menu">
                                <li><a href="gallery.php"><i class="icon-picture ip"></i>Photos</a></li>
                                <li><a href="http://www.tennis-club-de-feillens.fr" target="_blank"><i class="icon-link ip"></i>Site web du TC Feillens</a></li>
                                <li><a href="https://www.facebook.com/groups/255325817850570" target="_blank"><i class="icon-facebook ip"></i>Facebook</a></li>
                            </ul>
                        </div>
                    </nav>
                </li>
                <li><a href="gallery.php">Galerie</a></li>
                <li><a href="upload.php">Transfert</a></li>
                <li><a href="videos.php">Vidéos</a></li>
                <li><a href="help.php">Aide</a></li>
                <li><a id="logout" class="codrops-icon codrops-icon-login" href="logout.php"><span>Deconnexion</span></a></li>
            </ul>
            <h1><img src="img/ball.png" alt="Feillens à Roland"> Transférer une photo</h1>
            <div id="modalUpload">
                <?php
                    if(!isset($_FILES['picture']))
                    {
                    }
                    else
                    {
                        $error = false;

                        if ($_FILES['picture']['error'] > 0)
                        {
                            echo '<div class="notif warning">Erreur lors du transfert.</div>';
                            $error = true;
                        }
                        else
                        {
                            $maxsize = 10485760;
                            $valid_extensions = array('jpg' , 'jpeg' , 'gif' , 'png');

                            if ($_FILES['picture']['size'] > $maxsize)
                            {
                                echo '<div class="notif warning">Le fichier est trop gros (plus de 10Mo).</div>';
                                $error = true;
                            }

                            $extension_uploaded = strtolower(substr(strrchr($_FILES['picture']['name'], '.') ,1) );
                            if(! in_array($extension_uploaded, $valid_extensions) )
                            {
                                echo '<div class="notif warning">Extension incorrecte.</div>';
                                $error = true;
                            }

                            if(file_exists('pictures/'.$_SESSION['event'].'/'.$_FILES['picture']['name']))
                            {
                                 echo '<div class="notif warning">Nom de photo déjà utilisée, veuillez renommer votre photo.</div>';
                                $error = true;
                            }

                            if($error)
                            {
                            }
                            else
                            {
                               $result = move_uploaded_file($_FILES['picture']['tmp_name'], 'pictures/'.$_SESSION['event'].'/'.$_FILES['picture']['name']);
                                if ($result)
                                {
                                    echo '<div class="notif success">Transfert réussi ! Vous pouvez dès à présent envoyer une autre photo.</div>';
                                    createThumbs('pictures/'.$_SESSION['event'].'/'.$_FILES['picture']['name']);
                                }
                            }
                        }
                    }
                ?>
                <form method="post" id="uploadForm" enctype="multipart/form-data">
                    <div class="controls">
                        <label for="photo">Photo : </label>
                        <input type="file" name="picture" class="wAuto">
                    </div>
                    <div class="controls">
                        <button class="btn-flat btn-flat-brown" type="submit">Envoyer</button>
                    </div>
                </form>
                <hr>
                <div class="legend">
                    * Permet la mise à dispo de photos sur le site que les adhérents pourront ensuite télécharger
                </div>
            </div>
        </div><!-- /container -->
        <script src="js/classie.js"></script>
        <script src="js/gnmenu.js"></script>
        <script src="js/main.js"></script>
        <script>
            new gnMenu( document.getElementById( 'gn-menu' ) );
        </script>
    </body>
</html>
