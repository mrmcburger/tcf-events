<?php
	session_start();
	
	include 'db.ini';
	$event_shortname = htmlspecialchars($_GET['event']);

	if($event_shortname === 'none')
	{
		$_SESSION['event'] = NULL;
		header('Location: index.php');
	}

	$request = 'SELECT shortname FROM events WHERE shortname=:shortname';

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
    $prepared_request->bindParam(':shortname', $event_shortname);
    $prepared_request ->execute();

    if($prepared_request->rowCount())
    {
        $_SESSION['event'] = $event_shortname;
    }

    header('Location: index.php');
?>