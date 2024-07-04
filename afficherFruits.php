<?php 
require_once("class/ClassFormatage.php");
require_once("class/ClassFruit.php");
require_once("class/ClassPanier.php");
require_once("class/ClassmonPDO.php");
require_once("class/ClassFruitsManager.php");
include("common/header.php");
?>
<div class="container">
<?php echo Utile::h3jaune("Les fruits : ")  ?>

<?php 

    if(isset($_POST['idPanier'])){
        $idFruit = $_POST['idFruit'];
        $idPanier = (int) $_POST['idPanier'];
        $res = FruitManager::updatePanierForFruitDB($idFruit,$idPanier);
        if($res){
            echo '<div class="alert alert-success mt-2" role="alert">Modifié avec succès...</div>';
        } else {
            echo ' <div class="alert alert-danger mt-2" role="alert">La modification à ratée...</div>';
        }
    }


    FruitManager::setFruitsFromDB();
    echo '<div class="row mx-auto">';
    foreach(Fruits::$fruits as $fruit){
        echo '<div class="col-sm p-2">';
            echo $fruit->afficherListeFruit();
        echo '</div>';
    }
    echo '</div>';
?>

</div>
<?php
include_once("common/footer.php");
?>