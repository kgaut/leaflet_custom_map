<?php

class CustomMap extends MyObject {

  protected static $db_table_name = 'custom_map';

  protected static $db_table_identifier = 'cmid';

  public $cmid;

  public $fid;

  public $map;

  public $name;

  public $status;

  public $bounds;

  public $opacity;

  public $weight;

  public $created;

  public $user;

  public static function loadForMap($map) {
    $objectsArray = array();
    $query = db_select(static::$db_table_name, 't');
    $query->fields('t');
    $query->condition('map', $map);
    $query->condition('status', 1);
    $query->orderBy('weight', 'ASC');

    $result = $query->execute();
    if ($result) {
      while ($row = $result->fetchObject()) {
        $instance = new static();
        foreach ($instance as $k => &$v) {
          if (isset($row->{$k})) {
            $v = $row->{$k};
          }
        }
        $objectsArray[] = $instance;
      }
    }

    return $objectsArray;
  }

  public static function loadAll() {
    $steps = array();
    $query = db_select(static::$db_table_name, 's');
    $query->fields('s', array(static::$db_table_identifier));
    $query->orderBy('map', 'ASC');
    $query->orderBy('weight', 'ASC');
    $result = $query->execute();
    while ($row = $result->fetchObject()) {
      $steps[] = new static(array(static::$db_table_identifier => $row->{static::$db_table_identifier}));
    }
    return $steps;
  }

}