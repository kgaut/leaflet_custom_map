<?php

namespace Drupal\leaflet_custom_map\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\leaflet_custom_map\MapBackgroundInterface;

/**
 * Defines the map_background entity type.
 *
 * @ConfigEntityType(
 *   id = "map_background",
 *   label = @Translation("Map background"),
 *   label_collection = @Translation("Map background"),
 *   label_singular = @Translation("Map background"),
 *   label_plural = @Translation("Map backgrounds"),
 *   label_count = @PluralTranslation(
 *     singular = "@count Map background",
 *     plural = "@count Map backgrounds",
 *   ),
 *   handlers = {
 *     "list_builder" = "Drupal\leaflet_custom_map\MapBackgroundListBuilder",
 *     "form" = {
 *       "add" = "Drupal\leaflet_custom_map\Form\MapBackgroundForm",
 *       "edit" = "Drupal\leaflet_custom_map\Form\MapBackgroundForm",
 *       "delete" = "Drupal\Core\Entity\EntityDeleteForm"
 *     }
 *   },
 *   config_prefix = "map_background",
 *   admin_permission = "administer map_background",
 *   links = {
 *     "collection" = "/admin/structure/map-background",
 *     "add-form" = "/admin/structure/map-background/add",
 *     "edit-form" = "/admin/structure/map-background/{map_background}",
 *     "delete-form" = "/admin/structure/map-background/{map_background}/delete"
 *   },
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   config_export = {
 *     "id",
 *     "label",
 *     "description"
 *   }
 * )
 */
class MapBackground extends ConfigEntityBase implements MapBackgroundInterface {

  /**
   * The map_background ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The map_background label.
   *
   * @var string
   */
  protected $label;

  /**
   * The map_background status.
   *
   * @var bool
   */
  protected $status;

  /**
   * The map_background description.
   *
   * @var string
   */
  protected $description;

}
