<?php
/**
 * Created by PhpStorm.
 * User: Lucups
 * Date: 13-12-23
 * Time: 下午5:58
 */

namespace Caiwen\CoreBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Caiwen\CoreBundle\Entity\User;
use Caiwen\CoreBundle\Entity\UserRepository;

/**
 * Class HomeController
 * @package Caiwen\CoreBundle\Controller\Admin
 * @Route("/admin")
 */
class HomeController extends Controller {

    /**
     * @Route("/index", name="_admin_index")
     * @Template()
     */
    public function indexAction() {
        $question_wait_num = $this->getDoctrine()->getRepository('CaiwenCoreBundle:Question')->getNumOfNotAnswered();
        return array(
            'question_wait_num' => $question_wait_num,
        );
    }

    /**
     * @Route("/login", name="_admin_login")
     * @Template()
     */
    public function loginAction() {
        $request = $this->getRequest();
        $session = $request->getSession();

        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                SecurityContext::AUTHENTICATION_ERROR
            );
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }
        $message = null;
        if ($error) $message = $this->get('translator')->trans($error->getMessage());
        return array(
            'error' => $error,
            'message' => $message,
        );
    }

    /**
     * @Route("/login_check", name="_admin_login_check")
     */
    public function loginCheckAction() {
    }

    /**
     * @Route("/logout", name="_admin_logout")
     */
    public function logoutAction() {
    }

    /**
     * @Route("/news-add", name="_admin_news_add")
     * @Template()
     */
    public function newsAddAction() {
        return array();
    }

    /**
     * @Route("/news-list", name="_admin_news_list")
     * @Template()
     */
    public function newsListAction() {
        $news_r = $this->getDoctrine()->getRepository('CaiwenCoreBundle:News');
        $newses = $news_r->findAll();
        return array(
            'newses' => $newses,
        );
    }

    /**
     * @Route("/docs-add", name="_admin_docs_add")
     * @Template()
     */
    public function docsAddAction() {
        return array();
    }

    /**
     * @Route("/docs-list", name="_admin_docs_list")
     * @Template()
     */
    public function docsListAction() {
        $docs_r = $this->getDoctrine()->getRepository('CaiwenCoreBundle:Docs');
        $docses = $docs_r->findAll();
        return array(
            'docses' => $docses,
        );
    }

    /**
     * @Route("/faq-list", name="_admin_faq_list")
     * @Template()
     */
    public function faqListAction() {
        $question_r = $this->getDoctrine()->getRepository('CaiwenCoreBundle:Question');
        $questions = $question_r->findAll();
        return array(
            'questions' => $questions,
        );
    }

    /**
     * @Route("/faq-wait", name="_admin_faq_wait")
     * @Template()
     */
    public function faqWaitAction() {
        $question_r = $this->getDoctrine()->getRepository('CaiwenCoreBundle:Question');
        $questions = $question_r->findQuestionsNotAnswered();
        return array(
            'questions' => $questions,
        );
    }

    /**
     * @Route("/photo-add", name="_admin_photo_add")
     * @Template()
     */
    public function photoAddAction() {
        return array();
    }

    /**
     * @Route("/photo-list/{album_id}", name="_admin_photo_list")
     * @Template()
     */
    public function photoListAction($album_id) {
        $photo_r = $this->getDoctrine()->getRepository('CaiwenCoreBundle:Photo');
        $photos = $photo_r->findByAlbumId($album_id);

        return array(
            'photos' => $photos,
        );
    }

}