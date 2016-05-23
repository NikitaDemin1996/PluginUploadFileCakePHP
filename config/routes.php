<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

Router::plugin(
    'PluginUploadFileCakePHP',
    ['path' => '/plugin-upload-file-cake-p-h-p'],
    function (RouteBuilder $routes) {
        $routes->fallbacks('DashedRoute');
    }
);
