<?php 
require_once 'header.php'; // Haal functies op
?>

<div class="welkom">
    <h3 align="center">Welkom op de website van Bon-Temps.nl</h3>
    <p align="center">  Voordat u kunt beginnen met bestellen moet u eerst even<a href='inloggen.php'> inloggen!</a>
    </p>
</div>    
<div class="inloggen" align="center">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input type="text" name="email" placeholder="Uw e-mail..." autofocus>
        <input type="password" name="wachtwoord" placeholder="Uw wachtwoord...">
        <input type="submit" name="inlog" value="Inloggen"><br>
        <a align="center" class="link" href="registreren.php">Nog geen account?</a>
    </form>
</div>

<?php 
require_once 'footer.php';
?>