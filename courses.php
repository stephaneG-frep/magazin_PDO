<?php
require_once("class/ClassFruit.php");
require_once("class/ClassPanier.php");
include("common/header.php");
?>
<div class="container">
<h3 class="text-center bg-info text-dark p-2 m-4 
border border-5 border-dark">Faite vos courses...</h3>
<h3  class="text-center bg-light text-secondary p-2 m-4 
border border-5 border-dark">Ajout d'un panier</h3>

<?php
    
    echo '<form action"#" method="POST">';
        echo '<div class="row">';
            echo '<div class="col">';
                echo '<label for="client">Nom du client : </label>';
                echo '<input class="form-control" type="text" name="client" id="client" required /><br><br>';
            echo '</div>';
            echo '<div class="col">';
                echo '<label for="nb_pommes">Nombres de pommes : </label>';
                echo '<input class="form-control" type="number" name="nb_pommes" id="nb_pommes" required /><br><br>';
            echo '</div>';
            echo '<div class="col">';
                echo '<label for="nb_cerises">Nombres de cerises : </label>';
                echo '<input class="form-control" type="number" name="nb_cerises" id="nb_cerises" required/><br><br>';
            echo '</div>';
        echo '</div>';
        echo '<input class="btn btn-dark" type="submit" value="Panier de courses" />';
    echo "</form><br><br>";


    if(isset($_POST['client']) && !empty($_POST['client'])){
        $p = new Panier(Panier::generateUniqueId(),$_POST['client']);
        $res = $p->saveInDB();
        if($res){
            $nbPomme = (int)$_POST['nb_pommes'];
            $nbCerise = (int)$_POST['nb_cerises'];
            $cpt = 1;
            $nbFruitInDB = Fruits::generateUniqueID();
            for($i = 0; $i < $nbPomme; $i++){
                $fruit = new Fruits("pomme" .($nbFruitInDB+$cpt),rand(110,200),50);
                $fruit->saveInDB($p->getIdentifiant());
                $p->addFruit($fruit);
                $cpt++;
            }
            for($i = 0; $i < $nbCerise; $i++){
                $fruit = new Fruits("cerise".($nbFruitInDB+$cpt),rand(115,200),50);
                $fruit->saveInDB($p->getIdentifiant());
                $p->addFruit($fruit);
                $cpt++;
            }
            
            echo $p;
            echo "<h1 style='color: red;'>Panier bien ajouté...</h1>";
        } else {
            echo "<h1 slyle='color: red;'>L'ajout n'a pas fonctionné...</h1>";
        }

    }
        /*
        $p = new Panier();
        $nbPomme = (int)$_POST['nb_pommes'];
        $nbCerise = (int)$_POST['nb_cerises'];
        for($i = 0; $i < $nbPomme; $i++){
            $p->addFruit(new Fruits(Fruits::POMME,rand(5,200)));
        }
        for($i = 0; $i < $nbCerise; $i++){
            $p->addFruit(new Fruits(Fruits::CERISE,rand(5,200)));
        }
        $paniers[] = $p;
        */
    



?>
</div>
<?php
include_once("common/footer.php");
?>