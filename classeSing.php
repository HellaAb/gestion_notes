<?php
class Database {
  private static $instance = null;
  private $connexion;

  private $conBD = "mysql:host=localhost;dbname=gesnotes;port=3306";//.// REVOIR
  private $username = "root";
  private $password = "";

  // Constructeur privé pour empêcher l'instanciation directe de la classe.
  private function __construct() {
    $this->connexion = new PDO($this->conBD, $this->username, $this->password);

    if ($this->connexion==NULL) 
    die('Connexion échouée : '  . $this->connexion->errorInfo());
  }

  // Méthode statique pour récupérer l'instance unique de la classe.
  public static function getInstance() {
    if (self::$instance == null) {
      self::$instance = new Database();
    }

    return self::$instance;
  }

  // Méthode pour exécuter des requêtes SQL sur la base de données.
  public function query($sql) {
    return $this->connexion->query($sql);
  }
  public function prepare($sql) {
    return $this->connexion->prepare($sql);
  }
  // Méthode pour échapper les caractères spéciaux dans une chaîne de caractères.
  // public function escapeString($string) {
  //   return $this->connexion->real_escape_string($string);
  // }

  // Empêcher la création de copies de l'objet (clone).
  private function __clone() {}
  // Fermer la connexion à la base de données lors de la destruction de l'objet.
  public function __destruct() {
    //$this->connexion->close();
  }
}
?>