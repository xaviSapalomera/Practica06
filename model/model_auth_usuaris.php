<?php
require_once 'env.php';

//Per crear un usuari
function crearUsuariAuth($nickname,$email,$token){

	try{
        $connexio = new PDO('mysql:host=' . SERVER . ';dbname=' . DATABASE, USER_DB, PASS_DB);

		$inserta_Usuaris = $connexio->prepare('INSERT INTO usuaris_auth(nickname,email,token) VALUES (?,?,?)');

		$inserta_Usuaris->execute([$nickname,$email,$token]);

	}catch(PDOException $e){
		echo "Error: ". $e->getMessage();
	}

}
?>