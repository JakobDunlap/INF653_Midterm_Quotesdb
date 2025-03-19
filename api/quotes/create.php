<?php 
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Quote.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate quote object
  $quote = new Quote($db);

  // Decode data as an array to check for missing params
  $data = json_decode(file_get_contents("php://input"), true);

  // If parameters are missing...
  if (!isset($data['quote'], $data['author_id'], $data['category_id'])) {
    echo json_encode(['message' => 'Missing Required Parameters']);
    exit;
  }

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $quote->quote = $data->quote;
  $quote->author_id = $data->author_id;
  $quote->category_id = $data->category_id;

  // Create post
  if($quote->create()) {
    // Intentionally blank
  } else {
    echo json_encode(
      array('message' => 'Quote Not Created')
    );
  }
?>