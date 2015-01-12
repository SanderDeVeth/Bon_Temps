	<?php
	if(isset($_COOKIE['cart_items'])){
		$cart_items = unserialize($_COOKIE['cart_items']);
	}
	else {
		$cart_items = array();
	}
	 
	// product en id naam
	$albumcode = isset($_GET['albumcode']) ? $_GET['albumcode'] : "";
	$genre = isset($_GET['genre']) ? $_GET['genre'] : "";
	$albumtitel = isset($_GET['albumtitel']) ? $_GET['albumtitel'] : "";
	$prijs = isset($_GET['prijs']) ? $_GET['prijs'] : "";

	$albumbestaat = false;
	foreach($cart_items as $albumID => $album){
		if($album['albumcode'] == $albumcode){
			$cart_items[$albumID]['aantal'] ++;
			$albumbestaat = true;
		}
	}
		
	if(!$albumbestaat){
		 $addalbum = array(
			"prijs" => $prijs,
			"albumcode" => $albumcode,
			"albumtitel" => $albumtitel,
			"aantal" => "1"
		 );
		array_push($cart_items, $addalbum);
	}
	// nieuw item bij array

	setcookie('cart_items', serialize($cart_items));
	//echo $_COOKIE['cart_items'];
	header('Location: bestel.php?genre=' . $genre . '&action=added&albumcode' . $albumcode . '&albumtitel=' . $albumtitel . '&prijs=' . $prijs);
?>