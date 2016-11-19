<?php

namespace realBusiness\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Goutte;


class SSP extends BaseController
{
  public function getValues () {

    $firstPage = $this->getMainPage();

    $categories = $this->getCategories($firstPage);

    dump($categories);

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
