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
                    echo "<section><img src='img/event".$i.".jpg'></section>";
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
        </script>
    </body>
</html>