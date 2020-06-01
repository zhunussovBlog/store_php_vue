<?php
header('Access-Control-Allow-Headers: access');
header('Access-Control-Allow-Methods: GET');
include_once 'settings.php';

$brand = new Brand($pdo);

$data = $brand->read();

if ($data->rowCount() > 0) {
  $brands = ['rows' => $data->fetchAll()];

  http_response_code(200);

  echo json_encode($brands);
} else {
  http_response_code(204);

  echo json_encode(['message' => 'There are no brands'], JSON_UNESCAPED_UNICODE);
}
