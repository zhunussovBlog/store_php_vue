<?php

include_once 'Model.php';

class Brand extends Model
{
  private $conn;

  public $id, $name, $created_at, $updated_at;

  public function __construct(PDO $pdo)
  {
    $this->conn = $pdo;
  }

  public function read()
  {
    return $this->conn->query('SELECT * FROM product_brand');
  }

  public function readOne()
  {
    $query = 'SELECT * FROM product_brand WHERE id = :id';
    $stmt = $this->conn->prepare($query);

    $this->id = $this->cleanField($this->id);

    $stmt->execute(['id' => $this->id]);

    return $stmt;
  }

  public function create()
  {
    $query = 'INSERT INTO product_brand (name, created_at, updated_at)
            VALUES (:name, DEFAULT, DEFAULT)';
    $stmt = $this->conn->prepare($query);

    $this->name = $this->cleanField($this->name);

    return $stmt->execute(['name' => $this->name]);
  }

  public function update()
  {
    $query = 'UPDATE product_brand
              SET
                name = :name,
                updated_at = CURRENT_TIME()
              WHERE id = :id';
    $stmt = $this->conn->prepare($query);

    $this->id = $this->cleanField($this->id);
    $this->name = $this->cleanField($this->name);

    return $stmt->execute(['id' => $this->id, 'name' => $this->name]);
  }

  public function delete()
  {
    $query = 'DELETE FROM product_brand WHERE id = :id';

    $stmt = $this->conn->prepare($query);

    $this->id = $this->cleanField($this->id);

    return $stmt->execute(['id' => $this->id]);
  }
}