<?php
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');
header('Access-Control-Allow-Methods: POST');
include_once 'settings.php';

$data = json_decode(file_get_contents('php://input'), true);

$category = new Category($pdo);

if (!empty($data['name'])) {
  $category->name = $data['name'];
  $category->description = $data['description'] ?? null;
  $category->parent_id = $data['parent_id'] ?? null;

  if ($category->create()) {
    http_response_code(201);

    echo json_encode(['message' => 'Category is created']);
  } else {
    http_response_code(503);

    echo json_encode(['message' => 'Unable to create category']);
  }
} else {
  http_response_code(400);

  echo json_encode(['message' => 'Incomplete data!']);
}
