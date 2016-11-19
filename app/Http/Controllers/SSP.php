<?php

namespace realBusiness\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Goutte;


class SSP extends BaseController
{
  public function getValues () {

    $firstPage = $this->getMainPage();

    $categories = $this->getCategories($firstPage);

    $biddings = $this->getBiddings($categories);
dump($biddings);
   return view('welcome');
  }

  private function getMainPage() {
    $crawl = Goutte::request('GET', 'http://licitacoes.ssp.df.gov.br./index.php/licitacoes');

    $crawl =
        $crawl
          ->filter('#dm_cats > div > div > a')
          ->link();

    return $crawl->getUri();
  }

  private function getBiddings ($urls) {

    foreach($urls as $url) {
      echo "$url <br>";
      $crawl = Goutte::request('GET', $url);
      $biddings[] = $crawl
            ->filter('#dm_docs > .dm_row')
            ->each(function($element){
              $bidding['title'] = $element->filter('h3 > a') -> text();
              $bidding['File'] = $element->filter('div > ul > li > a') -> link() -> getUri();
              return $bidding;
            });

    }

    return $biddings;

  }

  private function getCategories($url) {
    $crawl = Goutte::request('GET', $url);

    $links = array();

    $links = $crawl
          ->filter('#dm_cats > div > div > a')
          ->each(function($element){
            return $element->link()->getUri();
          });

    return $links;
  }
}

?>
