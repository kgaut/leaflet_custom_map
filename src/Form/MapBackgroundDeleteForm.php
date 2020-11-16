<?php

namespace Drupal\leaflet_custom_map\Form;

use Drupal\Core\Entity\ContentEntityDeleteForm;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

class MapBackgroundDeleteForm extends ContentEntityDeleteForm {

  public function getCancelUrl() {
    return Url::fromRoute('entity.map_background.collection');
  }
}
