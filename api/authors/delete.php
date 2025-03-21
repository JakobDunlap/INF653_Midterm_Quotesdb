<?php
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Author.php';
  

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate author object
  $author = new Author($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to UPDATE
  $author->id = $data->id;

  $data = json_decode(file_get_contents("php://input"), true);

  // Delete author
  if($author->delete()) {
    echo json_encode(
      array('id' => $data['id'])
    );
  } else {
    echo json_encode(
      array('message' => 'Author not deleted')
    );
  }
?>