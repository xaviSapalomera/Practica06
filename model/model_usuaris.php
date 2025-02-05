<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

class Usuari {
    private $connexio;

    public function __construct() {
        
        $dotenv = Dotenv::createImmutable(__DIR__);
        $dotenv->load();

        
        try {
            $this->connexio = new PDO(
                'mysql:host=' . $_ENV['SERVER'] . ';dbname=' . $_ENV['DATABASE'],
                $_ENV['USER_DB'],
                $_ENV['PASS_DB'],
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]
            );
        } catch (PDOException $e) {
            die("Error al conectar a la base de datos: " . $e->getMessage());
        }
    }
//Crear Usuaris
    public function crearUsuari($dni, $nom, $cognom, $email, $contrasenya) {
        try {
            $stmt = $this->connexio->prepare('INSERT INTO usuaris (dni, nom, cognom, email, contrasenya) VALUES (?, ?, ?, ?, ?)');
            $stmt->execute([$dni, $nom, $cognom, $email, password_hash($contrasenya, PASSWORD_BCRYPT)]);
            return $this->connexio->lastInsertId();
        } catch (PDOException $e) {
            error_log("Error al crear usuario: " . $e->getMessage());
            return false;
        }
    }
// Mostrar tots els usuaris
    public function mostrarUsuaris() {
        try {   
            $stmt = $this->connexio->query('SELECT id, nom, nickname, cognom, dni, email, contrasenya, admin FROM usuaris');
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("Error al mostrar usuarios: " . $e->getMessage());
            return [];
        }
    }

    public function perfilDades($email) {
        try {
            $stmt = $this->connexio->prepare('SELECT id, nickname, nom, cognom, dni, email, contrasenya FROM usuaris WHERE email = ? LIMIT 1');
            $stmt->execute([$email]);
            return $stmt->fetch(); // Retorna solo un registro
        } catch (PDOException $e) {
            error_log("Error al obtenir perfil per a l'email $email: " . $e->getMessage());
            return null;
        }
    }
// Actualitzar password del usuari
    public function actualitzarPassword($id, $password) {
        try {
            $password_hash = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $this->connexio->prepare('UPDATE usuaris SET contrasenya = ? WHERE id = ?');
            $stmt->execute([$password_hash, $id]);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            error_log("Error al actualitzar contrasenya: " . $e->getMessage());
            return false;
        }
    }
//Actualitzar el nickname del usuari
    public function actualitzarNickname($id, $nickname) {
        try {
            $stmt = $this->connexio->prepare('UPDATE usuaris SET nickname = ? WHERE id = ?');
            $stmt->execute([$nickname, $id]);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            error_log("Error al actualitzar nickname: " . $e->getMessage());
            return false;
        }
    }
    //Actualitzar el Email del usuari
    public function actualitzarEmail($id, $correu) {
        try {
            $stmt = $this->connexio->prepare('UPDATE usuaris SET correu = ? WHERE id = ?');
            $stmt->execute([$correu, $id]);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            error_log("Error al actualitzar nickname: " . $e->getMessage());
            return false;
        }
    }
//Filtrar usuaris per ID
    public function filtrarUsuarisPerID($id) {
        try {
            $stmt = $this->connexio->prepare('SELECT id, nickname, nom, cognom, dni, email, contrasenya FROM usuaris WHERE id = ? LIMIT 1');
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC); // Retorna el resultado como un array asociativo
        } catch (PDOException $e) {
            error_log("Error al filtrar usuarios por ID: " . $e->getMessage());
            return null; // Retorna null si ocurre un error
        }
    }
    
}

?>
