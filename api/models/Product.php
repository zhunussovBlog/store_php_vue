<?php

include_once 'Model.php';

class Product extends Model
{
  private $conn;

  public $id, $name, $num_cl, $description, $status, $rating,
    $price_tr, $price_re, $created_at, $updated_at, $type_id, $category_id, $brand_id;

  public function __construct(PDO $pdo)
  {
    $this->conn = $pdo;
  }

  public function read()
  {
    return $this->conn->query('SELECT * FROM product_view');
  }

  public function readOne()
  {
    $query = 'SELECT * FROM product_view WHERE id = :id';
    $stmt = $this->conn->prepare($query);

    $this->id = $this->cleanField($this->id);

    $stmt->execute(['id' => $this->id]);

    return $stmt;
  }

  public function create()
  {
    $query = 'INSERT INTO product (name, num_cl, description, status, rating, price_tr,
                     price_re, type_id, category_id, brand_id)
                     VALUES (:name, :num_cl, :desc, :status, :rating, :prict_tr, :price_re, 
                             :type_id, :category_id, :brand_id)';
    $stmt = $this->conn->prepare($query);

    $this->cleanAll();

    return $stmt->execute(['name' => $this->name, 'num_cl' => $this->num_cl, 'desc' => $this->description,
      'status' => $this->status, 'rating' => $this->rating, 'price_tr' => $this->price_tr,
      'price_re' => $this->price_re, 'type_id' => $this->type_id, 'category_id' => $this->category_id,
      'brand_id' => $this->brand_id]);
  }

  public function update()
  {
    $query = 'UPDATE product
              SET 
                name = :name,
                num_cl = :num_cl,
                description = :desc,
                status = :status,
                rating = :rating,
                price_tr = :price_tr,
                price_re = :price_re,
                type_id = :type_id,
                category_id = :category_id,
                brand_id = :brand_id
              WHERE id = :id';
    $stmt = $this->conn->prepare($query);

    $this->id = $this->cleanField($this->id);
    $this->cleanAll();

    return $stmt->execute(['id' => $this->id, 'name' => $this->name, 'num_cl' => $this->num_cl, 'desc' => $this->description,
      'status' => $this->status, 'rating' => $this->rating, 'price_tr' => $this->price_tr,
      'price_re' => $this->price_re, 'type_id' => $this->type_id, 'category_id' => $this->category_id,
      'brand_id' => $this->brand_id]);
  }

  public function delete()
  {
    $query = 'DELETE FROM product WHERE id = :id';
    $stmt = $this->conn->prepare($query);
    $this->id = $this->cleanField($this->id);
    return $stmt->execute(['id' => $this->id]);
  }

  private function cleanAll()
  {
    $this->name = $this->cleanField($this->name);
    $this->num_cl = $this->cleanField($this->num_cl);
    $this->description = $this->cleanField($this->description);
    $this->status = $this->cleanField($this->status);
    $this->rating = $this->cleanField($this->rating);
    $this->price_tr = $this->cleanField($this->price_tr);
    $this->price_re = $this->cleanField($this->price_re);
    $this->type_id = $this->cleanField($this->type_id);
    $this->category_id = $this->cleanField($this->category_id);
    $this->brand_id = $this->cleanField($this->brand_id);
    return null;
  }

}