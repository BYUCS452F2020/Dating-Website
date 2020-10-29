<?php

include_once "./lib/php/check_login.php";
include_once "./lib/php/users.php";

include_once "db_connect.php";

$currentUser = getUserID();
$sql = "select p.user_id, p.bio, concat(p.first_name, ' ', p.last_name) as name, p.height, p.major, p.work, p.hometown, case when i.filename is null then 'missing.jpg' else i.filename end as image
from Profile p left join Image i 
on p.user_id = i.user_id
where p.user_id in (
	select case 
		when person1 = 'me@example.com' then person2 
		when person2 = 'me@example.com' then person1
		else null
	end as matched from Liked where matched = 1
	having matched is not null
);";
$matches = doSelect($sql);

function convertHeight($heightIn){
    
    $feet = floor($heightIn / 12) . "'";
    $inches = $heightIn % 12;
    
    if ($inches > 0){
        $inches .= "\"";
    }
    else {
        $inches = "";
    }
    
    return $feet . " " . $inches;
}


?>

<html>
    <head>
        <title>Matches for <?php echo $currentUser; ?></title>
    </head>
    <body>
        <center>
        <h1>Matches for <?php echo $currentUser; ?></h1>
        </center>
        
        <?php
        
        for ($count = 0; $count < count($matches); $count++){
            $currMatch = $matches[$count];
            
            $image = $currMatch['image'];
            $name = $currMatch['name'];
            $bio = $currMatch['bio'];
            
            $height = convertHeight($currMatch['height']);
            
            $hometown = $currMatch['hometown'];
            $major = $currMatch['major'];
            $work = $currMatch['work'];
            
            echo "
        <div style='width: 30rem; border: black; border-style: solid; margin-left: auto; margin-right: auto; margin-bottom: 20px; padding: 10px;'>
            <center><img src='images/{$image}' style='width: 25rem;'></center>
            <div>
                <h2>{$name}</h2>
                <p>
                    <b>About Me:</b><br>
                    {$bio}
                </p>
                <b>Height:</b> {$height}<br>
                <b>Hometown:</b> {$hometown}<br>
                <b>Major:</b> {$major}<br>
                <b>Work:</b> {$work}<br>
            </div>
        </div>";
        }
        ?>
    </body>
</html>