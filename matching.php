<html>
<head>
    <title>Matching Page</title>
</head>
<style>
.promoImage{
    max-width: 152px;
    height: auto;
}
.imageCard{
    margin-left: 15%;
    margin-right: 15%;
    margin-top: 1.5em;
    margin-bottom: 1.5em;
    display: flex;
    background-color: #ffe7d1;
    box-shadow: 0 0 30px 0px #000;
    -moz-box-shadow: 0 0 30px 0px #000;
    -webkit-box-shadow: 0 0 30px 0px #9c9c9c;
    height: 152px;
}
.promoText{
    padding: 10px;
}
</style>
<script type="text/javascript" charset="utf8" src="//code.jquery.com/jquery-3.3.1.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<body>

<?php
include_once('lib/php/db_connect.php');
include_once('lib/php/users.php');
$mysqli = getConnection();
$user_id = getUserID();

$gender = '';
$currentUserQuery = $mysqli->query("SELECT gender FROM Dating_Website.Users WHERE email = '$user_id'");
if ($currentUserQuery != False && ($currentUserResult = $currentUserQuery->fetch_assoc())){
    $gender = $currentUserResult['gender'];
}
?>
    <div style="margin-left: 20%; margin-right: 20%">
        <h1>Find THE ONE</h1>
<?php
    $potentialMatchesQuery = $mysqli->query("SELECT * FROM Dating_Website.Users u JOIN Dating_Website.Profile p ON u.email = p.user_id
            LEFT JOIN Dating_Website.Image i on u.email = i.user_id WHERE gender <> '$gender' AND email NOT IN (SELECT person2 FROM Dating_Website.Liked WHERE person1 = '$user_id')
            AND email NOT IN (SELECT person1 FROM Dating_Website.Liked WHERE person2 = '$user_id' AND matched IS NOT NULL)");
    while ($potentialMatchesQuery != False && ($potentialMatchesResult = $potentialMatchesQuery->fetch_assoc())){
        $image = 'images/missing.jpg';
        if ($potentialMatchesResult['filename']){
            $image = 'images/' . $potentialMatchesResult['filename'];
        }
?>
        <div class="imageCard" id="<?php echo $potentialMatchesResult['email']; ?>">
            <img class="promoImage" src="<?php echo $image; ?>"><p class="promoText"><br>
            <?php
                echo $potentialMatchesResult['first_name'] . ' ' . $potentialMatchesResult['last_name'] . '<br>';
                $feet = floor($potentialMatchesResult['height']/12);
                $inches = $potentialMatchesResult['height']%12;
                echo "Height: " . $feet . "'" . $inches . "\"<br>";
                echo "About me: " . $potentialMatchesResult['bio'] . "<br>";
                echo "Major: " . $potentialMatchesResult['major'] . "<br>";
                echo "Work: " . $potentialMatchesResult['work'] . "<br>";
                echo "Hometown: " . $potentialMatchesResult['hometown'] . "<br>";
            ?>
            </p>
            <div>
                <button style="background-color: green;" onclick="accept('<?php echo $potentialMatchesResult['email']; ?>')">Yes</button>
                <button style="background-color: red;" onclick="reject('<?php echo $potentialMatchesResult['email']; ?>')">No</button>
            </div>
        </div>
    </div>
<?php
    }
?>
</body>
</html>

<script>
    function accept(person){
        $.ajax({
            type: "POST",
            url: "yesSubmit.php",
            data: {person:person},
            success: function(data, status, jqxhr) {
                if (data['status'] === "success") {
		    //id = "#".concat(person);
                    //$(id).attr('hidden', true);
		    window.location.replace('matching.php');
                }
                else{
                    alert ("client error: " + data['cause']);
                }
            },
            error: function(XMLHttpTicket, status, error) {
                alert("server error: " + error);
            }
        });
    }

    function reject(person){
        $.ajax({
            type: "POST",
            url: "noSubmit.php",
            data: {person:person},
            success: function(data, status, jqxhr) {
                if (data['status'] === "success") {
		    //id = "#".concat(person);
                    //$(id).attr('hidden', true);
		    window.location.replace('matching.php');
                }
                else{
                    alert ("client error: " + data['cause']);
                }
            },
            error: function(XMLHttpTicket, status, error) {
                alert("server error: " + error);
            }
        });
    }
</script>
