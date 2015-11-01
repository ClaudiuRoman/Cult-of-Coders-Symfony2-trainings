<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use AppBundle\Form\ArticleType;
use AppBundle\Form\TagType;
use Doctrine\ORM\EntityRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class DefaultController
 * @package AppBundle\Controller
 * @Route("/articles")
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage_main")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $manager = $this->getDoctrine()->getManager();

        $articles = $manager->getRepository('AppBundle:Article')->findAll();

        return [
            'articles' => $articles
        ];
    }

    /**
     * @Route("/new-article", name="asfasfasf")
     * @Template()
     */
    public function newArticleAction(Request $request)
    {
        $form = $this->createForm(new ArticleType());

        if ($form->handleRequest($request) && $form->isValid()) {
            $article = $form->getData();

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($article);

            $manager->flush();

            return $this->redirectToRoute('homepage_main');
        }

        return [
            'form' => $form->createView()
        ];
    }
    /**
     * @Route("/articles/{id}/edit", name="article_edit")
     * @Template()
     */
    public function editArticleAction($id, Request $request)
    {
        $article = $this->getDoctrine()
            ->getRepository('AppBundle:Article')
            ->find($id);

        $form = $this->createForm(new ArticleType(), $article);

        if ($form->handleRequest($request) && $form->isValid()) {
            $article = $form->getData();

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($article);

            $manager->flush();

            return $this->redirectToRoute('homepage_main');
        }

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route("/new-tag", name="new_tag")
     * @Template()
     */
    public function newTagAction(Request $request)
    {
        $form = $this->createForm(new TagType());

        if ($form->handleRequest($request) && $form->isValid()) {
            $tag = $form->getData();

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($tag);
            $manager->flush();

            return $this->redirectToRoute('homepage_main');
        }

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route("/delete-article", name="homepage")
     * @Template()
     */
    public function deleteArticleAction(Request $request)
    {
        $manager = $this->getDoctrine()->getManager();

        $article = $manager->getRepository('AppBundle:Article')
            ->find(1);

        $manager->remove($article);
        $manager->flush();
        die;
    }

    /**
     * @Route("/update-article/{id}")
     * @Template()
     */
    public function updateArticleAction($id, Request $request)
    {
        $manager = $this->getDoctrine()->getManager();

        /** @var EntityRepository $article */
        $repository = $manager->getRepository('AppBundle:Article');

        $article = $repository->find($id);

        $article->setTitle('altceva');

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
