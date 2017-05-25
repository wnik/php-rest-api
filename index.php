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
    });

    $app->run();