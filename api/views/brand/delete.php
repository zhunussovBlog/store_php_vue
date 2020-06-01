<?php
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');
header('Access-Control-Allow-Methods: DELETE');
include_once 'settings.php';

$brand = new Brand($pdo);

if (!empty($data['id'])) {
  $brand->id = $data['id'];

  if ($brand->delete()) {
    http_response_code(200);

    echo json_encode(['message' => 'Brand is deleted']);
  } else {
    http_response_code(503);

    echo json_encode(['message' => 'Unable to delete brand']);
  }
} else {
  http_response_code(400);

  echo json_encode(['message' => 'Incomplete data!']);
}
