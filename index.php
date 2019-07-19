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

<a id="btnEmpty" href="index.php?action=empty">Empty Cart</a>
<?php if(isset($_SESSION['cart_item'])): 
    $total_quantity = 0;
    $total_price = 0;
?>
    <table class="tbl-cart" cellpadding="10" cellspacing="1">
        <tbody>
            <tr>
                <th style="text-align:left;">Name</th>
                <th style="text-align:left;">Code</th>
                <th style="text-align:right;" width="5%">Quantity</th>
                <th style="text-align:right;" width="10%">Unit Price</th>
                <th style="text-align:right;" width="10%">Price</th>
                <th style="text-align:center;" width="5%">Remove</th>
            </tr>	

            <?php foreach($_SESSION['cart_item'] as $itemCart):
                $item_price = $itemCart["quantity"]*$itemCart["price"]; 
            ?>
            <tr>
                <td><img src="<?php echo $itemCart["image"]; ?>" class="cart-item-image" /><?php echo $itemCart["name"]; ?></td>
                <td><?php echo $itemCart["code"]; ?></td>
                <td style="text-align:right;"><?php echo $itemCart["quantity"]; ?></td>
                <td  style="text-align:right;"><?php echo "$ ".$itemCart["price"]; ?></td>
                <td  style="text-align:right;"><?php echo "$ ". number_format($item_price,2); ?></td>
                <td style="text-align:center;"><a href="index.php?action=remove&code=<?php echo $itemCart["code"]; ?>" class="btnRemoveAction"><img src="icon-delete.png" alt="Remove Item" /></a></td>
            </tr>   
            <?php 
                $total_quantity += $itemCart["quantity"];
                $total_price += ($itemCart["price"]*$itemCart["quantity"]);
                endforeach; 
            ?>

            <tr>
                <td colspan="2" align="right">Total:</td>
                <td align="right"><?php echo $total_quantity; ?></td>
                <td align="right" colspan="2"><strong><?php echo "$ ".number_format($total_price, 2); ?></strong></td>
                <td></td>
            </tr>
        </tbody>
    </table>		

<?php else: ?>
    <div class="no-records">Your Cart is Empty</div>
<?php endif; ?>

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