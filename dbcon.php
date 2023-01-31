<?php 
require_once __DIR__ . '/vendor/autoload.php';
use Kreait\Firebase\Factory;

  class Firebase
  {
    const SERVICEACCOUNT = 'phpassignment-75537-firebase-adminsdk-wf56r-f771d27684.json';
    const DATABASEURI = 'https://phpassignment-75537-default-rtdb.firebaseio.com/';
    protected $factory;
    protected $database;

    public function __construct() {
      $this->factory = (new Factory)
           ->withServiceAccount(self::SERVICEACCOUNT)
           ->withDatabaseUri(self::DATABASEURI);

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

    public function getData($ref_table = null, $value = null){
      $getReference = $this->database->getReference($ref_table)->getValue($value);
      return $getReference;
    }

    public function childData($ref_table = null, $value = null){
      $setReference = $this->database->getReference($ref_table)->getChild($value)->getValue();
      return $setReference;
  } 
    public function update($ref_table = null,$id = null, $postData = null){
    $result = $this->database->getReference($ref_table)->update($postData)->getKey($id);
    return $result; 
    }
  }

?>
