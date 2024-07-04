<?php
require_once("class/ClassFruitsManager.php");

class Fruits{
    private $nom;
    private $poids;
    private $prix;

    public static $fruits = [];


    public function __construct($nom,$poids,$prix){
        $this->nom = $nom;
        $this->poids = $poids;
        $this->prix = $prix;
    }

    public function getNom(){
        return $this->nom;
    }
    public function getPoids(){
        return $this->poids;
    }
    public function getPrix(){
        return $this->prix;
    }

    public function __toString(){
        $affichage = $this->getAffichageIMG();
        $affichage .= "Nom : " . $this->nom . "<br>";
        $affichage .= "Poids : " . $this->poids . "<br>";
        $affichage .= "prix : " . $this->prix . "<br>";
        return $affichage;
    }

    public function afficherListeFruit(){
        $affichage = '<div class="card text-center bg-info text-danger border border-primary">';
        $affichage .= $this->getAffichageIMG();
        $affichage .= '<div class="card-body bg-light border border-dark">';
            $affichage .= '<h5 class="card-title">Nom : ' . $this->nom . '</h5>';
            $affichage .= '<p class="card-text">Poids : ' . $this->poids . '<br>';
            $affichage .= 'Prix : ' . $this->prix . "<br>";
            $affichage .= 'panier : ';
            $paniers = PanierManager::getPaniers();
            $panierDuFruit = FruitManager::getPanierFromFruit($this->nom);
            $affichage .= '<form action="#" method="POST">';
            $affichage .= '<input type="hidden" name="idFruit" id="idFruit" value="'.$this->nom.'" />';          
            $affichage .= '<select name="idPanier" id="idPanier" class="form-control form-control-sm" onChange="submit()">';
            $affichage .= '<option value=""></option>';
                foreach($paniers as $panier){
                    if($panierDuFruit === $panier['identifiant']){
                        $affichage .= '<option value="'.$panier['identifiant'].'" selected>'.$panier['NomClient'].'</option>';
                    } else {
                        $affichage .= '<option value="'.$panier['identifiant'].'">'.$panier['NomClient'].'</option>';
                    }
                }
            $affichage .= '</select>';
            $affichage .= '</form>';
            $affichage .= "</p>";
        $affichage .='</div>';
    $affichage .='</div>';
        return $affichage;
    }

    public function saveInDB($idPanier){
        return FruitManager::inserIntoDB($this->nom, $this->poids, $this->prix, $idPanier);
    }

    private function getAffichageIMG(){
        if(preg_match("/cerise/i",$this->nom)){
            return "<img class=\"card-img-top mx-auto\" style='width: 200px; height: 180px;' src='common/cherry.png' alt='cerise' /><br>";
        }
        if(preg_match("/pomme/i",$this->nom)){
            return "<img class=\"card-img-top mx-auto\" style='width: 200px; height: 180px' src='common/apple.png' alt='pomme' /><br>";
        }
    }

    public function getImageSmall(){
        if(preg_match("/cerise/i",$this->nom)){
            return "<img class=\"card-img-top mx-auto\" style='width: 50px; height: 40px;' src='common/cherry.png' alt='cerise' /><br>";
        }
        if(preg_match("/pomme/i",$this->nom)){
            return "<img class=\"card-img-top mx-auto\" style='width: 50px; height: 40px' src='common/apple.png' alt='pomme' /><br>";
        }
    }

    public static function generateUniqueID(){
        return FruitManager::getNbFruitsInDB() + 1;
    }

}

?>