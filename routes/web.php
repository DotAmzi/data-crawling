<?php

Route::get('/', function() {
  $crawler = Goutte::request('GET', 'http://licitacoes.ssp.df.gov.br./index.php/licitacoes');

  $crawler =
      $crawler
        ->filter('#dm_cats > div > div > a')
        ->link();

  $href = $crawler->getUri();

 return view('welcome');
});
