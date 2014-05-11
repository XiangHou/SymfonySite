<?php

namespace Site\MobileBundle\Controller\Modules\Users;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ListController extends Controller
{
    public function allAction ($name) {
        return new Response('<html><body>Hello '.$name.'!</body></html>');
    }
}
