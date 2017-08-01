<?php

namespace Drupal\reactivelamp_spa\Renderer;

use Limenius\ReactRenderer\Context\ContextProviderInterface;
use Limenius\ReactRenderer\Renderer\PhpExecJsReactRenderer;
use Limenius\ReactRenderer\Twig\ReactRenderExtension;

class PhpExecJsReactRendererFactory {

  /**
   * @var ContextProviderInterface
   */
  private $contextProvider;

  public function __construct(ContextProviderInterface $contextProvider)
  {
    $this->contextProvider = $contextProvider;
  }

  public function createRenderer()
  {
    return new PhpExecJsReactRenderer(
      '/' . drupal_get_path('theme', 'activelamp') . '/reactivelamp/dist/main.js',
      false,
      $this->contextProvider
    );

    return new ReactRenderExtension($renderer, $this->contextProvider, 'both');
  }
}