<?php
session_start();

// Usunięcie zawartości sesji
$_SESSION['cart'] = array();

// Usunięcie sesji
session_destroy();

// Przekierowanie użytkownika do strony głównej lub innej odpowiedniej strony
header("Location: koszyk.php");
exit();
?>