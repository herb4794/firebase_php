<?php 
require_once __DIR__ . '/vendor/autoload.php';
use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth;



  class Firebase
  {
    const SERVICEACCOUNT = 'phpassignment-75537-firebase-adminsdk-wf56r-f771d27684.json';
    const DATABASEURI = 'https://phpassignment-75537-default-rtdb.firebaseio.com/';
    protected $factory;
    protected $database;
    public $auth;

    public function __construct() {
      $this->factory = (new Factory)
           ->withServiceAccount(self::SERVICEACCOUNT)
           ->withDatabaseUri(self::DATABASEURI);
      $this->auth = $this->factory->createAuth();
      $this->database = $this->factory->createDatabase();

    }

    public function insertData($ref_table = null,$postData = null){

      $postRef_result = $this->database->getReference($ref_table)->push($postData);

        if ($postRef_result) {
        $_SESSION['status'] = "Contact Added Successufliy";
        header('Location: index.php');
      }else{
        $_SESSION['status'] = "Contact Not Added";
        header('Location: index.php');
  }
    }
    
    public function countData($ref_table = null){
      $count_result = $this->database->getReference($ref_table);
      return $count_result;
    } 

    public function getData($ref_table = null){
      $getReference = $this->database->getReference($ref_table)->getValue();
      return $getReference;
    }

    public function childData($ref_table = null, $value = null){
      $setReference = $this->database->getReference($ref_table)->getChild($value)->getValue();
      return $setReference;
  } 
    public function update($ref_table = null, $postData = null){
      $result = $this->database->getReference($ref_table)->update($postData);
      return $result; 
  }
    public function delete(string $ref_table = null ) {
      $result = $this->database->getReference($ref_table)->remove();
      return $result;
    }
    public function authentication($postData) {
      $result = $this->auth->createUser($postData);
      return $result;
    }
}

?>
