<?php
    
    function DBconnect(){
		try
		{
			return $bdd = new PDO('mysql:host=localhost;dbname=testsw;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));    
		}
		catch (Exeption $e)
		{
			die('Erreur :' . $e->getMessage());
		}
    }
?>