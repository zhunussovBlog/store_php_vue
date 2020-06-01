<?php
header('Access-Control-Allow-Headers: access');
header('Access-Control-Allow-Methods: GET');
include_once 'settings.php';

$product = new Product($pdo);
$attribute = new Attribute($pdo);
$value = new Value($pdo);

$products = $product->read();

if ($products->rowCount() > 0) {
  $products_arr = array();
  $products_arr['rows'] = array();

  while ($row = $products->fetch()) {
    $attribute->type_id = $row['type_id'];
    $attributes = $attribute->read();
    $product_row = array();
    $product_row['main'] = $row;
    $product_row['attrs'] = array();

    if ($attributes->rowCount() > 0) {
      while ($attr_row = $attributes->fetch()) {
        $value->attr_id = $attr_row['id'];
        $value->product_id = $row['id'];
        $values = $value->read();
        $value_row = $values->fetch();
        $product_row['attrs'][] = ['attribute' => $attr_row, 'value' => $value_row];
      }
    }

    $products_arr['rows'][] = $product_row;
  }

  http_response_code(200);

  echo json_encode($products_arr);
} else {
  http_response_code(204);

  echo json_encode(['message' => 'There are no categories'], JSON_UNESCAPED_UNICODE);
}
