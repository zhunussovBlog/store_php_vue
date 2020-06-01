<?php

include_once 'Model.php';

class Category extends Model
{
  private $conn;

  public $id, $name, $description, $parent_id, $created_at, $updated_at;

  public function __construct(PDO $pdo)
  {
    $this->conn = $pdo;
  }

  public function read()
  {
    return $this->conn->query('SELECT * FROM category');
  }

  public function create()
  {
    $query = 'INSERT INTO category (name, description, parent_id, created_at, updated_at)
                VALUES (:name, :description, :parent_id, DEFAULT, DEFAULT)';
    $stmt = $this->conn->prepare($query);

    $this->name = $this->cleanField($this->name);
    $this->description = $this->cleanField($this->description);
    $this->parent_id = $this->cleanField($this->parent_id);

    return $stmt->execute(['name' => $this->name, 'description' => $this->description,
      'parent_id' => $this->parent_id]);
  }

  public function update()
  {
    $query = 'UPDATE category
              SET
                name = :name,
                description = :description,
                parent_id = :parent_id,
                updated_at = CURRENT_TIME()
              WHERE id = :id';
    $stmt = $this->conn->prepare($query);

    $this->id = $this->cleanField($this->id);
    $this->name = $this->cleanField($this->name);
    $this->description = $this->cleanField($this->description);
    $this->parent_id = $this->cleanField($this->parent_id);

    return $stmt->execute(['id' => $this->id, 'name' => $this->name, 'description' => $this->description,
      'parent_id' => $this->parent_id]);
  }

  public function readOne()
  {
    $query = 'SELECT * FROM category WHERE id = :id';
    $stmt = $this->conn->prepare($query);

    $this->id = $this->cleanField($this->id);

    $stmt->execute(['id' => $this->id]);

    return $stmt;
  }

  public function delete()
  {
    $query = 'DELETE FROM category WHERE id = :id';

    $stmt = $this->conn->prepare($query);

    $this->id = $this->cleanField($this->id);

    return $stmt->execute(['id' => $this->id]);
  }
}