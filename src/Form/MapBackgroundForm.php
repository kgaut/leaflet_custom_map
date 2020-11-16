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
    $link = $entity->toLink($this->t('View'))->toRenderable();

    $message_arguments = ['%label' => $this->entity->label()];
    $logger_arguments = $message_arguments + ['link' => render($link)];

    if ($result == SAVED_NEW) {
      $this->messenger()->addStatus($this->t('New map background %label has been created.', $message_arguments));
      $this->logger('leaflet_custom_map')->notice('Created new map background %label', $logger_arguments);
    }
    else {
      $this->messenger()->addStatus($this->t('The map background %label has been updated.', $message_arguments));
      $this->logger('leaflet_custom_map')->notice('Updated new map background %label.', $logger_arguments);
    }

    $form_state->setRedirect('entity.map_background.canonical', ['map_background' => $entity->id()]);
  }

}
