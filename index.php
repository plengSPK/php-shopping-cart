<?php
require_once('process.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shopping Cart</title>
</head>
<body>
    <div class="container">
        <?php foreach($items as $item): ?>
            <div class="product-item">
                <form method="post" action="index.php?action=add&code=<?php echo $item["code"]; ?>">
                    <div class="product-image"><img src="<?php echo $item["image"]; ?>"></div>
                    <div class="product-tile-footer">
                    <div class="product-title"><?php echo $item["name"]; ?></div>
                    <div class="product-price"><?php echo "$".$item["price"]; ?></div>
                    <div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" /><input type="submit" value="Add to Cart" class="btnAddAction" /></div>
                </div>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>