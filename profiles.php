<!DOCTYPE html>
<html>                                                                                                                                                                                                                                               <?php                                                                                                                                                                                                                                                require_once("lib/php/db_connect.php");                                                                                                                                                                                                      require_once("lib/php/users.php");
                $mysqli = getConnection();
                $user = getUserID();                                                                                                                                                                                                                         $user = "joehank@email.com";
                $gender = $mysqli->query("SELECT gender FROM DATING_WEBSITE.Users WHERE email = '{$user}'");
                $gender = 'M';                                                                                                                                                                                                                       ?>
        <head>
                <button onclick='like("joehank@gmail.com", "test@gmail.com")'>Like</button>                                                                                                                                                          </head>
        <body>

        <table class="table table-hover table-striped">
                <thead>
                        <tr><th>Image</th><th>First Name</th><th>Last Name</th><th>bio</th><th>height</th><th>major</th><th>work</th><th>hometown</th></tr>
                <tbody>
                        <?php
               $result = $mysqli->query("SELECT * FROM Dating_Website.Profile INNER JOIN Dating_Website.Users ON Dating_Website.Profile.user_id = Dating_Website.Users.email WHERE Dating_Website.Users.gender <> 'M'");
                                        foreach($result as $profile){
                                                $id = $profile['user_id'];
                                                $bio = $profile['bio'];
                                                $first_name = $profile['first_name'];
                                                $last_name = $profile['last_name'];
                                                $height = $profile['height'];
                                                $major = $profile['major'];
                                                $work = $profile['work'];
                                                $hometown = $profile['hometown'];
                                                echo "<tr class='clickable-row' data-id='{$id}'><td><img src='https://twirpz.files.wordpress.com/2015/06/twitter-avi-gender-balanced-figure.png' height=100px width=100px/></td><td>{$first_name}</td><td>{$last_name}</td><td>{$bio}</td><td>{$height}</td><td>{$major}</td><td>{$work}</td><td>{$hometown}</td><td><button onclick='like({$user}, {$id})'>Like</button></td><td><button onclick='dislike({$user}, {$id})'>Dislike</button></td></tr>";
                                                echo "<tr></tr>";

                                                }
                        ?>
                </tbody>
        </table>
        <script>
                function like(userid, profileid) {                                                                                                                                                                                                                   window.location.href = "like.php?userid="+userid+"&profileid="+profileid;                                                                                                                                                            }

                function dislike(userid, profileid) {
                        window.alert("this is the alert");
                }
        </script>
        </body>
</html>
