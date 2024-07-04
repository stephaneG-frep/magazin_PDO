<?php
class Utile{
    public static function h4vert($titre){
        return '<h4 class="bg-warning text-success p-2 mt-2 rounded-lg
        border border-5 border-success">'.$titre.'</h4>';
    }

    public static function h3jaune($titre){
        return '<h3 class="bg-success text-warning p-2 mt-2 rounded-lg
        border border-5 border-warning">'.$titre.'</h3>';
    }

    public static function h2vert($titre){
        return '<h2 class="bg-warning text-success p-2 mt-2 rounded-lg 
        border border-5 border-success">'.$titre.'</h2>';
    }

}

?>