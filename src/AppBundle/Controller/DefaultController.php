<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Template()
     */
    public function indexAction(Request $request)
    {
    }

    /**
     * @Route("/new-article", name="homepage")
     * @Template()
     */
    public function newArticleAction(Request $request)
    {
        $article = new Article();
        $article2 = new Article();

        $article->setDescription('bla blal');
        $article->setTitle('bla blal');

        $article2->setDescription('bla blal');
        $article2->setTitle('bla blal');

        $manager = $this->getDoctrine()->getManager();

        $manager->persist($article);
        $manager->persist($article2);
        $manager->flush();

        return new Response($article->getId());
    }

    /**
     * @Route("/delete-article", name="homepage")
     * @Template()
     */
    public function deleteArticleAction(Request $request)
    {
        $manager = $this->getDoctrine()->getManager();

        $article = $manager->getRepository('AppBundle:Article')
            ->findOneByTitle('bla blal');

        $article->setTitle('new title');

//        $manager->remove($article);
        var_dump($article);
        die;
    }

    /**
     * @Route("/update-article/{id}")
     * @Template()
     */
    public function updateArticleAction($id, Request $request)
    {
        $manager = $this->getDoctrine()->getManager();

        $article = $manager->getRepository('AppBundle:Article')
            ->find($id);

        $article->setTitle('new title');
        $manager->flush();

        return new Response($article->getTitle());
    }

    /**
     * @Route("/repository-test")
     * @Template()
     */
    public function repositoryAction(Request $request)
    {
        $manager = $this->getDoctrine()->getManager();

        $article = $manager->getRepository('AppBundle:Article')
            ->findWithTitle('new title');

        var_dump($article);
        die;
    }
}
