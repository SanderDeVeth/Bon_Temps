<?php 
require_once 'header.php'; // Haal functies op

$total_price = 0; 

if (isset($_COOKIE['cart_items'])){
    $cart_items = unserialize($_COOKIE['cart_items']);
}

if(!empty($cart_items)){
    
//start table
echo "
    <table class='tabel1'>
        <tr>
           <th>Album</th>
            <th>Prijs</th>
            <th>Aantal</th>
        </tr>";

    foreach($cart_items as $albumID => $album){
        echo "
        <tr>
            <td> " .  $album['albumtitel'] . " </td>
            <td> &euro; " .  $album['prijs'] . " </td>
            <td> " .  $album['aantal'] . " </td>
        </tr>";
        $price =  $album['prijs'] *  $album['aantal'];
        $total_price = $total_price + $price;
    }

    echo "<tr>
                <td><b>Totaal</b></td>
                <td>&euro; " . number_format($total_price, 2, '.', '') . "</td>
               <td></td>
           </tr>
           <tr>
                <td></td>
                <td><h2><a href='checkout.php'>Betaal</a><h2></td> 
                <td></td>
           </tr>
         </table>";
}
 
else{
    echo "<div class='alert alert-danger'>";
        echo "<h2 align='center'>Er zitten nog geen MP3's in uw winkelmandje</h2>";
    echo "</div>";
}

require_once 'footer.php';
?>