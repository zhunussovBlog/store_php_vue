<?php

include_once 'Model.php';

class Attribute extends Model
{
  private $conn;

  public $id, $name, $type, $type_id;

  public function __construct(PDO $pdo)
  {
    $this->conn = $pdo;
  }

  public function read()
  {
    $query = 'SELECT * FROM product_attribute WHERE type_id = :id';

    $stmt = $this->conn->prepare($query);

    $this->type_id = $this->cleanField($this->type_id);

    $stmt->execute(['id' => $this->type_id]);
    return $stmt;
  }

  public function create()
  {
    $query = 'INSERT INTO product_attribute (name, type, type_id)
            VALUES (:name, :type, (SELECT id FROM product_type ORDER BY id DESC LIMIT 1))';
    $stmt = $this->conn->prepare($query);

    $this->name = $this->cleanField($this->name);
    $this->type = $this->cleanField($this->type);
    $this->type_id = $this->cleanField($this->type_id);

    return $stmt->execute(['name' => $this->name,
      'type' => $this->type, 'type_id' => $this->type_id]);
  }

  public function delete()
  {
    $query = 'DELETE FROM product_attribute WHERE id = :id';
    $stmt = $this->conn->prepare($query);

    $this->id = $this->cleanField($this->id);

    return $stmt->execute(['id' => $this->id]);
  }
}