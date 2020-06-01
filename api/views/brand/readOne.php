<?php
header('Access-Control-Allow-Headers: access');
header('Access-Control-Allow-Methods: GET');
include_once 'settings.php';

$brand = new Brand($pdo);

if (!empty($_GET['id'])) {
  $brand->id = $_GET['id'];

  $row = $brand->readOne();
  if ($row->rowCount() > 0) {
    http_response_code(200);

    echo json_encode(['rows' => $row->fetch()]);
  } else {
    http_response_code(404);

    echo json_encode(['message' => 'Brand is not found'], JSON_UNESCAPED_UNICODE);
  }

} else {
  http_response_code(400);

  echo json_encode(['message' => 'Incomplete data!'], JSON_UNESCAPED_UNICODE);
}
