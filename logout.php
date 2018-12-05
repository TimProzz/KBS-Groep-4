<?php

include("package.inc.php");
?>

<?php

unset($_COOKIE['login']);
setcookie("login", "", time() - 3600, "/");

header("Location: index.php?Success=Je bent succesvol uitgelogd!");
exit;
?>