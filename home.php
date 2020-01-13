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
        <script type="text/javascript" src="node_modules/jquery-3.4.1.min.js"></script>
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
                    exit();
                }
                $query = "select * from evenement";
                $result = mysqli_query($conn, $query);
                if(!$result)
                    echo "riens";
                    $i = 1;
                while($row = mysqli_fetch_assoc($result))
                {
                        $description = $row["details"];
                        $description = nl2br($description);
                        $d_first = substr($description, 0, 150);
                        $d_second = substr($description, 150, strlen($description));
                        echo '<section><div id="ins-cont'.$i.'"><img id="ins-img'.$i.'" src='.$row["imgPath"].'>';
                        echo '<form action="SaveEvent.php" method="GET">';
                        echo '<input type="hidden" name="event" value="'.$i.'" readonly>';
                        echo '<input id="ins-btn'.$i.'" type="submit" name="submit" value="INSCRIRE"></form>';
                        echo '</div><div class="description">';
                        echo '<h1>'.$row["titre"].'</h1>';
                        echo '<div>'.$d_first.'<span id="dots'.$i.'">...</span><span id="more'.$i.'">'.$d_second.'</span></div>
                        <button onclick="hide_text('.$i.')" id="btn'.$i.'">Lire la suite</button></div></section>';
                        $i++;
                 }
                 CloseCon($conn);
            ?>
        </main>
        <script>
            let i = 1;
            let el, ins_btn;
            while ((el = document.getElementById('more'+i.toString())) != null) {
                el.style.display = 'none';
                ins_btn = document.getElementById('ins-btn'+i.toString());
                ins_btn.style = 'opacity: 0;transition: opacity 0.5s ease;position: relative; border: none; padding: 4px; height: 30px;cursor: pointer;background-color: rgb(0,250,0);font-weight: bold;color:#fff;';
                document.getElementById('btn'+i.toString()).style = 'border: none; outline:0; color: blue';
                let ins_cont_id = "#ins-cont" + i.toString();
                let ins_btn_id = "#ins-btn" + i.toString();
                let inside = ins_cont_id + ' ' + ins_btn_id;
                $(ins_cont_id).css({"position": "relative"});
                $(inside).css({"position": "absolute", "top": "60%", "left": "50%", "transform": "translate(-50%, -50%)", "opacity":"0"});
                $(ins_cont_id).hover(function(){
                        $(this).css({"opacity": "0.7","transition":"opacity 0.5s ease;"});
                        $(ins_btn_id).css("opacity", 1);
                    }, function(){
                        $(this).css("opacity", 1);
                        $(ins_btn_id).css({"opacity": "0","transition":"opacity 0.5s ease;"});
                    });
                i++;
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
            let msg = "<?php print($_SESSION['is_admin']); ?>"; console.log('admin: ' + msg);
        </script>
    </body>
</html>