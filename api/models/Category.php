<?php


class Category
{
  private $conn;

  public $id, $name, $description, $parent_id, $created_at, $updated_at;

  public function __construct($pdo)
  {
    $this->conn = $pdo;
  }

  public function read()
  {
    $query = 'SELECT * FROM category ORDER BY created_at DESC';
    return $this->conn->query($query);
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
                created_at = :created_at,
                updated_at = DEFAULT(updated_at)
              WHERE id = :id';
    $stmt = $this->conn->prepare($query);

    $this->name = $this->cleanField($this->name);
    $this->description = $this->cleanField($this->description);
    $this->parent_id = $this->cleanField($this->parent_id);
    $this->created_at = $this->cleanField($this->created_at);

    try {
      return $stmt->execute(['id' => $this->id, 'name' => $this->name, 'description' => $this->description,
        'parent_id' => $this->parent_id, 'created_at' => $this->created_at]);
    } catch (PDOException $e) {
      echo $e->getMessage();
      die();
    }
  }

  public function readOne()
  {
    $query = 'SELECT * FROM category WHERE id = :id';
    $stmt = $this->conn->prepare($query);

    $this->id = $this->cleanField($this->id);

    return $stmt->execute(['id' => $this->id]);
  }

  private function cleanField($field)
  {
    if ($field) return htmlspecialchars(strip_tags($field));
    return null;
  }
}