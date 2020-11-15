<!DOCTYPE html>
<html>
        <body>                                                                                                                                                                                                 <?php                                                                                                                                                                                                                                                                                                                                                                                                                                 echo "echo";
        if (isset($_GET['userid'])) {
                echo $_GET['userid'];
                $test = $_GET['userid'];
                require_once("lib/php/db_connect.php");
                require_once("lib/php/users.php");
                $mysqli = getConnection();
                $profileid = $_GET['profileid'];

                $result = $mysqli->query("SELECT * FROM Dating_Website.Liked WHERE person2 = '{$test}' AND person1 = '{$profileid}");                                                                                          if(empty($result)) {
                        $newQuery = getConnection();
                        if ($newQuery->query("INSERT INTO Dating_Website.Liked (person1, person2, matched) VALUES ('{$test}', '{$profileid}', '0')") === TRUE) {                                                                               echo "New record created";
                        } else {
                                echo "error: " . $newQuery->error;
                        }
                        echo "empty";
                        echo $test;
                        echo $profileid;
                } else {
                        $mysqli->query("UPDATE Dating_Website.Liked SET matched = 1 WHERE person2 = '{$test}' AND person1 = '{$profileid}");
                        echo "not empty";
                }
        } else {
                echo "is not set";
        }
?>
<script> window.location.href = "profiles.php"; </script>
        </body>
</html> 
