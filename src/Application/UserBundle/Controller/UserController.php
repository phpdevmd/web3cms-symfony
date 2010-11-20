<?php

namespace Application\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form;
use Application\UserBundle\Entity;

class UserController extends Controller
{
    /**
     * User login page
     * Display one simple form to authenticate visitor, and process it.
     */
    public function loginAction()
    {
        $login = new Entity\Login();

        $form = new Form\Form('login', $login, $this->container->getValidatorService());
        $form->add(new Form\CheckboxField('rememberMe'));
        $form->add(new Form\PasswordField('password'));
        $form->add(new Form\TextField('username'));

        if ('POST' === $this->get('request')->getMethod()) {
            $form->bind($this->get('request')->get('login'));

            if ($form->isValid()) {
                //  connect to db and authenticate

                $this->get('request')->getSession()->setFlash('topSummary', '<strong>{screenName}</strong>, you have been successfully logged in.');

                return $this->redirect($this->generateUrl('homepage')); // goto profile
            } else {
                $this->get('request')->getSession()->setFlash('topError', 'An error occured while validating this form.');
                $response = $this->render('UserBundle:User:login.php', array('form' => $form));
                // unset flash message so it does not show up on the next page load
                $this->get('request')->getSession()->setFlash('topError', null);

                return $response;
            }
        }

        return $this->render('UserBundle:User:login.php', array('form' => $form));
    }
}
