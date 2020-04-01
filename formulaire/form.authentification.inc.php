
<?php

    if (isset($_SESSION["compte"])) {
        echo "oui";
    }else {
    
        echo "non";
        echo "<script type='text/javascript'>";
            echo "var publicKeyRsa = 'gfdgfdgfdgfd'";
        echo "</script>";
    }

?>

<form id="formCo" action="fghdsk" method="post">
    <label for="login">Login :</label>
    <input type="text" name="login" id="login" placeholder="entrer votre login..." onkeypress="return controlSaisie()"></br>
    <label for="password">Mot de passe :</label>
    <input type="password" name="password" id="password" onkeypress="return controlSaisie()">
    <input type="button" value="s'authentifier" onclick="validationFormSub()">
</form>

<span id="badChar"></span>