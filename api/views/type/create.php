<?php
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');
header('Access-Control-Allow-Methods: POST');
include_once 'settings.php';

$type = new Type($pdo);

if (!empty($data['name'])) {
  $type->name = $data['name'];

  if ($type->create()) {
    http_response_code(201);

    echo json_encode(['message' => 'Type is created']);
  } else {
    http_response_code(503);

    echo json_encode(['message' => 'Unable to create type'], JSON_UNESCAPED_UNICODE);
  }
} else {
  http_response_code(400);

  echo json_encode(['message' => 'Incomplete data!'], JSON_UNESCAPED_UNICODE);
}
