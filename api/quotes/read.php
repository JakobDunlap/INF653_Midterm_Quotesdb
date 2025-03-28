<?php 
  include_once '../../config/Database.php';
  include_once '../../models/Quote.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate quote object
  $quote = new Quote($db);

  // Blog quote query
  $result = $quote->read();
  // Get row count
  $num = $result->rowCount();

  // Check if any quotes
  if($num > 0) {
    // quotes array
    $quotes_arr = array();
    // $quotes_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $quote_item = array(
        'id' => $id,
        'quote' => $quote,
        //'body' => html_entity_decode($body),
        'author' => $author,
        'category' => $category
      );

      // Push to "data"
      array_push($quotes_arr, $quote_item);
      // array_push($quotes_arr['data'], $quote_item);
    }

    // Turn to JSON & output
    echo json_encode($quotes_arr);

  } else {
    // No Quotes
    echo json_encode(
      array('message' => 'No Quotes Found')
    );
  }
?>