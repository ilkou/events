<!DOCTYPE html>
<html>
    <head>
        <title>events</title>
        <link rel="stylesheet" type="text/css" href="login.css">
    </head>
    <body>
        <header id="home">
            <nav>
                <h1>Événements de l’ENSAK</h1>
                <ul class="header-list">
                    <li><a id="connexion" href="#">CONNEXION</a></li>
                </ul>
            </nav>
        </header>
        <main>
            <?php
                for ($i = 1; $i <= 3; $i++) {
                    $description = file_get_contents("event_data/event".$i.".txt");
                    $d_first = substr($description, 0, 50);
                    $d_second = substr($description, 50, strlen($description));
                    echo '<section><div><img src="event_data/event'.$i.'.jpg"></div><div class="description"><h1>Event'.$i.'</h1><div>'.$d_first.'<span id="dots'.$i.'">...</span><span id="more'.$i.'">'.$d_second.'</span></div>
                    <button onclick="hide_text('.$i.')" id="btn'.$i.'">Lire la suite</button></div></section>';
                }
            ?>
        </main>
        <div class="popup" style="display: none">
            <div class="popup-content">
                <img src="img/login-connexion.png" alt="login" id="login-connexion">
                <img src="img/close-connexion.png" alt="close" id="close-connexion">
                <form action="login.php" method="post">
                    <input type="login" class="login-input" name="login" placeholder="Identifiant" autocomplete="off" required/>
                    <input type="password" class="login-input" name="passwd" placeholder="Mot de passe" autocomplete="off" required/>
                    <input type="submit" name="submit" value="OK" />
                </form>
            <a id="create-login" href="create.html">Créer un compte</a>
            </div>
        </div>
        <script>
            function reloadScrollBars() {
                document.documentElement.style.overflow = 'auto';  // firefox, chrome
                //document.body.scroll = "yes"; // ie only
            }
            function unloadScrollBars() {
                document.documentElement.style.overflow = 'hidden';  // firefox, chrome
                //document.body.scroll = "no"; // ie only
            }
            document.getElementById('connexion').addEventListener("click", function() {
                document.getElementsByClassName('popup')[0].style.display = 'flex';
                unloadScrollBars();
            })
            document.getElementById('close-connexion').addEventListener("click", function(){
                document.getElementsByClassName('popup')[0].style.display = 'none';
                reloadScrollBars();
                document.getElementsByClassName('login-input')[0].value = '';
                document.getElementsByClassName('login-input')[1].value = '';
            })
            for (i = 1; i <= 3; i++) {
                document.getElementById('more'+i.toString()).style.display = 'none';
                document.getElementById('btn'+i.toString()).style = 'border: none; outline:0; color: blue';
            }
            function hide_text(i) {
                var dots = document.getElementById("dots"+i.toString());
                var moreText = document.getElementById("more"+i.toString());
                var btnText = document.getElementById("btn"+i.toString());
                if (dots.style.display === "none") {
                    dots.style.display = "inline";
                    btnText.innerHTML = "Lire la suite";
                    moreText.style.display = "none";
                } else {
                    dots.style.display = "none";
                    btnText.innerHTML = "Voir moins";
                    moreText.style.display = "inline";
                }
            }
        </script>
    </body>
</html>