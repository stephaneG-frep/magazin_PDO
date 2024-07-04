<?php
require_once("class/ClassFormatage.php");
require_once("class/ClassPaniersManager.php");
class Panier{
    public static $paniers = [];
    
    private $identifiant;
    private $nomClient;
    private $pommes = [];
    private $cerises = [];

    public function __construct($identifiant, $nomClient){
        $this->identifiant = $identifiant;
        $this->nomClient = $nomClient;
    }

    public function getIdentifiant(){
        return $this->identifiant;
    }
    
    public function setFruitToPanierFromDB(){
        $fruits = PanierManager::getFruitPanier($this->identifiant);

    foreach($fruits as $fruit){
        if(preg_match("/cerise/",$fruit['fruit'])){
            $this->cerises[] = new Fruits($fruit['fruit'],$fruit['poids'],$fruit['prix']);
        }elseif(preg_match("/pomme/",$fruit['fruit'])){
            $this->pommes[] = new Fruits($fruit['fruit'],$fruit['poids'],$fruit['prix']);
        }
    }
}

    public function __toString(){
        $affichage = Utile::h4vert('Contenu du panier' . $this->identifiant . " : ");
        $affichage .= '<table class="table">';
            $affichage .= '<thead>';
            $affichage .= '<tr>';
                $affichage .='<th scope="col">Image</th>';
                $affichage .= '<th scope="col">Nom</th>';
                $affichage .= '<th scope="col">Poids</th>';
                $affichage .= '<th scope="col">Prix</th>';
                $affichage .= '<th scope="col">Modifier</th>';
                $affichage .= '<th scope="col">Supprimer</th>';
            $affichage .= '</tr>';
            $affichage .= '</thead>';
            $affichage .= '<tbody>';
            

        foreach($this->pommes as $pomme){
            $affichage .=$this->affichagePersonnaliseFruit($pomme);
        }
        foreach($this->cerises as $cerise){
            $affichage .=$this->affichagePersonnaliseFruit($cerise);
        }   
        $affichage .= '</tbody>';
        $affichage .= '</table>';
        return $affichage;
    }

    private function affichagePersonnaliseFruit($fruit){
        $affichage = '<tr>';
                $affichage .= '<td>'.$fruit->getImageSmall().'</td>';
                $affichage .= '<td>'.$fruit->getNom().'</td>';

                $affichage .= '<td>';
                if(isset($_GET['idFruit']) && $_GET['idFruit'] === $fruit->getNom()){
                    $affichage .= '<form  action="#" method="POST">';
                        $affichage .= '<input type="hidden" name="type" id="type" value="modification" />';
                        $affichage .= '<input type="hidden" name="idFruit" id="idFruit" value="'.$fruit->getNom().'" />';
                        $affichage .= '<input type="number" name="poidsFruit" id="poidsFruit" value="'.$fruit->getPoids().'" />';
                }else{
                    $affichage .= $fruit->getPoids();
                }              
                $affichage .= '</td>';

                $affichage .= '<td>';
                if(isset($_GET['idFruit']) && $_GET['idFruit'] === $fruit->getNom()){
                        $affichage .= '<input type="number" name="prixFruit" id="prixFruit" value="'.$fruit->getPrix().'" />';
                }else{
                    $affichage .= $fruit->getPrix();
                }              
                $affichage .= '</td>';

                $affichage .= '<td>';
                if(isset($_GET['idFruit']) && $_GET['idFruit'] === $fruit->getNom()){
                        $affichage .= '<input class="btn btn-success" type="submit" value="Valider" />';
                    $affichage .= '</form>';
                }else{
                    $affichage .= '<form action="#" method="GET">';
                        $affichage .= '<input type="hidden" name="idFruit" id="idFruit" value="'.$fruit->getNom().'" />';
                        $affichage .= '<input class="btn btn-primary" type="submit" value="Modifier" />';
                    $affichage .= '</form>';
                }
                $affichage .= '</td>';


                $affichage .= '<td>';
                    $affichage .= '<form action="#" method="POST">';
                        $affichage .= '<input type="hidden" name="idFruit" id="idFruit" value="'.$fruit->getNom().'" />';
                        $affichage .= '<input type="hidden" name="type" id="type" value="supprimer" />';
                        $affichage .= '<input class="btn btn-danger" type="submit" value="Supprimer" />';
                    $affichage .= '</form>';
                $affichage .= '</td>';
        $affichage .= '</tr>';
            return $affichage;
    }

    public function addFruit($fruit){
        if(preg_match("/cerise/",$fruit->getNom())){
            $this->cerises[] = $fruit;
        }
        elseif(preg_match("/pomme/",$fruit->getNom())){
            $this->pommes[] = $fruit;
        }
    }

    public function saveInDB(){
        return PanierManager::insertIntoDB($this->identifiant, $this->nomClient);
    }

    public static function generateUniqueId(){
        return PanierManager::getNbPanierInDB() + 1;
    }


}
?>