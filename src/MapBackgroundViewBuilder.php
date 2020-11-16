<?php

namespace Drupal\leaflet_custom_map;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityViewBuilder;

/**
 * Provides a view controller for a map background entity type.
 */
class MapBackgroundViewBuilder extends EntityViewBuilder {

  /**
   * {@inheritdoc}
   */
  protected function getBuildDefaults(EntityInterface $entity, $view_mode) {
    $build = parent::getBuildDefaults($entity, $view_mode);
    // The map background has no entity template itself.
    unset($build['#theme']);
    return $build;
  }

}
