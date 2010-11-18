<?php

namespace Application\SiteBundle\Entity;

use Symfony\Component\Validator\Constraints;
use Symfony\Component\Validator\Mapping\ClassMetadata;

/**
 * Site Contact Form
 */
class Contact
{
    /**
     * Contact message content. Body of the email.
     */
    public $content;

    /**
     * Email address of the person who contacts us.
     */
    public $email;

    /**
     * Full name of the person who contacts us.
     */
    public $name;

    /**
     * Contact message subject. Subject of the email.
     */
    public $subject;

	/**
	 * Captcha code. Verify person who contacts us is a human.
	 */
    //public $verifyCode; // TODO: add captcha

	/**
	 * Validators for this entity.
	 */
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('content', new Constraints\NotBlank());
        $metadata->addPropertyConstraint('content', new Constraints\MinLength(3));
        $metadata->addPropertyConstraint('email', new Constraints\NotBlank());
        $metadata->addPropertyConstraint('email', new Constraints\Email(array(
            //'message' => 'Please enter your email address.',
        )));
        $metadata->addPropertyConstraint('name', new Constraints\NotBlank());
        $metadata->addPropertyConstraint('subject', new Constraints\NotBlank());
        $metadata->addPropertyConstraint('subject', new Constraints\MinLength(2));
    }
}