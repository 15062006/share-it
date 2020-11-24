<?php

namespace App\Controller;

use Psr\Http\Message\ResponseInterface;

class HomeController extends AbstractController
{
    public function homepage(ResponseInterface $response)
    {
        return $this->template($response, 'homepage.html.twig');
    }
}
