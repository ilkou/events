<?php
if ($_POST['submit'] !== "OK" || $_POST['login'] == "" || $_POST['passwd'] == "") {
    echo "ERROR\n";
}
else {
    $path = "../private/passwd";
    if (!file_exists("../private"))
        mkdir("../private");
    if (!file_exists($path))
        file_put_contents($path, "");
    $data = unserialize(file_get_contents($path));
    if ($data == false) {
        $user['login'] = $_POST['login'];
        $user['passwd'] = hash('whirlpool', $_POST['passwd']);
        $store[] = $user;
        file_put_contents($path, serialize($store)."\n");
    }
    else {
        foreach ($data as $log => $pass) {
            if ($pass['login'] == $_POST['login']) {
                echo "ERROR\n";
                return (0);
            }
        }
        $user['login'] = $_POST['login'];
        $user['passwd'] = hash('whirlpool', $_POST['passwd']);
        $data[] = $user;
        file_put_contents($path, serialize($data)."\n");
    }
    header('Location: index.html');
    echo "OK\n";
}
?>