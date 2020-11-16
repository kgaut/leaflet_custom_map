<?php

namespace Drupal\leaflet_custom_map;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\user\EntityOwnerInterface;
use Drupal\Core\Entity\EntityChangedInterface;

/**
 * Provides an interface defining a map background entity type.
 */
interface MapBackgroundInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {

  /**
   * Gets the map background creation timestamp.
   *
   * @return int
   *   Creation timestamp of the map background.
   */
  public function getCreatedTime();

  /**
   * Sets the map background creation timestamp.
   *
   * @param int $timestamp
   *   The map background creation timestamp.
   *
   * @return \Drupal\leaflet_custom_map\MapBackgroundInterface
   *   The called map background entity.
   */
  public function setCreatedTime($timestamp);

}
