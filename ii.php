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
        <?php
        echo "gdfgfdg";
        ?>
        <script>
            document.getElementById('connexion').addEventListener("click", function() {
                document.getElementsByClassName('popup')[0].style.display = 'flex';
            })
            document.getElementById('close-connexion').addEventListener("click", function(){
                document.getElementsByClassName('popup')[0].style.display = 'none';
                document.getElementsByClassName('login-input')[0].value = '';
                document.getElementsByClassName('login-input')[1].value = '';
            })
        </script>
    </body>
</html>