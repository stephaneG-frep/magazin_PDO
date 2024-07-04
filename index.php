<?php  
include("common/header.php");
?>



<div class="container ">
    <h1 class="text-center bg-danger text-white p-4 mt-4 border border-5 border-dark">Mini site de courses en PHP_POO & PDO ..</h1>
    <div class="row">
    <div class="col">
        <h2 class="text-center bg-warning text-success p-2 m-2 border border-5 border-success">Gestion des paniers...</h2>
        <div class="mx-auto" style="width:150px">
            <a class="btn btn-outline-dark mt-4" href="afficherPaniers.php" role="button">Gérer les paniers</a>
        </div>
    </div>
    <div class="col">
        <h2 class="text-center bg-success text-warning p-2 m-2 border border-5 border-warning">Gestion des fruits...</h2>
        <div class="mx-auto" style="width:150px">
            <a class="btn btn-outline-light mt-4" href="afficherFruits.php" role="button">Gérer les fruits</a>
        </div>
    </div>
</div>
</div>



<?php
include("common/footer.php");
?>


