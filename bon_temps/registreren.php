<?php 
require_once 'header.php'; // Haal functies op

if(isset($_POST['registreren'])){ // Check of de gebruiker het formulier gepost heeft
    registreren(); // Login functie
}
?>
<div class="registreren" align="center">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <fieldset>
            <legend align="center">Vul hier uw gegevens in:</legend>
            <input type="text" name="voornaam" placeholder="Uw voornaam" autofocus><br>
            <input type="text" name="achternaam" placeholder="Uw achternaam"><br>
            <input type="text" name="adres" placeholder="Straatnaam nr"><br>
            <input type="text" name="postcode" placeholder="1234XX"><br>
            <input type="text" name="woonplaats" placeholder="Uw woonplaats"><br>
            <input type="text" name="email" placeholder="Uw e-mail"><br>
            <input type="password" name ="wachtwoord" placeholder="Kies een wachtwoord"><br>
            <input type="password" name ="herhaal" placeholder="Herhaal uw wachtwoord"><br>
            <input type="submit" name="registreren" value="Registreren">
        </fieldset>
    </form>
</div>
<?php 
require_once 'footer.php';
?>