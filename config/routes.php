<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

Router::plugin(
    'PluginUploadFileCakePHP',
    ['path' => '/plugin-upload-file-cake-php'],
    function (RouteBuilder $routes) {
        $routes->fallbacks('DashedRoute');
    }
);
