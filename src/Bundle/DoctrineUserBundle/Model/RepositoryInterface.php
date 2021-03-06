<?php

namespace Bundle\DoctrineUserBundle\Model;

interface RepositoryInterface
{
    /**
     * Get the Entity manager or the Document manager, depending on the db driver
     *
     * @return mixed
     **/
    public function getObjectManager();

    /**
     * Get the class of the User Entity or Document, depending on the db driver
     *
     * @return string a model fully qualified class name
     **/
    public function getObjectClass();

    /**
     * Get the identifier property of the Group
     *
     * @return string
     */
    public function getObjectIdentifier();
}
