
<?php

    if (isset($_SESSION["compte"])) {
        echo "oui";
    }else {
        
        ?>
    
        <form id="formCo" action="" method="post">
            <label for="login">Login :</label>
            <input type="text" name="login" id="login" placeholder="entrer votre login..." onkeypress="return controlSaisie()"> 
            <label for="password">Mot de passe :</label>
            <input type="password" name="password" id="password" onkeypress="return controlSaisie()">
            <input type="button" value="s'authentifier" onclick="validationFormSub()">
        </form>
        
        <span id="badChar"></span>
        
        <?php 
        
    }

?>

