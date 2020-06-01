<?php
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');
header('Access-Control-Allow-Methods: PUT');
include_once 'settings.php';

$brand = new Brand($pdo);

if (!empty($data['id']) && !empty($data['name'])) {
  $brand->id = $data['id'];
  $brand->name = $data['name'];

  if ($brand->update()) {
    http_response_code(200);

    echo json_encode(['message' => 'Brand is updated']);
  } else {
    http_response_code(503);

    echo json_encode(['message' => 'Unable to update brand'], JSON_UNESCAPED_UNICODE);
  }
} else {
  http_response_code(400);

  echo json_encode(['message' => 'Incomplete data!'], JSON_UNESCAPED_UNICODE);
}
