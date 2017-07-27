<?php

namespace Drupal\reactivelamp_spa\Twig;
use Drupal\Core\Site\Settings;
use Limenius\ReactRenderer\Renderer\PhpExecJsReactRenderer;
use Limenius\ReactRenderer\Twig\ReactRenderExtension;
use Limenius\ReactRenderer\Context\SymfonyContextProvider;
use Twig_Extension_StringLoader;

class ReactRenderer extends \Twig_Extension
{
  public function getName()
  {
    return 'react_component';
  }

  public function getFunctions()
  {
    return [
      new \Twig_SimpleFunction('react_renderer', [$this, "getReactRenderer"])
    ];
  }

  public function getReactRenderer()
  {
    global $base_url;
    $environment = Settings::get('environment');
    $requestStack = \Drupal::requestStack();
    // SymfonyContextProvider provides information about the current request, such as hostname and path
    // We need an instance of Symfony\Component\HttpFoundation\RequestStack to use it
    $url = $environment === 'dev' ? 'http://localhost:3000/bundle.js' : $base_url . '/bundle.js';
    $contextProvider = new SymfonyContextProvider($requestStack);
    $renderer = new PhpExecJsReactRenderer($url, false, $contextProvider);
    $ext = new ReactRenderExtension($renderer, $contextProvider, 'both');
    return $ext;
//    $twig->addExtension(new Twig_Extension_StringLoader());
//    $twig->addExtension($ext);
  }
}
