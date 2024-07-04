<?php

class MonPDO{
    private const HOST_NAME = "localhost";
    private const DB_NAME = "db_panierfruit";
    private const USER_NAME = "root";
    private const PWD = "";
    
    private static $monPDOinstance = null;

    public static function getPDO(){
        if(is_null(self::$monPDOinstance)){
            try{
                $connexion = 'mysql:host='.self::HOST_NAME.';dbname='.self::DB_NAME;
                self::$monPDOinstance = new PDO($connexion,self::USER_NAME,self::PWD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                } catch(PDOException $e){
                    $message = "Erreur de connexion à la BDD ...". $e->getMessage();
                    die($message);
                }
                self::$monPDOinstance->exec("SET CHARACTER SET UTF8");
        }
        return self::$monPDOinstance;
    }
}



?>