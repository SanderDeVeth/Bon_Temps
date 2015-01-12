<?php 
require_once 'header.php'; // Haal functies op
?>
        
<div class="inloggen">
    <h3> U kunt hieronder inloggen</h3>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input type="text" name="email" placeholder="Uw e-mail..." autofocus>
        <input type="password" name="wachtwoord" placeholder="Uw wachtwoord...">
        <input type="submit" name="inlog" value="Inloggen"><br>
        <a class="link" href="registreren.php">Nog geen account?</a>
    </form>
</div>

<?php 
require_once 'footer.php';
?>