<!DOCTYPE html>
<?php
    session_start();
    if (!$_SESSION['loggued_on_user'])
        header("Location: index.php");
?>
<html>
    <head>
        <title>events</title>
        <link rel="stylesheet" type="text/css" href="login.css">
    </head>
    <body>
        <header id="home">
            <nav>
                <h1>Événements de l’ENSAK</h1>
                <ul class="header-list-2"><?= $_SESSION['loggued_on_user']?>
                    <li><a href="addEvent.html" id="add-event">AJOUTER ÉVÉNEMENT</a></li>
                    <li><a href="logout.php" id="deconnexion">DÉCONNEXION</a></li>
                </ul>
            </nav>
        </header>
        <main>
            <?php
                include 'db_connect.php';
                $conn = OpenCon();
                if ($conn->connect_error) {
                    ?><script>alert('can\'t connect to database: <?= $conn->connect_error ?>')</script><?php
                }
                $query = "select * from evenement";
                $result = mysqli_query($conn, $query);
                if(!$result)
                    echo "riens";
                    $i = 1;
                while($row = mysqli_fetch_assoc($result))
                {
                        $description = $row["details"];
                        $d_first = substr($description, 0, 50);
                        $d_second = substr($description, 50, strlen($description));
                        echo '<section><div><img src='.$row["imgPath"].'></div><div class="description"><h1>'.$row["titre"].'</h1><div>'.$d_first.'<span id="dots'.$i.'">...</span><span id="more'.$i.'">'.$d_second.'</span></div>
                        <button onclick="hide_text('.$i.')" id="btn'.$i.'">Lire la suite</button></div></section>';
                        $i++;
                 }
            ?>
        </main>
        <script>
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