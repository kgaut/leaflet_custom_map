<?php

class CustomMap extends MyObject {

  protected static $db_table_name = 'custom_map';

  protected static $db_table_identifier = 'cmid';

  public $cmid;

  public $fid;

  public $map;

  public $bounds;

  public $created;

  public $user;

  public static function loadForMap($map) {
    return self::_load([['map', $map]]);
  }
}