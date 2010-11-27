<?php

namespace Application\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form;
use Application\SiteBundle\Entity;

class SiteController extends Controller
{
    /**
     * Homepage
     */
    public function indexAction()
    {
        return $this->render('SiteBundle:Site:index.php');
    }

    /**
     * Contact us page
     * Display one simple form to contact site owner, and process it.
     */
    public function contactAction()
    {
        $contact = new Entity\Contact();

        $form = new Form\Form('contact', $contact, $this->container->getValidatorService());
        $form->add(new Form\TextField('name'));
        $form->add(new Form\TextField('email'));
        $form->add(new Form\TextField('subject'));
        $form->add(new Form\TextareaField('content'));

        if ('POST' === $this->get('request')->getMethod()) {
            $form->bind($this->get('request')->get('contact'));

            if ($form->isValid()) {
                $headers = "From: {$form['email']->getData()}\r\nReply-To: {$form['email']->getData()}";
                @mail($this->container->getParameter('adminEmailName').' <'.$this->container->getParameter('adminEmailAddress').'>', $form['subject']->getData(), $form['content']->getData(), $headers);

                $this->get('request')->getSession()->setFlash('topSummary', '<strong>Thank you</strong> for contacting us. We will respond to you as soon as possible.');

                // we need redirect for 2 reasons: reset form and avoid displaying flash message twice
                return $this->redirect($this->generateUrl('contact'));
            } else {
                //die($this->container->getValidatorService()->validate($form));
                $this->get('request')->getSession()->setFlash('topError', 'An error occured while validating this form.'); // При проверке данной формы произошла ошибка.
                $response = $this->render('SiteBundle:Site:contact.php', array('form' => $form));
                // unset flash message so it does not show up on the next page load
                $this->get('request')->getSession()->setFlash('topError', null);

                return $response;
            }
        }

        return $this->render('SiteBundle:Site:contact.php', array('form' => $form));
    }
}
