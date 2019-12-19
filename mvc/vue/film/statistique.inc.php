<!-- ========= V U E =============================================================================================
 fichier				: ./mvc/vue/film/statistique.inc.php
 auteur					: Loris Fariello
 date de création		: decembre 2019
 date de modification	:
 rôle					: permet de générer le code html de la partie centrale de la page statistique du module film
 ================================================================================================================= -->
 <div id='content1'> 


</div><!-- content1 -->

<div id='content2'>

    <div id="contenuPage">
        <div class="menu">
            <ul class="menuFiche">
                <li id="annee" class="itemMenuFiche itemActif" onclick="switchClassStat(event)">nb films / annee</li>
                <li id="genre" class="itemMenuFiche" onclick="switchClassStat(event)">nb films / genre</li>
            </ul>
        </div>

        <div id="annee" class="ongletActif">
            <?php
                for ($i= configuration::get("dateDebut") ; $i <= 2019 ; $i++) { 
                ?>
                <div class="genre">
                    <div class="titreGenre">année <?php echo $i ;?></div>
                    <div class="contentGenre"><?php echo $filmParAnnee[$i]->nb ;?></div>
                </div>
                <?php
                }
            ?>
        </div>
        
        <div id="genre" class="ongletNonActif">
            <span>La cin&eacute;mateque est compos&eacute;es de <?php echo $totalFilm; ?> films r&eacute;partis en <?php echo $nbGenre; ?> genres</span>
            
       

            <?php
                for ($i=0; $i < $nbGenre; $i++) { 
                    echo $collGenre->getUnElement();
                }

            ?>

            
        </div>
    </div>

</div><!-- content2 -->