<?php
	session_start();
	include 'functions.php';
?>
    <head>
        <title>Feillens à Roland</title>
        <meta charset="UTF-8" />
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="" />
        <meta name="keywords" content="" />
     </head>
				<?php
				if(isset($_SESSION['connected']))
				{
					if(isset($_SESSION['event']))
					{
				?>
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
				<li><a href="eventChoice.php?event=none">Choisir un évenement</a></li>
				<li><a href="help.php">Aide</a></li>
				<?php 
						}
						else
						{
				?>
				    Veuillez selectionner un évenement<br /><br />
				<?php
							$events = getEvents();
							$count = count($events['name']);

							for ($i=0; $i < $count; $i++) 
							{ 
								echo '<a href="eventChoice.php?event='.$events['shortname'][$i].'">'.utf8_encode($events['name'][$i]).'</a><br />';
							}
						}
					}
				 ?>
				 <br />
				<?php
					if(!isset($_SESSION['connected']))
					{
						echo '<li><a id="displayLogin" class="codrops-icon codrops-icon-login" href="#"><span>Connexion</span></a></li>';
					}
					else
					{
						echo '<li><a id="logout" class="codrops-icon codrops-icon-login" href="logout.php"><span>Deconnexion</span></a></li>';
					}
				?>
				<?php
					if(!isset($_SESSION['connected']))
					{
				?>			
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
				<?php
					}
				?>

			<header>
				<h1>Site evenementiel de feillens</span></h1>
			</header>
		</div><!-- /container -->
	</body>
</html>
