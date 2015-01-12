<?php 
require_once 'functies.php'; // Haal functies op

if(isset($_POST['inlog'])){ // Check of de gebruiker het formulier gepost hebt
    login(); // Login functie
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        
        <title>Bon Temps</title>
        
        <link rel="stylesheet" href="opmaak.css">
        <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon"> 
    </head>
    <body>
        <div class="topbar"> 
            <div class ="left">
                <a href="index.php">Home</a>
                <a href="contact.php">Contact</a>
            </div>
            <div class="right">
                <?php
                     laadpagina(); // Check of je ingelogd bent en laat dan het correcte menu zien
                ?>
            </div>
        </div>