<?php

Route::get('/', function() {
  $openBidding = Goutte::request('GET', 'http://licitacoes.ssp.df.gov.br./index.php/licitacoes');

  $linkBidding = $openBidding
    ->selectLink('Licitações')
    ->getUri();

  // $openTypes = Goutte::request('GET', $uriBidding);
  // $linkTypes = $openTypes
  //   ->filter('div->a')
  //   -link();
  // $uriTypes = $linkTypes-getUri();


  // $crawler = $crawler->click($link1 );
  // $link2 = $crawler->filter('.result__title > a')->attr('alt');
  dump($linkBidding);
  return view('welcome');
});
