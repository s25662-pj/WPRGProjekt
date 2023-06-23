
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Sklep</title>
</head>
<body>

<form method="post" action="koszyk.php" class="cart-button">
    <input type="submit" value="Koszyk">
</form>
<div class="header">
    <h1 style="text-align: center;">Sklep internetowy</h1>
</div>

</div>
<div class="grid-container">
    <?php
    session_start();

    $servername = "localhost:3306";
    $username = "mlodyalb_wprg";
    $password = "WPRGBardzoFajny";
    $dbname = "mlodyalb_wprg";

    $connection = mysqli_connect($servername, $username, $password, $dbname);

    // Sprawdzenie połączenia
    if (!$connection) {
        die("Błąd połączenia z bazą danych: " . mysqli_connect_error());
    }

    // Dodawanie produktu do koszyka
    if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
        $productId = $_POST['product_id'];
        $quantity = $_POST['quantity'];
        

        // Pobranie informacji o produkcie z bazy danych
        $query = "SELECT * FROM products WHERE product_id = '$productId'";
        $result = mysqli_query($connection, $query);
        $product = mysqli_fetch_assoc($result);

        if ($product) {
            // Sprawdzenie, czy koszyk jest już zainicjalizowany w sesji
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = array();
            }

            // Dodanie produktu do koszyka w sesji
            $cartItem = array(
                'id' => $productId,
                'name' => $product['name'],
                'price' => $product['price'],
                'quantity' => $quantity
            );

            $_SESSION['cart'][] = $cartItem;

            echo '<script>alert("Produkt został dodany do koszyka")</script>';
        }
    }

    // Pobieranie listy produktów
    $query = "SELECT * FROM products";
    $result = mysqli_query($connection, $query);

    if ($result) {
        
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="product">';
            echo '<img src="/WPRG/images/' . $row['product_id'] . '.jpg" width="400px" height="300px">';
            echo "<h2>" . $row['name'] . "</h2>";
            echo "" . $row['description'] . "<br>";
            echo "<h3>" . $row['price'] . "zł</h3><br>";

            // Dodaj formularz umożliwiający dodanie produktu do koszyka
            echo "<form method='post' action=''>";
            echo "<input type='hidden' name='product_id' value='" . $row['product_id'] . "'>";
            echo "Ilość: <input type='number' name='quantity' value='1'><br>";
            echo "<input type='submit' value='Dodaj do koszyka'>";
            echo "</form>";

            echo "<br><br>";
            echo '</div>';
        }
        
    }

    // Zamknięcie połączenia
    mysqli_close($connection);
    ?>


</div>



</body>
</html>












