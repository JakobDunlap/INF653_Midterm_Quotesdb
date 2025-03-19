<?php
  header('Access-Control-Allow-Methods: PUT');
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

  $author->author = $data->author;

  $data = json_decode(file_get_contents("php://input"), true);

  // Update post
  if($author->update()) {
    echo json_encode(
      array('message' => 'Author ' . $data['id'] . ' updated',
            'author' => $data['author'])
    );
  } else {
    echo json_encode(
      array('message' => 'Author not updated')
    );
  }
?>