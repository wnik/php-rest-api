<?php

    require 'vendor/autoload.php';

    use App\Core\App;
    use App\Config\Config;
    use Psr\Http\Message\RequestInterface;
    use Psr\Http\Message\ResponseInterface;

    $config = new Config();

    $app = new App($config);

    $app->get('/archive/{page}/user/{user}',
            array('page' => '([0-9]+)', 'user' => '(\w+)'),
            function (RequestInterface $request, ResponseInterface $response, array $arguments) {
                $response->getBody()->write('XDD');

                return $response;
            }
    );

    $app->run();