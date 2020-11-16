<?php

namespace Drupal\leaflet_custom_map;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * Defines the access control handler for the map background entity type.
 */
class MapBackgroundAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {

    switch ($operation) {
      case 'view':
        return AccessResult::allowedIfHasPermission($account, 'view map background');

      case 'update':
        return AccessResult::allowedIfHasPermissions($account, ['edit map background', 'administer map background'], 'OR');

      case 'delete':
        return AccessResult::allowedIfHasPermissions($account, ['delete map background', 'administer map background'], 'OR');

      default:
        // No opinion.
        return AccessResult::neutral();
    }

  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermissions($account, ['create map background', 'administer map background'], 'OR');
  }

}
