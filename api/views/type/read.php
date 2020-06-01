<?php
header('Access-Control-Allow-Headers: access');
header('Access-Control-Allow-Methods: GET');
include_once 'settings.php';

$type = new Type($pdo);

$data = $type->read();

if ($data->rowCount() > 0) {
  $types = ['rows' => $data->fetchAll()];

  http_response_code(200);

  echo json_encode($types);
} else {
  http_response_code(204);

  echo json_encode(['message' => 'There are no types'], JSON_UNESCAPED_UNICODE);
}
