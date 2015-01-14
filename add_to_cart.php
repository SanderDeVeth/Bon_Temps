	<?php
	if(isset($_COOKIE['cart_items'])){
		$cart_items = unserialize($_COOKIE['cart_items']);
	}
	else {
		$cart_items = array();
	}
	 
	// product en id naam
	$menucode = isset($_GET['menucode']) ? $_GET['menucode'] : "";
	$type = isset($_GET['type']) ? $_GET['type'] : "";
	$menutitel = isset($_GET['menutitel']) ? $_GET['menutitel'] : "";
	$prijs = isset($_GET['prijs']) ? $_GET['prijs'] : "";

	$menubestaat = false;
	foreach($cart_items as $menuID => $menu){
		if($menu['menucode'] == $menucode){
			$cart_items[$menuID]['aantal'] ++;
			$menubestaat = true;
		}
	}
		
	if(!$menubestaat){
		 $addmenu = array(
			"prijs" => $prijs,
			"menucode" => $menucode,
			"menutitel" => $menutitel,
			"aantal" => "1"
		 );
		array_push($cart_items, $addmenu);
	}
	// nieuw item bij array

	setcookie('cart_items', serialize($cart_items));
	//echo $_COOKIE['cart_items'];
	header('Location: bestel.php?type=' . $type . '&action=added&menucode' . $menucode . '&menutitel=' . $menutitel . '&prijs=' . $prijs);
?>