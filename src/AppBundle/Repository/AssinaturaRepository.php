<?php

namespace AppBundle\Repository;

/**
 * AssinaturaRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AssinaturaRepository extends \Doctrine\ORM\EntityRepository
{


    public function getAssinaturasQueryBuilder()
    {
        return $this->createQueryBuilder('assinatura');
    }


}
