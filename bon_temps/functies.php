<?php
//========================================Inloggen, gebruiker maken, ingelogd blijven==================================== //
function login(){
	$email = $_POST['email'];
	$email = strtolower($email);
	$wachtwoord = hash('sha512', $_POST['wachtwoord']); // Encryptie
	$verbinding = mysql_connect("localhost", "root", "") or die ("Kon geen verbinding maken");
	mysql_select_db("bon_temps") or die("Kon geen database selecteren");
	$query = ("SELECT email, wachtwoord, voornaam, id FROM klant WHERE email = '$email'");
	$resultaat = mysql_query($query) or die ( mysql_error());
	$uitkomst = mysql_fetch_array($resultaat, MYSQL_ASSOC);
	if($email == $uitkomst['email'] && $wachtwoord == $uitkomst['wachtwoord']){
		$gebruiker = $uitkomst['voornaam'];
		$gebruikerid = $uitkomst['id'];
		setcookie("user", $gebruiker);
		setcookie("userid", $gebruikerid);
		
		$msg = "U bent succesvol ingelogd.";
		echo '<script type="text/javascript">alert("' . $msg . '"); </script>';
        header("location: ingelogd.php");
	}
	else{
		$msg = "Email of wachtwoord is onjuist!";
		echo '<script type="text/javascript">alert("' . $msg . '"); </script>';
	}
}

function registreren(){
        // Verbinding maken
	$verbinding = mysql_connect("localhost", "root", "")	or die ("Kon geen verbinding maken");
	mysql_select_db("bon_temps") or die("Kon geen database selecteren");
        
        // Haal posts op
	$voornaam = $_POST['voornaam'];
    $achternaam = $_POST['achternaam'];
	$adres = $_POST['adres'];
	$postcode = $_POST['postcode'];
	$postcode = strtolower($postcode);
	$woonplaats = $_POST['woonplaats'];
	$email = $_POST['email'];
	$email = strtolower($email);
	$wachtwoord = hash('sha512', $_POST['wachtwoord']);  // Encryptie
        
        // Check of e-mail al bestaat
	$permission = false;
	$query = ("SELECT email FROM klant where email ='$email'");
	$resultaat = mysql_query($query) or die ( mysql_error());
	$uitkomst = mysql_fetch_array($resultaat, MYSQL_ASSOC);
	if(mysql_num_rows($resultaat)==0){
        $permission = true;
	}
        
       
	if($permission == true){   
                // Voeg toe aan database
		$query = ("INSERT INTO klant (`id`, `voornaam`, `achternaam`, `adres`, `postcode`, `woonplaats`, `email`, `wachtwoord`)
									VALUES (NULL , '$voornaam', '$achternaam', '$adres', '$postcode', '$woonplaats', '$email', '$wachtwoord')");
		mysql_query($query);
		header("location: inloggen.php");
	}
	else{
		$msg = "Dit email adres is al in gebruik";
		echo '<script type="text/javascript">alert("' . $msg . '"); </script>';
		
		echo "<script language=\"JavaScript\" type=\"text/javascript\">
		var reload = false;
		var loc=\"\"+document.location;
		loc = loc.indexOf(\"?reload=\")!=-1?loc.substring(loc.indexOf(\"?reload=\")+10,loc.length):\"\";
		loc = loc.indexOf(\"&\")!=-1?loc.substring(0,loc.indexOf(\"&\")):loc;
		reload = loc!=\"\"?(loc==\"true\"):reload;
		
		function reloadPage() {
		    if (!reload) 
			window.location.replace(window.location+\"?reload=true\");
		}
		//You can call this via the body tag if desired
		reloadPage();
		</script>
		//echo '<script type=\"text/javascript\">window.location.reload(); </script>'";
	}
}

function printname(){	
	if(isset($_COOKIE['user'])){
		echo '<b>' . $_COOKIE['user'] . '</b>' . "&nbsp; &nbsp; &nbsp;";
		//echo '<a href="inloggen.php?uitloggen=yes" style="font-size: 12px;">(uitloggen)</a>';             
	}
	else{
		echo "Gast";
	}
}

function logout(){
    setcookie('user','',time()-3600);
    setcookie('userid','',time()-3600);
    setcookie('cart_items', '',time()-3600);
    header( 'Location: index.php' ) ;
}

function checkout(){
    // Verbinding maken
    $verbinding = mysql_connect("localhost", "root", "") or die ("Kon geen verbinding maken");
    mysql_select_db("bon_temps") or die("Kon geen database selecteren");
    
    $query = ("INSERT INTO bestelling (`id` , `klant_id`, `besteld_op`)
										VALUES (NULL , '$_COOKIE[userid]', NULL)");
	mysql_query($query);
    $bestelling_id =  mysql_insert_id();
    
    $cart_items = unserialize($_COOKIE['cart_items']);
    foreach($cart_items as $menuID => $menu){
        $query = ("INSERT INTO bestelling_item (`id` , `bestelling_id`, `menucode`, `aantal`)
													VALUES (NULL , '$bestelling_id', '$menu[menucode]', '$menu[aantal]')");
        mysql_query($query) or die("A MySQL error has occurred.<br />Your Query: " . $query . "<br /> Error: (" . mysql_errno() . ") " . mysql_error());
   }
    
    setcookie('cart_items', '',time()-3600); 
    header('Location: betaald.php');
}

function geleegd(){
    setcookie('cart_items', '',time()-3600);
}

function laadpagina(){
    if(isset($_COOKIE['user'])){        
        echo "<a href='bestel.php' align='left'>Bestellen</a>";
        echo "<a href='winkelmand.php'>Winkelmandje";
        
        $aantal = 0;
        if (isset($_COOKIE['cart_items'])){
        $cart_items = unserialize($_COOKIE['cart_items']);
            foreach($cart_items as $menuID => $menu){
                $aantal = $menu['aantal'] + $aantal;
            }
            echo " (" . $aantal . ")";
        }
        echo "<img src='images/icon-winkelmand2.png'></a>";
        echo "<a href='logout.php'>Log uit</a>";
    }
    else{
        echo "<a href='inloggen.php'>Inloggen</a>";
    }  
}

//================================================= Bestelpagina ================================================= //

function bestelpagina(){
    $query = "SELECT * FROM menu";

        if (isset($_POST["id"])){
            $id = $_POST["id"];
            header("location: bestel.php?id= $");
        }

        if(isset($_GET["id"])){
            $query ="SELECT * FROM menu WHERE id='". $_GET['id']."'";
        }

    $verbinding = mysql_connect("localhost", "root", "") or die ("Kon geen verbinding maken");
    mysql_select_db("bon_temps") or die("Kon geen database selecteren");
    $resultaatB = mysql_query($query) or die (mysql_error());
		
//========================================================== Tabel ============================================= //
    while($row= mysql_fetch_array($resultaatB, MYSQL_ASSOC)){
        echo"<table class=tabel>";
        echo"<tr>";
        echo"<td><h2>" . $row['id'] . "</h2></td>";
        echo"<td><h2>" . $row['beschrijving'] . "</h2></td>";
        echo"<td><h2>&euro;" . $row['prijs'] . "</h2></td>";
        
        echo "<td><h2><a href='add_to_cart.php?menucode=" . $row['menucode'] . "&menutitel=" . $row['menutitel'] . "&prijs=" . $row['prijs'] . "&id=" . $row['id'] . "'>Plaats in winkelwagen</a></h2></td>";
        echo"</tr>";
    }
}
?>