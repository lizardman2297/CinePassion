<!-- ========= V U E =============================================================================================
 fichier				: ./mvc/vue/film/fiche.inc.php
 auteur					: Loris Fariello
 date de création		: novembre 2019
 date de modification	:
 rôle					: permet de générer le code html de la partie centrale de la page fiche du module film
 ================================================================================================================= -->
 <div id='content1'> 


</div><!-- content1 -->

<div id='content2'>
	<div id="contenuPage">
		<div class="menu">
    		<ul class="menuFiche">
    			<li class="itemMenuFiche itemActif" onclick="switchClass(event)">Information</li>
    			<li class="itemMenuFiche" onclick="switchClass(event)">Histoire</li>
    			<li class="itemMenuFiche" onclick="switchClass(event)">Acteur</li>
    			<li class="itemMenuFiche" onclick="switchClass(event)">Notation</li>
    			<li class="itemMenuFiche" onclick="switchClass(event)">Commentaire</li>
    		</ul>
		</div>
		<div id="partieFilm">
		
    		<div id="galerie">
        		<?php echo $galerieImageFilm;?>
        	</div>
        	<div id="information" class="ongletActif">
        		<?php echo $leFilm->titreFilm?> est le <?php echo $positionFilm?> dans notre cinémathèque <?php echo $nationaliteReal?>
        		 <?php echo $leFilm->prenomRealisateur . " " . $leFilm->nomRealisateur ;?>. C'est <?php echo $typeFilm;?>
        		d'une durée de <?php echo $dureeHeures;?> heure et <?php echo $leFilm->dureeMinutes;?> minutes qui est sorti dans les salles de cinema 
        		en France le <?php echo $dateSortieFilm;?>.
        	</div>
        	
        	<div id="histoire" class="ongletNonActif">
				histoire
        	</div>
        	
        	<div id="acteur" class="ongletNonActif">
				acteur
        	</div>
        	
        	<div id="notation" class="ongletNonActif">
				notation
        	</div>
        	
        	<div id="commentaire" class="ongletNonActif">
				commentaire
        	</div>
		
		</div>
		
		
	</div>
	
	
</div><!-- content2 -->