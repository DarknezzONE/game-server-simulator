<?php
setcookie('last_page', 'index.php', time() + 300);
?>

<!doctype html>
<html lang="pl">

<head>
    <meta charset="utf-8">

    <title>Gry.mimuw</title>
    <meta name="description" content="gierki">
    <meta name="author" content="kk418331+kj418271">

    <link rel="stylesheet" href="styles.css">
    <link rel="shortcut icon" href="https://www.mimuw.edu.pl/sites/default/files/mim_mini.png" type="image/png">
</head>

<body>
    <div class="up">

        <img class="left" src="https://www.mimuw.edu.pl/sites/all/themes/mimuwtheme/images/MIM_logo_sygnet_pl.png">

        <div id="MyClockDisplay" class="clock" onload="showTime()"></div>
        <script src="clock.js">
        </script>

        <div class="right">
            <?php if (isset($_COOKIE['active_username'])) : ?>
                <form action="profile.php">
                    <input type="submit" value="PROFIL" />
                </form>
            <?php else : ?>
                <form action="login_page.php">
                    <input type="submit" value="ZALOGUJ" />
                </form>
                <form action="registration_page.php">
                    <input type="submit" value="ZAREJESTRUJ" />
                </form>
            <?php endif;
            echo '<form action="leaderboards.php">
                <input type="submit" value="RANKINGI" />
            </form>';

            if (isset($_COOKIE['active_username']))
                echo '<form action="logout.php">
                    <input type="submit" value="WYLOGUJ" />
                </form>';
            ?>
        </div>
    </div>

    <?php
    require_once('database_info.php');
    require_once('query.php');
    if (!($conn = oci_connect($dbuser, $dbpass, "//labora.mimuw.edu.pl/LABS", 'AL32UTF8'))) {
        header("Location: error_page.php");
        exit;
    }

    $result = query($conn, "SELECT nazwa FROM gry");
    $imgs = array(
        "https://i.imgur.com/DPeTtm2.jpeg",
        "https://s2.best-wallpaper.net/wallpaper/iphone/1911/Red-and-blue-pawn_iphone_1080x1920.jpg",
        "https://images.wallpaperscraft.com/image/soccer_ball_nike_grass_113053_1080x1920.jpg",
        "https://mfiles.alphacoders.com/166/166285.jpg",
        "https://i.pinimg.com/originals/e9/72/9a/e9729ae1740af32fe8ba141d6b78ed51.jpg",
        "https://mfiles.alphacoders.com/629/thumb-1920-629691.png"
    );

    echo '<div class="parent">';
    for ($i = 0; $i < $result[1]; $i++)
        echo '
                    <div class="box">
                    <div class="container">
                    <a href="game_panel.php?game=' . $result[0]['NAZWA'][$i] . '">
                    <img class="box" src="' . $imgs[$i] . '">
                    <div class="middle"><div class="boxtext">' . strtoupper($result[0]['NAZWA'][$i]) . '</div></div>
                    </a>
                    </div>
                </div>';

    // Placeholder imgs
    for ($i = 0; $i < 4; $i++)
        echo '<div class="box">
                        <div class="container">
                        <a href="#">
                        <img class="box" src="' . $imgs[5] . '">
                        <div class="middle"><div class="boxtext">PLACEHOLDER</div></div>
                        </a>
                        </div>
                    </div>';
    echo '</div>';

    oci_close($conn);
    ?>
</body>

</html>