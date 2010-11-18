<?php

namespace Application\UserBundle\Entity;

use Symfony\Component\Validator\Constraints;
use Symfony\Component\Validator\Mapping\ClassMetadata;

/**
 * User Login Form
 * In future allow to login with username or email or any of these.
 */
class Login
{
    /**
     * Email - alternative field to login with.
     */
    public $email;

    /**
     * User password.
     */
    public $password;

	/**
     * Remember me - boolean, whether remember user authentication for later auto-login.
     */
    public $rememberMe;

    /**
     * Username - default field to login with.
     */
    public $username;

    /**
     * Username or Email - alternative field to login with.
     */
    public $usernameOrEmail;

	/**
	 * Validators for this entity.
	 */
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('password', new Constraints\NotBlank());
        $metadata->addPropertyConstraint('username', new Constraints\NotBlank());
    }
}