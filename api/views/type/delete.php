<?php
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');
header('Access-Control-Allow-Methods: DELETE');
include_once 'settings.php';

$type = new Type($pdo);

if (!empty($data['id'])) {
  $type->id = $data['id'];

  if ($type->delete()) {
    http_response_code(200);

    echo json_encode(['message' => 'Type is deleted']);
  } else {
    http_response_code(503);

    echo json_encode(['message' => 'Unable to delete type']);
  }
} else {
  http_response_code(400);

  echo json_encode(['message' => 'Incomplete data!']);
}
