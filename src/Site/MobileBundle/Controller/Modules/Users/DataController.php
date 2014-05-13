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

    /**
     * @Route("/getRecord")
     */
    public function getRecordAction () {
        $id = '5371090830d8660896d63af1';
        $user = $this->get('doctrine_mongodb')
            ->getRepository('SiteStoreBundle:Users')
            ->find($id);

        if (!$user) {
            throw $this->createNotFoundException('No product found for id '.$id);
        }
        else {
            return new Response($user->getName());
        }
    }

    /**
     * @Route("/getRecordByName")
     */
    public function getRecordByNameAction () {
        $name = 'Core';
        $repository = $this->get('doctrine_mongodb')
            ->getManager()
            ->getRepository('SiteStoreBundle:Users');
        $users = $repository->findBy(
            array('name' => $name),
            array('age', 'ASC')
        );
        if (!$users) {
            throw $this->createNotFoundException('No User found for name '.$name);
        }
        else {
            return new Response('get user with name :'.' '.$users[0]->getName());
        }
    }
}