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
	   <th>Menu</th>
		<th>Prijs</th>
		<th>Aantal</th>
	</tr>";

	foreach($cart_items as $menuID => $menu){
		echo "
		<tr>
			<td> " . $menu['menutitel'] . " </td>
			<td> &euro; " . $menu['prijs'] . " </td>
			<td> " . $menu['aantal'] . " </td>
		</tr>";
		$price = $menu['prijs'] * $menu['aantal'];
		$total_price = $total_price + $price;
	}

	echo "
		<tr>
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
		echo "<h2 align='center'>Er zitten nog geen bestellingen in uw winkelmandje</h2>";
	echo "</div>";
}

require_once 'footer.php';
?>