# **_How Utiweb Works 😊_**
Here is a little explanation on how this project works.

- All requests are sent to [index.php](index.php).
- Request is then passed to [RequestHandler](app/Core/Http/RequestHandler.php) which will load and execute defined middlewares.
- This project has a couples of middlewares, such as:
  - [RoutingMiddleware](app/Core/Http/Middleware/RoutingMiddleware.php) - For handling http routing.
  - [AuthMiddleware](app/Http/Middleware/AuthMiddleware.php) - Handles admin authentication system.
  - [ValidateRouteUrlParam](app/Http/Middleware/ValidateRouteUrlParam.php) -  Validates the url to be scraped.
  - [VisitCounterMiddleware](app/Http/Middleware/VisitCounterMiddleware.php) - For counting and saving visits for statistical purpose.
- A [RoutingMiddleware](app/Core/Http/Middleware/RoutingMiddleware.php) will load and dispatch the request uri.
- If dispatched uri is found, a 
    - Request will be passed to [Matcher](app/Core/Http/Router/Matcher.php) which will load defined controller
    - A controller is responsible for executing request and generating response, it:
        - Load view file and send back html response.
        - Execute the [scraping script](https://github.com/Ahmard/uticlass) and send back the scraping result as json response.
- If dispatch uri is not found, a **404(Not Found)** response will be sent to browser.
- If dispatch uri's request method does not match, a **405(Method Not Allowed)** will be sent to browser respectfully.
- [Symfony's Twig](https://twig.symfony.com/) is being used as templating language. 
