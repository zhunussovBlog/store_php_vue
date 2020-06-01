<?php


class Value extends Model
{
  private $conn;

  public $id, $value_text, $value_int, $value_float, $value_bool, $attr_id, $product_id;

  public function __construct(PDO $pdo)
  {
    $this->conn = $pdo;
  }

  public function read()
  {
    $query = 'SELECT * FROM attribute_value WHERE attr_id = :attr_id AND product_id = :product_id';

    $stmt = $this->conn->prepare($query);

    $this->attr_id = $this->cleanField($this->attr_id);
    $this->product_id = $this->cleanField($this->product_id);

    $stmt->execute(['attr_id' => $this->attr_id, 'product_id' => $this->product_id]);
    return $stmt;
  }

  public function create()
  {
    $data = array();
    $query = 'INSERT INTO attribute_value (';
    if ($this->value_text) {
      $query .= 'value_text';
      $this->value_text = $this->cleanField($this->value_text);
      $data['value'] = $this->value_text;
    } else if ($this->value_int) {
      $query .= 'value_int';
      $this->value_int = $this->cleanField($this->value_int);
      $data['value'] = $this->value_int;
    } else if ($this->value_float) {
      $query .= 'value_float';
      $this->value_float = $this->cleanField($this->value_float);
      $data['value'] = $this->value_float;
    } else if ($this->value_bool) {
      $query .= 'value_bool';
      $this->value_bool = $this->cleanField($this->value_bool);
      $data['value'] = $this->value_bool;
    }

    $query .= ', attr_id, product_id)
            VALUES (:value, :attr_id, (SELECT id FROM product ORDER BY id DESC LIMIT 1))';

    $stmt = $this->conn->prepare($query);

    $this->attr_id = $this->cleanField($this->attr_id);
    $data['attr_id'] = $this->attr_id;

    return $stmt->execute($data);
  }

  public function delete()
  {
    $query = 'DELETE FROM attribute_value WHERE product_id = :id';
    $stmt = $this->conn->prepare($query);
    $this->product_id = $this->cleanField($this->product_id);
    return $stmt->execute(['id' => $this->product_id]);
  }
}