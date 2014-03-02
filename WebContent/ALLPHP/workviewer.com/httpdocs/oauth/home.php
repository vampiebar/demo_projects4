<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

//Always place this code at the top of the Page
session_start();
if (!isset($_SESSION['id'])) {
    // Redirection to login page twitter or facebook
    header("location: index.php");
}

echo '<h1>Welcome</h1>';
echo 'id : ' . $_SESSION['id'];
echo '<br/>İsminiz : ' . $_SESSION['username'];
echo '<br/>Email adresiniz : ' . $_SESSION['email'];
echo '<br/>Profil resminiz: <img src="https://graph.facebook.com/'.$_SESSION["oauth_id"].'/picture?type=large">';
echo '<br/><a href="logout.php?logout">Çıkış Yap</a>';
?>
