<?php

    require 'vendor/autoload.php';

    use App\Core\App;
    use App\Config\Config;
    use Psr\Http\Message\RequestInterface;
    use Psr\Http\Message\ResponseInterface;

    $config = new Config();

    $app = new App($config);

    $app->get(
        '/',
        array(),
        function (RequestInterface $request, ResponseInterface $response, array $arguments) {
            $response->getBody()->write('home');

            return $response;
        }
    );

    $app->get(
        '/users/{user}',
        array('user' => '(\w+)'),
        function (RequestInterface $request, ResponseInterface $response, array $arguments) {
            $response->getBody()->write(json_encode($arguments));

            return $response;
        }
    );

    $app->run();