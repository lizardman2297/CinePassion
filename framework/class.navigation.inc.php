<?php 
/*================================================================================================================
	fichier				: class.navigation.inc.php
	auteur				: Loris Fariello
	date de création	: novembre 2019
	
	role				: decrit la classe permet les navigation des films
  ================================================================================================================*/

/**
 * classe permetant les navigation des films
 * @author Loris Fariello 
 * @version 1.0
 * @copyright Loris Fariello - novembre 2019
 *
 */
    class navigation {
 
        private $module;
        private $page;
        private $action;
        private $section;
        private $nbSection;
        private $nav;
        private $nbNumNav;
        
        public function __construct($module, $page, $action, $section, $nbSection, $nav, $nbNumNav){
            $this->setModule($module);
            $this->setPage($page);
            $this->setAction($action);
            $this->setSection($section);
            $this->setNbSection($nbSection);
            $this->setNav($nav);
            $this->setNumNav($nbNumNav);
        }
        
        private function setModule($module){
            $this->module = $module;
        }
        private function setPage($page){
            $this->page = $page;
        }
        private function setAction($action){
            $this->action = $action;
        }
        private function setSection($section){
            $this->section = $section;
        }
        private function setNbSection($nbSection){
            $this->nbSection = $nbSection;
        }
        private function setNav($nav){
            $this->nav = $nav;
        }
        private function getModule() {
            return $this->module;
        }
        private function getPage() {
            return $this->page;
        }
        private function getAction() {
            return $this->action;
        }
        private function getSection() {
            return $this->section;
        }
        private function getNbSection() {
            return $this->nbSection;
        }
        private function getNav() {
            return $this->nav;
        }
        private  function getNumNav(){
            return $this->nbNumNav;
        }
        private function setNumNav($nbNumNav) {
            $this->nbNumNav = $nbNumNav;
        }
//         private function getURL($section) {
//             return "<a href='index.php?module=" . $this->getModule() . "&page=" . $this->getPage() . "&action=" . $this->getAction() . "&section=" . $this->getNav()->sectionSuivante . "'><img src='./framework/image/btSuivActif.png' alt='' id='btSuiv'> $section</a>";
//         }
        
        
        
        public function getXhtmlBoutons() {
            if ($this->getSection() == 1) {
                return "<img src='./framework/image/btPremInactif.png' alt=''>
                        <img src='./framework/image/btPrecInactif.png' alt=''>
                        <a href='index.php?module=" . $this->getModule() . "&page=" . $this->getPage() . "&action=" . $this->getAction() . "&section=" . $this->getNav()->sectionSuivante . "'><img src='./framework/image/btSuivActif.png' alt='' id='btSuiv' onmouseover = \"window.document.getElementById('btSuiv').src = './framework/image/btSuivSurvol.png'\" onmouseout = \"window.document.getElementById('btSuiv').src = './framework/image/btSuivActif.png'\"></a>
                        <a href='index.php?module=" . $this->getModule() . "&page=" . $this->getPage() . "&action=" . $this->getAction() . "&section=" . $this->getNav()->sectionDerniere . "'><img src='./framework/image/btDerActif.png' alt='' id='btDer' onmouseover = \"window.document.getElementById('btDer').src = './framework/image/btDerSurvol.png'\" onmouseout = \"window.document.getElementById('btDer').src = './framework/image/btDerActif.png'\" ></a>";
            }elseif ($this->getSection() == $this->getNbSection()) {
                return "<a href='index.php?module=" . $this->getModule() . "&page=" . $this->getPage() . "&action=" . $this->getAction() . "&section=" . $this->getNav()->sectionPremiere . "'><img src='./framework/image/btPremActif.png' alt='' id='btPrem' onmouseover = \"window.document.getElementById('btPrem').src = './framework/image/btPremSurvol.png'\" onmouseout = \"window.document.getElementById('btPrem').src = './framework/image/btPremActif.png'\"></a>
                        <a href='index.php?module=" . $this->getModule() . "&page=" . $this->getPage() . "&action=" . $this->getAction() . "&section=" . $this->getNav()->sectionPrecedente . "'><img src='./framework/image/btPrecActif.png' alt='' id='btPrec' onmouseover = \"window.document.getElementById('btPrec').src = './framework/image/btPrecSurvol.png'\" onmouseout = \"window.document.getElementById('btPrec').src = './framework/image/btPrecActif.png'\"></a>
                        <img src='./framework/image/btSuivInactif.png' alt=''>
                        <img src='./framework/image/btDerInactif.png' alt=''>";
            }else {
                return "<a href='index.php?module=" . $this->getModule() . "&page=" . $this->getPage() . "&action=" . $this->getAction() . "&section=" . $this->getNav()->sectionPremiere . "'><img src='./framework/image/btPremActif.png' alt='' id='btPrem' onmouseover = \"window.document.getElementById('btPrem').src = './framework/image/btPremSurvol.png'\" onmouseout = \"window.document.getElementById('btPrem').src = './framework/image/btPremActif.png'\"></a>
                        <a href='index.php?module=" . $this->getModule() . "&page=" . $this->getPage() . "&action=" . $this->getAction() . "&section=" . $this->getNav()->sectionPrecedente . "'><img src='./framework/image/btPrecActif.png' alt='' id='btPrec' onmouseover = \"window.document.getElementById('btPrec').src = './framework/image/btPrecSurvol.png'\" onmouseout = \"window.document.getElementById('btPrec').src = './framework/image/btPrecActif.png'\"></a>
                        <a href='index.php?module=" . $this->getModule() . "&page=" . $this->getPage() . "&action=" . $this->getAction() . "&section=" . $this->getNav()->sectionSuivante . "'><img src='./framework/image/btSuivActif.png' alt='' id='btSuiv' onmouseover = \"window.document.getElementById('btSuiv').src = './framework/image/btSuivSurvol.png'\" onmouseout = \"window.document.getElementById('btSuiv').src = './framework/image/btSuivActif.png'\"></a>
                        <a href='index.php?module=" . $this->getModule() . "&page=" . $this->getPage() . "&action=" . $this->getAction() . "&section=" . $this->getNav()->sectionDerniere . "'><img src='./framework/image/btDerActif.png' alt='' id='btDer' onmouseover = \"window.document.getElementById('btDer').src = './framework/image/btDerSurvol.png'\" onmouseout = \"window.document.getElementById('btDer').src = './framework/image/btDerActif.png'\" ></a>";
            }
        } // function
        
        
        
        /**
         * 
         * @return string
         * @copyright loris
         */
        public function getXhtmlNumeros() {
            $num = "";
            for ($i = 1; $i <= $this->nbSection; $i++) {
                if ($i == $this->section){ 
                    $num .= "<span class='sectionCourante'>$i</span>";
                } elseif ($i == 1 || $i == $this->nbSection){
                    $num .= $this->getLien($i);
                } elseif ($i >= $this->section - $this->getNumNav() && $i < $this->section){
                    $num .= $this->getLien($i);
                //
                // gestion x num avant || apres
                //
                } elseif ($i > $this->section && $i <= $this->section + $this->getNumNav()){
                    $num .= $this->getLien($i);
                //
                // gestion points avant || apres
                //
                } elseif ($i == $this->section - $this->getNumNav() - 1 || $i == $this->section + $this->getNumNav() + 1){
                    $num .= " ... ";
                }
            }
            return $num;
        }
        
        
        private function getLien($numSection){
            return "<a href='index.php?module=" . $this->getModule() . "&page=" . $this->getPage() . "&action=" . $this->getAction() . "&section=" . $numSection . "'> $numSection </a>";
        }
    } // class

?>