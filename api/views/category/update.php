<?php
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');
header('Access-Control-Allow-Methods: PUT');
include_once 'settings.php';

$data = json_decode(file_get_contents('php://input'), true);

$category = new Category($pdo);

if (!empty($data['id']) && !empty($data['name']) && !empty($data['created_at'])) {
  $category->id = $data['id'];
  $category->name = $data['name'];
  $category->description = $data['description'] ?? null;
  $category->parent_id = $data['parent_id'] ?? null;
  $category->created_at = $data['created_at'];

  if ($category->update()) {
    http_response_code(200);

    echo json_encode(['message' => 'Category is updated']);
  } else {
    http_response_code(503);

    echo json_encode(['message' => 'Unable to update category']);
  }
} else {
  http_response_code(400);

  echo json_encode(['message' => 'Incomplete data!']);
}
