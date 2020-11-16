<?php

namespace Drupal\leaflet_custom_map\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\leaflet_custom_map\Entity\MapBackgroundInterface;
use Drupal\user\UserInterface;

/**
 * Defines the map background entity class.
 *
 * @ContentEntityType(
 *   id = "map_background",
 *   label = @Translation("Map Background"),
 *   label_collection = @Translation("Map Backgrounds"),
 *   handlers = {
 *     "view_builder" = "Drupal\leaflet_custom_map\Entity\ViewBuilder\MapBackgroundViewBuilder",
 *     "list_builder" = "Drupal\leaflet_custom_map\Entity\ListBuilder\MapBackgroundListBuilder",
 *     "views_data" = "Drupal\views\EntityViewsData",
 *     "access" = "Drupal\leaflet_custom_map\Entity\AccessControlHandler\MapBackgroundAccessControlHandler",
 *     "form" = {
 *       "add" = "Drupal\leaflet_custom_map\Form\MapBackgroundForm",
 *       "edit" = "Drupal\leaflet_custom_map\Form\MapBackgroundForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     }
 *   },
 *   base_table = "leaflet_map_background",
 *   admin_permission = "access map background overview",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "id",
 *   },
 *   links = {
 *     "add-form" = "/admin/content/map-background/add",
 *     "edit-form" = "/admin/content/map-background/{map_background}/edit",
 *     "delete-form" = "/admin/content/map-background/{map_background}/delete",
 *     "collection" = "/admin/content/map-background"
 *   },
 * )
 */
class MapBackground extends ContentEntityBase implements MapBackgroundInterface {

  use EntityChangedTrait;

  /**
   * {@inheritdoc}
   *
   * When a new map background entity is created, set the uid entity reference to
   * the current user as the creator of the entity.
   */
  public static function preCreate(EntityStorageInterface $storage_controller, array &$values) {
    parent::preCreate($storage_controller, $values);
    $values += ['uid' => \Drupal::currentUser()->id()];
  }

  /**
   * {@inheritdoc}
   */
  public function getCreatedTime() {
    return $this->get('created')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setCreatedTime($timestamp) {
    $this->set('created', $timestamp);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwner() {
    return $this->get('uid')->entity;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwnerId() {
    return $this->get('uid')->target_id;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwnerId($uid) {
    $this->set('uid', $uid);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwner(UserInterface $account) {
    $this->set('uid', $account->id());
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {

    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['uid'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Auteur'))
      ->setSetting('target_type', 'user')
      ->setDisplayConfigurable('form', TRUE);

    $fields['views'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Vue'))
      ->setSetting('target_type', 'view')
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['image'] = BaseFieldDefinition::create('image')
      ->setLabel(t('Raster'))
      ->setSetting('file_directory', 'public://maps/rasters/' )
      ->setSetting('file_extensions', 'png jpg jpeg svg')
      ->setSetting('title_field', FALSE)
      ->setSetting('title_field_required', FALSE)
      ->setSetting('alt_field', FALSE)
      ->setSetting('alt_field_required', FALSE)
      ->setRequired(TRUE)
      ->setDisplayConfigurable('form', TRUE);

    $fields['weight'] = BaseFieldDefinition::create('integer')
      ->setLabel('Ordre')
      ->setSetting('unsigned', TRUE)
      ->setSetting('min', 0)
      ->setSetting('max', 10)
      ->setSetting('prefix', '$')
      ->setSetting('suffix', '€ TTC')
      ->setDefaultValue(5)
      ->setRequired(TRUE)
      ->setDisplayConfigurable('form', TRUE);

    $fields['bounds'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Bounds'))
      ->setDescription('Format : <code>[[53.0, -5.0], [40.58, 19.17]]</code>')
      ->setRequired(TRUE)
      ->setSetting('max_length', 255)
      ->setSetting('text_processing', 0)
      ->setDefaultValue('')
      ->setDisplayConfigurable('form', TRUE);

    $fields['opacity'] = BaseFieldDefinition::create('decimal')
      ->setLabel(t('Prix'))
      ->setSetting('unsigned', TRUE)
      ->setSetting('scale', 1)
      ->setSetting('min', 0)
      ->setSetting('max', 1)
      ->setRequired(TRUE)
      ->setDescription('Entre 0 et 1, ex : 0.5')
      ->setDefaultValue(1)
      ->setDisplayConfigurable('form', TRUE);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Authored on'))
      ->setDescription(t('The time that the map background was created.'))
      ->setDisplayConfigurable('form', TRUE);

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'));

    return $fields;
  }

}
