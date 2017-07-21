<?php

namespace Drupal\reactivelamp_spa\Twig;
use Limenius\ReactRenderer\Renderer\PhpExecJsReactRenderer;
use Limenius\ReactRenderer\Twig\ReactRenderExtension;

class ReactRenderer extends \Twig_Extension
{
  public function getName()
  {
    return 'react_renderer';
  }

  public function getFunctions()
  {
    global $base_url;

//    $environment = Settings::get('environment');
//    $url = $environment === 'dev' ? 'http://localhost:3000/bundle.js' : $base_url;
//    $renderer = new PhpExecJsReactRenderer($url);
//    $ext = new ReactRenderExtension($renderer, 'both');
//
//    return [
//      new
//    ];
  }
}
