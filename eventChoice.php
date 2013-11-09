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

        #On incrémente le compteur de visites
        $results = $pdo->query('SELECT id FROM events WHERE shortname="'.$event_shortname.'"');
        $results = $results->fetch();
        $id = $results['id'];

        $results = $pdo->query('SELECT count FROM counter WHERE id='.$id);
        $results = $results->fetch();
        $count = $results['count'];
        $count++;

        $results = $pdo->query('UPDATE counter SET count='.$count.' WHERE id='.$id);            
    }

    header('Location: index.php');
?>