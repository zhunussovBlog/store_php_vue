<?php
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');
header('Access-Control-Allow-Methods: POST');
include_once 'settings.php';

$brand = new Brand($pdo);

if (!empty($data['name'])) {
  $brand->name = $data['name'];

  if ($brand->create()) {
    http_response_code(201);

    echo json_encode(['message' => 'Brand is created']);
  } else {
    http_response_code(503);

    echo json_encode(['message' => 'Unable to create brand'], JSON_UNESCAPED_UNICODE);
  }
} else {
  http_response_code(400);

  echo json_encode(['message' => 'Incomplete data!'], JSON_UNESCAPED_UNICODE);
}
