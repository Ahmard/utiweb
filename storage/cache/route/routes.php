<?php return array (
  0 => 
  array (
    'GET' => 
    array (
      '/' => 
      array (
        'prefix' => '/',
        'append' => '',
        'prepend' => '',
        'namespace' => '',
        'name' => '',
        'controller' => 'MainController@index',
        'method' => 'GET',
        'middleware' => '',
      ),
      '/contact' => 
      array (
        'prefix' => '/contact',
        'append' => '',
        'prepend' => '',
        'namespace' => '',
        'name' => '',
        'controller' => 'ContactController@index',
        'method' => 'GET',
        'middleware' => '',
      ),
      '/contact/send-message' => 
      array (
        'prefix' => '/contact/send-message',
        'append' => '',
        'prepend' => '',
        'namespace' => '',
        'name' => '',
        'controller' => 'ContactController@sendMessage',
        'method' => 'GET',
        'middleware' => '',
      ),
      '/movies' => 
      array (
        'prefix' => '/movies',
        'append' => '',
        'prepend' => '',
        'namespace' => '',
        'name' => '',
        'controller' => 'MovieController@index',
        'method' => 'GET',
        'middleware' => '',
      ),
      '/movies/fzmovies' => 
      array (
        'prefix' => '/movies/fzmovies',
        'append' => '',
        'prepend' => '',
        'namespace' => '',
        'name' => '',
        'controller' => 'MovieController@fzmovies',
        'method' => 'GET',
        'middleware' => '',
      ),
      '/movies/netnaija' => 
      array (
        'prefix' => '/movies/netnaija',
        'append' => '',
        'prepend' => '',
        'namespace' => '',
        'name' => '',
        'controller' => 'MovieController@netnaija',
        'method' => 'GET',
        'middleware' => '',
      ),
      '/movies/coolmoviez' => 
      array (
        'prefix' => '/movies/coolmoviez',
        'append' => '',
        'prepend' => '',
        'namespace' => '',
        'name' => '',
        'controller' => 'MovieController@coolmoviez',
        'method' => 'GET',
        'middleware' => '',
      ),
      '/tvshows' => 
      array (
        'prefix' => '/tvshows',
        'append' => '',
        'prepend' => '',
        'namespace' => '',
        'name' => '',
        'controller' => 'TVShowController@index',
        'method' => 'GET',
        'middleware' => '',
      ),
      '/tvshows/480mkv-com' => 
      array (
        'prefix' => '/tvshows/480mkv-com',
        'append' => '',
        'prepend' => '',
        'namespace' => '',
        'name' => '',
        'controller' => 'TVShowController@femkvcom',
        'method' => 'GET',
        'middleware' => '',
      ),
      '/others' => 
      array (
        'prefix' => '/others',
        'append' => '',
        'prepend' => '',
        'namespace' => '',
        'name' => '',
        'controller' => 'OthersController@index',
        'method' => 'GET',
        'middleware' => '',
      ),
      '/others/zippyshare' => 
      array (
        'prefix' => '/others/zippyshare',
        'append' => '',
        'prepend' => '',
        'namespace' => '',
        'name' => '',
        'controller' => 'OthersController@zippyShare',
        'method' => 'GET',
        'middleware' => '',
      ),
    ),
    'POST' => 
    array (
      '/api/contact/send-message' => 
      array (
        'prefix' => '/api/contact/send-message',
        'append' => '',
        'prepend' => '',
        'namespace' => 'Api\\Contact\\',
        'name' => '',
        'controller' => 'MessageController@sendMessage',
        'method' => 'POST',
        'middleware' => '',
      ),
    ),
  ),
  1 => 
  array (
    'GET' => 
    array (
      0 => 
      array (
        'regex' => '~^(?|/api/movies/fzmovies/([^/]+)/([^/]+)|/api/movies/netnaija/([^/]+)()()|/api/movies/coolmoviez/([^/]+)()()()|/api/tvshows/480mkv\\-com/([^/]+)()()()()|/api/others/zippyshare/([^/]+)()()()()())$~',
        'routeMap' => 
        array (
          3 => 
          array (
            0 => 
            array (
              'prefix' => '/api/movies/fzmovies/{chosen}/{url}',
              'append' => '',
              'prepend' => '',
              'namespace' => 'Api\\Movies\\',
              'name' => '',
              'controller' => 'FZMoviesController@index',
              'method' => 'GET',
              'middleware' => '',
            ),
            1 => 
            array (
              'chosen' => 'chosen',
              'url' => 'url',
            ),
          ),
          4 => 
          array (
            0 => 
            array (
              'prefix' => '/api/movies/netnaija/{url}',
              'append' => '',
              'prepend' => '',
              'namespace' => 'Api\\Movies\\',
              'name' => '',
              'controller' => 'NetNaijaController@index',
              'method' => 'GET',
              'middleware' => '',
            ),
            1 => 
            array (
              'url' => 'url',
            ),
          ),
          5 => 
          array (
            0 => 
            array (
              'prefix' => '/api/movies/coolmoviez/{url}',
              'append' => '',
              'prepend' => '',
              'namespace' => 'Api\\Movies\\',
              'name' => '',
              'controller' => 'CoolMoviezController@index',
              'method' => 'GET',
              'middleware' => '',
            ),
            1 => 
            array (
              'url' => 'url',
            ),
          ),
          6 => 
          array (
            0 => 
            array (
              'prefix' => '/api/tvshows/480mkv-com/{url}',
              'append' => '',
              'prepend' => '',
              'namespace' => 'Api\\TVShows\\',
              'name' => '',
              'controller' => 'FEMkvComController@index',
              'method' => 'GET',
              'middleware' => '',
            ),
            1 => 
            array (
              'url' => 'url',
            ),
          ),
          7 => 
          array (
            0 => 
            array (
              'prefix' => '/api/others/zippyshare/{url}',
              'append' => '',
              'prepend' => '',
              'namespace' => 'Api\\Others\\',
              'name' => '',
              'controller' => 'ZippyShareController@index',
              'method' => 'GET',
              'middleware' => '',
            ),
            1 => 
            array (
              'url' => 'url',
            ),
          ),
        ),
      ),
    ),
  ),
);