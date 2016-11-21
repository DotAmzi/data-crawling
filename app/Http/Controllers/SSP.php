<?php

namespace realBusiness\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Goutte;

$category = "";


class SSP extends BaseController
{
  public function getValues () {

    $firstPage = $this->getMainPage();

    $categories = $this->getCategories($firstPage);

    $biddings = $this->getBiddings($categories);

    foreach ($biddings as $key=>$value) {
      if(count($value) === 0)
        unset($biddings[$key]);
    }
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

    foreach($urls as $key=>$url) {
      $values = $this->getRegistersBiddings($url);
      $biddings[$key] = $values['registers'];
      $pagination = $values['pagination'];
      foreach ($pagination as $pag) {
        if($pag !== null && count($pag) != 0) {
          $values = $this->getRegistersBiddings($pag[0]);
          $biddings[$key] = array_merge($biddings[$key], $values['registers']);
        }
      }
    }
    return $biddings;
  }

  private function getRegistersBiddings ($url) {
    $crawl = Goutte::request('GET', $url);
    $GLOBALS['category'] = $crawl->filter('.dm_cat > .dm_title') -> text();
    $values['registers'] = $crawl
                            ->filter('#dm_docs > .dm_row')
                              ->each(function($element){
                                $bidding['title'] = $element->filter('h3 > a') -> text();
                                $bidding['title'] = preg_replace("/\t|\n/",'',$bidding['title']);
                                $bidding['cat'] = $GLOBALS['category'];
                                $bidding['File'] = $element->filter('div > ul > li > a') -> link() -> getUri();
                                return $bidding;
                              });
    $values['pagination'] = $crawl
                              ->filter('#dm_nav > ul > li')
                                ->each(function($element){
                                  if(!$element->attr('class')) {
                                    return $element->filter('a')
                                        ->each(function($element){
                                            return $element->link()->getUri();
                                        });

                                  }
                                });
    return $values;
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
