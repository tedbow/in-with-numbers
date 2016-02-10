<?php

/**
 * @file
 * Contains \Drupal\in_with_numbers\Form\AddCommitmentForm.
 */

namespace Drupal\in_with_numbers\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Entity\EntityTypeManager;

/**
 * Class AddCommitmentForm.
 *
 * @package Drupal\in_with_numbers\Form
 */
class AddCommitmentForm extends FormBase {

  /**
   * Drupal\Core\Entity\EntityTypeManager definition.
   *
   * @var Drupal\Core\Entity\EntityTypeManager
   */
  protected $entity_type_manager;
  public function __construct(
    EntityTypeManager $entity_type_manager
  ) {
    $this->entity_type_manager = $entity_type_manager;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory'),
      $container->get('entity_type.manager')
    );
  }


  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'add_commitment_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['i_am_in'] = array(
      '#type' => 'submit',
      '#title' => $this->t('I am in'),
      '#description' => $this->t('Are you down?'),
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

  }

}
