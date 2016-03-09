<?php

/**
 * @file
 * Contains \Drupal\in_with_numbers\Plugin\Block\CommitmentAddBlock.
 */

namespace Drupal\in_with_numbers\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormBuilderInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Session\AccountProxyInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Routing\CurrentRouteMatch;
use Drupal\Core\Session\AccountProxy;

/**
 * Provides a 'CommitmentAddBlock' block.
 *
 * @Block(
 *  id = "commitment_add_block",
 *  admin_label = @Translation("Commitment add block"),
 * )
 */
class CommitmentAddBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * Drupal\Core\Routing\CurrentRouteMatch definition.
   *
   * @var \Drupal\Core\Routing\CurrentRouteMatch
   */
  protected $current_route_match;

  /**
   * Drupal\Core\Session\AccountProxy definition.
   *
   * @var \Drupal\Core\Session\AccountProxy
   */
  protected $current_user;

  /**
   * @var \Drupal\Core\Form\FormBuilderInterface
   */
  protected $form_builder;
  /**
   * Construct.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param string $plugin_definition
   *   The plugin implementation definition.
   */
  public function __construct(
        array $configuration,
        $plugin_id,
        $plugin_definition,
        CurrentRouteMatch $current_route_match,
	AccountProxyInterface $current_user,
    FormBuilderInterface $form_builder
  ) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->current_route_match = $current_route_match;
    $this->current_user = $current_user;
    $this->form_builder = $form_builder;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('current_route_match'),
      $container->get('current_user'),
      $container->get('form_builder')
    );
  }



  /**
   * {@inheritdoc}
   */
  public function build() {

    $build = [];

    $build['form'] = $this->form_builder->getForm('\Drupal\in_with_numbers\Form\AddCommitmentForm');

    return $build;
  }

  protected function blockAccess(AccountInterface $account) {
    return AccessResult::allowedIfHasPermission($account,'create commitment content');
  }


}
