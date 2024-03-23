<?php

declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;


return function (App $app) {

    //database connect..



    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Hello world!');
        return $response;
    });

    //get and post..
    $app->get('/posts/', function (Request $request, Response $response) {
        $post = new Model\Post();
        $jsonData = json_encode($post->getAll(), JSON_PRETTY_PRINT);
        $response->getBody()->write('<pre>' . $jsonData . '</pre>');
        return $response->withHeader('Content-Type', 'text/html');
    });

    $app->get('/comments/', function (Request $request, Response $response) {
        $comment = new Model\Comment();
        $jsonData = json_encode($comment->getAll(), JSON_PRETTY_PRINT);
        $response->getBody()->write('<pre>' . $jsonData . '</pre>');
        return $response->withHeader('Content-Type', 'text/html');
    });


    $app->get('/posts/{post_id}/comments', function (Request $request, Response $response, $args) {
        $comment = new Model\Comment();

        $postID = $args['post_id'];


        $jsonData = json_encode($comment->getPostComment($postID), JSON_PRETTY_PRINT);
        $response->getBody()->write('<pre>' . $jsonData . '</pre>');
        return $response->withHeader('Content-Type', 'text/html');
    });





};
