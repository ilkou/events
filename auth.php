<?php
function auth($login, $passwd) {
    $path = "../private/passwd";
    if (!file_exists("../private"))
        mkdir("../private");
    if (!file_exists($path))
        file_put_contents($path, "");
    $data = unserialize(file_get_contents($path));
    if ($data) {
    foreach ($data as $log => $pass) {
        if ($pass['login'] == $login) {
            if ($pass['passwd'] != hash('whirlpool', $passwd)) {
                return (false);
            }
            else {
                return (true);
            }
        }
    }}
    return (false);
}
?>