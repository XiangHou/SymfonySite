<?php

namespace Site\MobileBundle\Controller\Modules\Users;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Site\StoreBundle\Document\Users;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DataController extends Controller
{
    /**
     * @Route("/addOne")
     */
    public function addOneAction () {
        $user = new Users();
        $user->setName('Core');
        $user->setAge(28);
        $user->setLanguage('ch');
        $user->setPassword('123456');

        $dm = $this->get('doctrine_mongodb')->getManager();
        $dm->persist($user);
        $dm->flush();

        return new Response('Created user id '.$user->getId());
    }
}