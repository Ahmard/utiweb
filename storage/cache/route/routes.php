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
        'handler' => 'MainController@index',
        'method' => 'GET',
        'middleware' => '',
      ),
      '/admin' => 
      array (
        'prefix' => '/admin',
        'append' => '',
        'prepend' => '',
        'namespace' => 'Admin\\',
        'name' => '',
        'handler' => 'MainController@index',
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
        'handler' => 'ContactController@index',
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
        'handler' => 'ContactController@sendMessage',
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
        'handler' => 'MovieController@index',
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
        'handler' => 'MovieController@fzmovies',
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
        'handler' => 'MovieController@netnaija',
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
        'handler' => 'MovieController@coolmoviez',
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
        'handler' => 'TVShowController@index',
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
        'handler' => 'TVShowController@femkvcom',
        'method' => 'GET',
        'middleware' => '',
      ),
      '/tvshows/o2tvseries-com' => 
      array (
        'prefix' => '/tvshows/o2tvseries-com',
        'append' => '',
        'prepend' => '',
        'namespace' => '',
        'name' => '',
        'handler' => 'TVShowController@o2tvseriescom',
        'method' => 'GET',
        'middleware' => '',
      ),
      '/tvshows/o2tvseries-co-za' => 
      array (
        'prefix' => '/tvshows/o2tvseries-co-za',
        'append' => '',
        'prepend' => '',
        'namespace' => '',
        'name' => '',
        'handler' => 'TVShowController@o2tvseriescoza',
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
        'handler' => 'OthersController@index',
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
        'handler' => 'OthersController@zippyShare',
        'method' => 'GET',
        'middleware' => '',
      ),
    ),
    'POST' => 
    array (
      '/admin/login' => 
      array (
        'prefix' => '/admin/login',
        'append' => '',
        'prepend' => '',
        'namespace' => 'Admin\\',
        'name' => '',
        'handler' => 'MainController@login',
        'method' => 'POST',
        'middleware' => '',
      ),
      '/api/contact/send-message' => 
      array (
        'prefix' => '/api/contact/send-message',
        'append' => '',
        'prepend' => '',
        'namespace' => 'Api\\Contact\\',
        'name' => '',
        'handler' => 'MessageController@sendMessage',
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
        'regex' => '~^(?|/admin/([^/]+)|/admin/message/([^/]+)()|/admin/message/readied/([^/]+)()()|/admin/message/unread/([^/]+)()()()|/admin/error/([^/]+)()()()()|/api/movies/fzmovies/([^/]+)/([^/]+)()()()()|/api/movies/netnaija/([^/]+)()()()()()()|/api/movies/coolmoviez/([^/]+)()()()()()()()|/api/tvshows/480mkv\\-com/([^/]+)()()()()()()()()|/api/tvshows/o2tvseries\\-com/([^/]+)()()()()()()()()()|/api/tvshows/o2tvseries\\-co\\-za/([^/]+)()()()()()()()()()()|/api/others/zippyshare/([^/]+)()()()()()()()()()()())$~',
        'routeMap' => 
        array (
          2 => 
          array (
            0 => 
            array (
              'prefix' => '/admin/{token}',
              'append' => '{token}',
              'prepend' => '',
              'namespace' => 'Admin\\',
              'name' => '',
              'handler' => 'MainController@index',
              'method' => 'GET',
              'middleware' => 'admin',
            ),
            1 => 
            array (
              'token' => 'token',
            ),
          ),
          3 => 
          array (
            0 => 
            array (
              'prefix' => '/admin/message/{token}',
              'append' => '{token}',
              'prepend' => '',
              'namespace' => 'Admin\\',
              'name' => '',
              'handler' => 'MessageController@index',
              'method' => 'GET',
              'middleware' => 'admin',
            ),
            1 => 
            array (
              'token' => 'token',
            ),
          ),
          4 => 
          array (
            0 => 
            array (
              'prefix' => '/admin/message/readied/{token}',
              'append' => '{token}',
              'prepend' => '',
              'namespace' => 'Admin\\',
              'name' => '',
              'handler' => 'MessageController@readied',
              'method' => 'GET',
              'middleware' => 'admin',
            ),
            1 => 
            array (
              'token' => 'token',
            ),
          ),
          5 => 
          array (
            0 => 
            array (
              'prefix' => '/admin/message/unread/{token}',
              'append' => '{token}',
              'prepend' => '',
              'namespace' => 'Admin\\',
              'name' => '',
              'handler' => 'MessageController@unread',
              'method' => 'GET',
              'middleware' => 'admin',
            ),
            1 => 
            array (
              'token' => 'token',
            ),
          ),
          6 => 
          array (
            0 => 
            array (
              'prefix' => '/admin/error/{token}',
              'append' => '{token}',
              'prepend' => '',
              'namespace' => 'Admin\\',
              'name' => '',
              'handler' => 'ErrorController@index',
              'method' => 'GET',
              'middleware' => 'admin',
            ),
            1 => 
            array (
              'token' => 'token',
            ),
          ),
          7 => 
          array (
            0 => 
            array (
              'prefix' => '/api/movies/fzmovies/{chosen}/{url}',
              'append' => '',
              'prepend' => '',
              'namespace' => 'Api\\Movies\\',
              'name' => '',
              'handler' => 'FZMoviesController@index',
              'method' => 'GET',
              'middleware' => '',
            ),
            1 => 
            array (
              'chosen' => 'chosen',
              'url' => 'url',
            ),
          ),
          8 => 
          array (
            0 => 
            array (
              'prefix' => '/api/movies/netnaija/{url}',
              'append' => '',
              'prepend' => '',
              'namespace' => 'Api\\Movies\\',
              'name' => '',
              'handler' => 'NetNaijaController@index',
              'method' => 'GET',
              'middleware' => '',
            ),
            1 => 
            array (
              'url' => 'url',
            ),
          ),
          9 => 
          array (
            0 => 
            array (
              'prefix' => '/api/movies/coolmoviez/{url}',
              'append' => '',
              'prepend' => '',
              'namespace' => 'Api\\Movies\\',
              'name' => '',
              'handler' => 'CoolMoviezController@index',
              'method' => 'GET',
              'middleware' => '',
            ),
            1 => 
            array (
              'url' => 'url',
            ),
          ),
          10 => 
          array (
            0 => 
            array (
              'prefix' => '/api/tvshows/480mkv-com/{url}',
              'append' => '',
              'prepend' => '',
              'namespace' => 'Api\\TVShows\\',
              'name' => '',
              'handler' => 'FEMkvComController@index',
              'method' => 'GET',
              'middleware' => '',
            ),
            1 => 
            array (
              'url' => 'url',
            ),
          ),
          11 => 
          array (
            0 => 
            array (
              'prefix' => '/api/tvshows/o2tvseries-com/{url}',
              'append' => '',
              'prepend' => '',
              'namespace' => 'Api\\TVShows\\',
              'name' => '',
              'handler' => 'O2TvSeriesComController@index',
              'method' => 'GET',
              'middleware' => '',
            ),
            1 => 
            array (
              'url' => 'url',
            ),
          ),
          12 => 
          array (
            0 => 
            array (
              'prefix' => '/api/tvshows/o2tvseries-co-za/{url}',
              'append' => '',
              'prepend' => '',
              'namespace' => 'Api\\TVShows\\',
              'name' => '',
              'handler' => 'O2TvSeriesCoZaController@index',
              'method' => 'GET',
              'middleware' => '',
            ),
            1 => 
            array (
              'url' => 'url',
            ),
          ),
          13 => 
          array (
            0 => 
            array (
              'prefix' => '/api/others/zippyshare/{url}',
              'append' => '',
              'prepend' => '',
              'namespace' => 'Api\\Others\\',
              'name' => '',
              'handler' => 'ZippyShareController@index',
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
    'POST' => 
    array (
      0 => 
      array (
        'regex' => '~^(?|/admin/error/delete/([^/]+))$~',
        'routeMap' => 
        array (
          2 => 
          array (
            0 => 
            array (
              'prefix' => '/admin/error/delete/{token}',
              'append' => '{token}',
              'prepend' => '',
              'namespace' => 'Admin\\',
              'name' => '',
              'handler' => 'MainController@delete',
              'method' => 'POST',
              'middleware' => 'admin',
            ),
            1 => 
            array (
              'token' => 'token',
            ),
          ),
        ),
      ),
    ),
    'PATCH' => 
    array (
      0 => 
      array (
        'regex' => '~^(?|/api/admin/message/([^/]+)/([^/]+))$~',
        'routeMap' => 
        array (
          3 => 
          array (
            0 => 
            array (
              'prefix' => '/api/admin/message/{messageId}/{token}',
              'append' => '{token}',
              'prepend' => '',
              'namespace' => 'Api\\Admin\\',
              'name' => '',
              'handler' => 'MessageController@markAsRead',
              'method' => 'PATCH',
              'middleware' => '',
            ),
            1 => 
            array (
              'messageId' => 'messageId',
              'token' => 'token',
            ),
          ),
        ),
      ),
    ),
    'DELETE' => 
    array (
      0 => 
      array (
        'regex' => '~^(?|/api/admin/message/([^/]+)/([^/]+)|/api/admin/error/([^/]+)()())$~',
        'routeMap' => 
        array (
          3 => 
          array (
            0 => 
            array (
              'prefix' => '/api/admin/message/{messageId}/{token}',
              'append' => '{token}',
              'prepend' => '',
              'namespace' => 'Api\\Admin\\',
              'name' => '',
              'handler' => 'MessageController@delete',
              'method' => 'DELETE',
              'middleware' => '',
            ),
            1 => 
            array (
              'messageId' => 'messageId',
              'token' => 'token',
            ),
          ),
          4 => 
          array (
            0 => 
            array (
              'prefix' => '/api/admin/error/{token}',
              'append' => '{token}',
              'prepend' => '',
              'namespace' => 'Api\\Admin\\',
              'name' => '',
              'handler' => 'ErrorController@delete',
              'method' => 'DELETE',
              'middleware' => '',
            ),
            1 => 
            array (
              'token' => 'token',
            ),
          ),
        ),
      ),
    ),
  ),
);