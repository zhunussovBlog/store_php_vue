<?php
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');
header('Access-Control-Allow-Methods: PUT');
include_once 'settings.php';

$category = new Category($pdo);

if (!empty($data['id']) && !empty($data['name'])) {
  $category->id = $data['id'];
  $category->name = $data['name'];
  $category->description = $data['description'] ?? null;
  $category->parent_id = $data['parent_id'] ?? null;

  if ($category->update()) {
    http_response_code(200);

    echo json_encode(['message' => 'Category is updated']);
  } else {
    http_response_code(503);

    echo json_encode(['message' => 'Unable to update category'], JSON_UNESCAPED_UNICODE);
  }
} else {
  http_response_code(400);

  echo json_encode(['message' => 'Incomplete data!'], JSON_UNESCAPED_UNICODE);
}
