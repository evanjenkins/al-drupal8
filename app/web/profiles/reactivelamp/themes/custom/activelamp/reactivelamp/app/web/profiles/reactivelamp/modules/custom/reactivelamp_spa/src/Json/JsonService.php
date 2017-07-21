<?php

namespace Drupal\reactivelamp_spa\Json;

use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Request;

class JsonService
{
  private $configFactory;

  private $httpClient;

  public function __construct(Client $client, $configFactory)
  {
    $this->httpClient = $client;
    $this->configFactory = $configFactory;
  }

  public function makeRequest($url, $query)
  {
    global $base_url;
    global $base_path;

//    $response = $this->httpClient->request('GET', $url, [
//      'query' => $query
//    ]);
    $request = Request::create($url, 'GET');
    $content = $request->getContent();
//    if ($response->getStatusCode() != 200) {
//      throw new ApiException;
//    }

//    $body = (string) $response->getBody();
//    $data = json_decode($body, true);
    kint($request);
//    if (!isset($data['photoset'])) {
//      throw new ApiException;
//    }

    return $content;
  }
}
