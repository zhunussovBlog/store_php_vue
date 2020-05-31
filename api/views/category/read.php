<?php
header('Access-Control-Allow-Headers: access');
header('Access-Control-Allow-Methods: GET');
include_once 'settings.php';

$category = new Category($pdo);

$data = $category->read();

if ($data->rowCount() > 0) {
  $categories = ['rows' => $data->fetchAll()];

  http_response_code(200);

  echo json_encode($categories);
} else {
  http_response_code(404);

  echo json_encode(['message' => 'Categories table is empty'], JSON_UNESCAPED_UNICODE);
}
