<?php
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');
header('Access-Control-Allow-Methods: PUT');
include_once 'settings.php';

$type = new Type($pdo);

if (!empty($data['id']) && !empty($data['name'])) {
  $type->id = $data['id'];
  $type->name = $data['name'];

  if ($type->update()) {
    http_response_code(200);

    echo json_encode(['message' => 'Type is updated']);
  } else {
    http_response_code(503);

    echo json_encode(['message' => 'Unable to update type'], JSON_UNESCAPED_UNICODE);
  }
} else {
  http_response_code(400);

  echo json_encode(['message' => 'Incomplete data!'], JSON_UNESCAPED_UNICODE);
}
