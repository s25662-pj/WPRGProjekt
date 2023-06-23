

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Koszyk</title>
</head>
<body>


<form method="post" action="usun_koszyk.php">
    <input type="submit" value="Usuń koszyk">
</form>
<form method="post" action="index.php">
    <input type="submit" value="Powrót do głównej">
</form>


<?php
// Inicjalizacja sesji
session_start();

// Sprawdzenie, czy koszyk jest zainicjalizowany w sesji
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    echo "<h2>Zawartość koszyka:</h2>";
    echo "<ul>";

    foreach ($_SESSION['cart'] as $item) {
        echo "<li>";
        echo "Nazwa: " . $item['name'] . "<br>";
        echo "Cena: " . $item['price'] . "<br>";
        echo "Ilość: " . $item['quantity'] . "<br>";
        echo "</li>";
    }

    echo "</ul>";
} else {
    echo "Koszyk jest pusty.";
}
?>

</body>
</html>