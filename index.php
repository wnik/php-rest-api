<?php

    require 'vendor/autoload.php';

    use App\Core\App;
    use App\Config\Config;
    use Psr\Http\Message\RequestInterface;
    use Psr\Http\Message\ResponseInterface;

    $config = new Config();

    $app = new App($config);

    $app->get('/users', array(), function (RequestInterface $request, ResponseInterface $response) {
//        var_dump($request);
//        var_dump($response);
        echo 'ok';
    });

    $app->get('/archive/{page}/user/{user}',
            array('page' => '([0-9]+)', 'user' => '(\w+)'),
            function (RequestInterface $request, ResponseInterface $response, array $arguments) {
                $response->getBody()->write('HeLlLO xD');
                $length = $response->getBody()->getSize();
                $response->getBody()->rewind();
                var_dump($response->getBody()->read($length));
            }
    );

    $app->run();