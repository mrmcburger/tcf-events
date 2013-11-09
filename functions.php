<?php
    function createThumbs($filename)
    {
        if(!file_exists($filename))
        {
            die('No file specified');
        }

        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if(strtolower($ext) == 'jpg' or strtolower($ext) == 'jpeg')
        {
            $img = imagecreatefromjpeg($filename);
        }
        else if(strtolower($ext) == 'png')
        {
            $img =imagecreatefrompng($filename);
        }
        else if(strtolower($ext) == 'gif')
        {
            $img = imagecreatefromgif($filename);
        }
        else
        {
            die('Invalid file extension');
        }

        $width = imagesx($img);
        $height = imagesy($img);
        $new_height = 150;
        $new_width = floor($width * (150 / $height));

        $tmp_img = imagecreatetruecolor($new_width, $new_height);
        imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

        if(strtolower($ext) == 'jpg' or strtolower($ext) == 'jpeg')
        {
            imagejpeg($tmp_img, $filename.'_mini');
        }
        else if(strtolower($ext) == 'png')
        {
            imagepng($tmp_img, $filename.'_mini');
        }
        else if(strtolower($ext) == 'gif')
        {
            imagegif($tmp_img, $filename.'_mini');
        }
    }

    function getEvents()
    {
        include 'db.ini';

        $events = array();

        try
        {
            $pdo = new PDO("mysql:dbname=$dbname;host=$dbhost", $dbuser, $dbpassword);
        }
        catch (PDOException $e)
        {
            echo 'Erreur de connection : ' . $e->getMessage();
            exit();
        }

        $results = $pdo->query('SELECT name, shortname FROM events');
        $i = 0;
        while($res = $results->fetch())
        {
            $events['name'][$i] = $res['name'];
            $events['shortname'][$i] = $res['shortname'];
            $i++;
        }

        return $events;
    }
?>
