<?php
header('Access-Control-Allow-Headers: access');
header('Access-Control-Allow-Methods: GET');
include_once 'settings.php';

$category = new Category($pdo);

if (!empty($_GET['id'])) {
  $category->id = $_GET['id'];

  $row = $category->readOne();

  if ($row->rowCount() > 0) {
    http_response_code(200);

    echo json_encode(['rows' => $row->fetch()]);
  } else {
    http_response_code(404);

    echo json_encode(['message' => 'Category is not found'], JSON_UNESCAPED_UNICODE);
  }

} else {
  http_response_code(400);

  echo json_encode(['message' => 'Incomplete data!'], JSON_UNESCAPED_UNICODE);
}
