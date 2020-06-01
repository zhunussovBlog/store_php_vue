<?php

class Model
{
  protected function cleanField($field)
  {
    if ($field) {
      return htmlspecialchars(strip_tags($field));
    }
    return null;
  }
}