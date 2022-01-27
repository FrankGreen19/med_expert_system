<?php


namespace App\Entity;

use Doctrine\Persistence\ManagerRegistry;

class AbstractEntity
{
    protected function beforeSave() {}

    protected function save():self
    {
        $entityManager = $this->getDoctrine()->getManager();
    }

}