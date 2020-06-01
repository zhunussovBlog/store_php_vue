<?php
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');
header('Access-Control-Allow-Methods: DELETE');
include_once 'settings.php';

$category = new Category($pdo);

if (!empty($data['id'])) {
  $category->id = $data['id'];

  if ($category->delete()) {
    http_response_code(200);

    echo json_encode(['message' => 'Category is deleted']);
  } else {
    http_response_code(503);

    echo json_encode(['message' => 'Unable to delete category']);
  }
} else {
  http_response_code(400);

  echo json_encode(['message' => 'Incomplete data!']);
}
