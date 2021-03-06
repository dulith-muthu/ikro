<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * CustomerRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CustomerRepository extends EntityRepository
{
    public function search($name,$address,$nic,$mobile,$fixed)
    {
        $qb = $this->createQueryBuilder('o');

        $qb->select('o');

        if($name != null & $name != ""){
            $qb->andWhere('o.name LIKE :name')
                ->setParameter('name',$name)
                ;
        }

        if($address != null & $address != ""){
            $qb->andWhere('o.address LIKE :address')
                ->setParameter('address',$address)
            ;
        }

        if($nic != null & $nic != ""){
            $qb->andWhere('o.nic LIKE :nic')
                ->setParameter('nic',$name)
            ;
        }

        if($mobile != null & $mobile != ""){
            $qb->andWhere('o.mobile LIKE :mobile')
                ->setParameter('mobile',$mobile)
            ;
        }

        if($fixed != null & $fixed != ""){
            $qb->andWhere('o.fixed LIKE :fixed')
                ->setParameter('fixed',$fixed)
            ;
        }


        ;
        return $qb->getQuery()->getResult();
    }


    public function getSuggestions($nic){
        $qb = $this->createQueryBuilder('o');

        $qb
            ->select('o')
            ->orWhere('o.nic LIKE :nic')
            ->setParameter('nic',$nic."%")
            ->setMaxResults(10)
        ;

        return $qb->getQuery()->getResult();

    }
}
