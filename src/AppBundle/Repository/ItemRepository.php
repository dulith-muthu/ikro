<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ItemRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ItemRepository extends EntityRepository
{
    public function getSuggestions($itemCode){
        $qb = $this->createQueryBuilder('o');

        $qb
            ->select('o')
            ->orWhere('o.itemCode LIKE :itemCode')
            ->orWhere('o.name LIKE :itemCode')
            ->setParameter('itemCode',"%".$itemCode."%")
            ->setMaxResults(10)
        ;

        return $qb->getQuery()->getResult();

    }

    public function search($itemCode,$itemName,$itemType,$itemCount)
    {
        $qb = $this->createQueryBuilder('o');

        $qb->select('o');

        if($itemCode != null & $itemCode != ""){
            $qb->andWhere('o.itemCode LIKE :itemCode')
                ->setParameter('itemCode',$itemCode)
            ;
        }

        if($itemName != null & $itemName != ""){
            $qb->andWhere('o.name LIKE :name')
                ->setParameter('name',"%".$itemName."%")
            ;
        }

        if($itemType != null & $itemType != ""){
            $qb->andWhere('o.type = :type')
                ->setParameter('type',$itemType)
            ;
        }

        if($itemCount != null & $itemCount != ""){
            $qb->andWhere('o.availableStock <= :itemCount')
                ->setParameter('itemCount',$itemCount)
            ;
        }
        ;
        return $qb->getQuery()->getResult();
    }
}
