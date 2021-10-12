<?php

declare(strict_types=1);

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

require dirname(__DIR__).'/config/bootstrap.php';

$request = Request::createFromGlobals();
$response = new Response(
    'Content',
    Response::HTTP_OK,
    ['content-type' => 'text/html']
);
$response->send();
