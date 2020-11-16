<?php

namespace Drupal\leaflet_custom_map\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the map background entity edit forms.
 */
class MapBackgroundForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {

    $entity = $this->getEntity();
    $result = $entity->save();

    $message_arguments = ['%label' => $this->entity->label()];

    if ($result == SAVED_NEW) {
      $this->messenger()->addStatus($this->t('New map background %label has been created.', $message_arguments));
      $this->logger('leaflet_custom_map')->notice('Created new map background %label');
    }
    else {
      $this->messenger()->addStatus($this->t('The map background %label has been updated.', $message_arguments));
      $this->logger('leaflet_custom_map')->notice('Updated new map background %label.');
    }

    $form_state->setRedirect('entity.map_background.collection');
  }

}
