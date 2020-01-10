<!-- ========= V U E =============================================================================================
 fichier				: ./mvc/vue/user/inscription.inc.php
 auteur					: Fariello loris
 date de création		: janvier 2020
 date de modification	:
 rôle					: permet de générer le code xhtml de la partie centrale de la page inscription du module user
 ================================================================================================================= -->

 <div id='content1'>
	
</div><!-- content1 -->
<div id="content2">
    <div id="formInscription">
        <form action="#" method="post">
            <label for="login">Login :</label>
            <input type="text" name="login" id="login" onkeypress="return controlSaisie()"><br>
            <label for="mdp">Mot de passe :</label>
            <input type="text" name="mdp" id="mdp"><br>
            <label for="sexe">Sexe :</label>
            <select name="sexe" id="sexe">
                <option value="h">Homme</option>
                <option value="f">Femme</option>
            </select><br>
            <label for="prenom">Prenom :</label>
            <input type="text" name="prenom" id="prenom"><br>
            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom"><br>
            <label for="dateNaissance">Date de naissance :</label>
            <input type="date" name="dateNaissance" id="dateNaissance"><br>
            <label for="adresse">Adresse :</label>
            <input type="text" name="adresse" id="adresse"><br>
            <label for="cp">Code postal :</label>
            <input type="number" name="cp" id="cp"><br>
            <label for="ville">Ville :</label>
            <input type="text" name="ville" id="ville"><br>
            <label for="telFixe">Télephone fixe :</label>
            <input type="phone" name="telFixe" id="telFixe"><br>
            <label for="telPort">Télephone portable :</label>
            <input type="phone" name="telPort" id="telPort"><br>
            <label for="mail">Email: </label>
            <input type="mail" name="mail" id="mail"><br>
            <input type="submit" value="Inscription">
        </form>
    </div>
</div><!-- content2 -->