<?php
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Category.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate category object
  $category = new Category($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to UPDATE
  $category->id = $data->id;

  // Set category to UPDATE
  $category->category = $data->category;

  $data = json_decode(file_get_contents("php://input"), true);

  // Update post
  if($category->update()) {
    echo json_encode(
      array('message' => 'Category ' . $data['id'] . ' updated',
            'category' => $data['category'])
    );
  } else {
    echo json_encode(
      array('message' => 'Category not updated')
    );
  }
?>