<?php

namespace Drupal\reactivelamp_spa\Twig;
use Drupal\Core\Site\Settings;
use Limenius\ReactRenderer\Renderer\PhpExecJsReactRenderer;
use Limenius\ReactRenderer\Twig\ReactRenderExtension;
use Limenius\ReactRenderer\Context\SymfonyContextProvider;
use Symfony\Component\HttpFoundation\RequestStack;
use Twig_LoaderInterface;

class ReactRenderer extends \Twig_Extension
{
  private $requestStack;

  private $loader;

  public function __construct(RequestStack $requestStack, Twig_LoaderInterface $loader = null)
  {
    $this->requestStack = $requestStack;
    $this->loader = $loader;
    global $base_url;
    $environment = Settings::get('environment');
    // SymfonyContextProvider provides information about the current request, such as hostname and path
    // We need an instance of Symfony\Component\HttpFoundation\RequestStack to use it
    $url = $environment === 'dev' ? 'http://localhost:3000/bundle.js' : $base_url . '/bundle.js';
    $contextProvider = new SymfonyContextProvider($this->requestStack);
    $renderer = new PhpExecJsReactRenderer($url, false, $contextProvider);
    $ext = new ReactRenderExtension($renderer, $contextProvider, 'both');
    $this->twigEnvironment->addExtension($ext);
  }
}
