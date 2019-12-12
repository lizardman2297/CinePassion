<!-- ========= V U E =============================================================================================
 fichier				: ./mvc/vue/film/liste.inc.php
 auteur					: Loris Fariello
 date de création		: octobre 2019
 date de modification	:
 rôle					: permet de générer le code html de la partie centrale de la page liste du module film
 ================================================================================================================= -->
<div id='content1'> 

	<div id="texte">
    	Le tableau ci-dessous présente l'intégralité des films référencés dans notre cinémathèque (<?php echo $nbFilm; ?> films actuellement). 
    	Les films sont triés selon l'ordre alphabétique. En survolant le titre d'un film, le réalisateur correspondant s'affiche dans une 
    	note. En cliquant sur une ligne du tableau, la page présentant les informations détaillées du film sera affichée.
	</div>
	
</div><!-- content1 -->

<div id='content2'>

	<table>
		<tr class='entete'>
			<th>les <?php echo $nbFilm;?> films</th>
			<th>section n°<?php echo $section;?>/<?php echo $nbSections;?></th>
			<th colspan='2'>films n°<?php echo $premierFilm;?> &agrave; <?php echo $dernierFilm;?></th>
		</tr>
		<tr class='descCol'>
			<th>titre</th>
			<th>genre</th>
			<th>ann&eacute;e</th>
			<th>dur&eacute;e</th>
		</tr>
		
		<?php 
	

		while (!$films->estVide()) {
		    $unFilm = $films->getUnElement();
		    echo "<tr>";
		    echo "<td class='titre'>" . "<a href='index.php?module=film&page=fiche&section=$unFilm->numFilm'><abbr title='Un film de $unFilm->prenomRealisateur $unFilm->nomRealisateur'> $unFilm->titreFilm </abbr></a>" . "</td>";
		    echo "<td class='genre'>" . ucfirst($unFilm->genre) . "</td>";
		    echo "<td class='annee'>" . $unFilm->annee . "</td>";
		    echo "<td class='duree'>" . $unFilm->duree . "</td>";
		    echo "</tr>";
		}
		if ($section == $nbSections) {
		    $reste = $section * configuration::get("nbFilmParSection") - $nbFilm;
		    for ($i = 0; $i < $reste; $i++) {
		        echo "<tr>
                      <td class='titre'></td>
                      <td class='genre'></td>
                      <td class='annee'></td>
                      <td class='duree'></td>
                      </tr>";
		    }
		}
		?>
		
	</table>
	
	<div id="nav">
	
		<div id="navBoutons"><?php 
			echo $navigation->getXhtmlBoutons();?>
		</div>
		<div id="navBoutons"><?php 
 			echo $navigation->getXhtmlNumeros();?>
		</div>
	</div>
	
	
		<a href="index.php" class="premier"></a>
		<a href="index.php" class="precedant"></a>
		<a href="index.php" class="suivant"></a>
		<a href="index.php" class="dernier"></a>
<!-- 		<a> <img src="framework/image/btPremInactif.png"/> </a> -->
<!-- 		<a> <img src="framework/image/btPrecInactif.png"/> </a> -->
<!-- 		<a> <img src="framework/image/btSuivInactif.png"/> </a> -->
<!-- 		<a> <img src="framework/image/btDerInactif.png"/> </a> -->
<!-- 	</div> -->
	
</div><!-- content2 -->