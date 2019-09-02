<?php

namespace App\Repository;

use App\Entity\Activity;
use App\Entity\ActivityCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Activity|null find($id, $lockMode = null, $lockVersion = null)
 * @method Activity|null findOneBy(array $criteria, array $orderBy = null)
 * @method Activity[]    findAll()
 * @method Activity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActivityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Activity::class);
    }

    public function getActivities($pagination = null, $offset = null, $priceOrder = 'ASC')
    {
        return $this->prepareActivitiesForResult($this->findBy([], ['price' => $priceOrder], $pagination, $offset));
    }

    public function getPopularActivities($popular = 0, $pagination = null, $offset = null, $priceOrder = 'ASC')
    {
        return $this->prepareActivitiesForResult($this->findBy(['popular' => $popular], ['price' => $priceOrder], $pagination, $offset));
    }

    public function getByCategory($category, $pagination = null, $offset = null, $priceOrder = 'ASC')
    {
        $qb = $this->createQueryBuilder('a')
            ->join('a.activity', 'acl', 'a.id = acl.activity_id')
            ->join('acl.category', 'ac', 'acl.category_id = ac.id')
            ->andWhere('ac.name = :category')
            ->orderBy(':priceOrder', 'a.price')
            ->setParameter('category', $category)
            ->setMaxResults(':pagination')
            ->setFirstResult(':offset')
            ->setParameter('priceOrder', $priceOrder)
            ->setParameter('pagination', $pagination)
            ->setParameter('offset', $offset)
            ->getQuery();

        $value = $qb->execute();

        return $this->prepareActivitiesForResult($value);
    }


    public function getByMaxPrice($maxprice, $pagination = null, $offset = null, $priceOrder = 'ASC')
    {
        $qb = $this->createQueryBuilder('a')
            ->andWhere('a.price <= :maxprice')
            ->setParameter('maxprice', $maxprice)
            ->orderBy(':priceOrder', 'a.price')
            ->setMaxResults(':pagination')
            ->setFirstResult(':offset')
            ->setParameter('priceOrder', $priceOrder)
            ->setParameter('pagination', $pagination)
            ->setParameter('offset', $offset)
            ->getQuery();

        $value = $qb->execute();

        return $this->prepareActivitiesForResult($value);
    }

    private function prepareActivitiesForResult($activities)
    {
        $result = [];

        /** @var Activity $activity */
        foreach ($activities AS $key => $activity) {
            $result[$activity->getId()] = [
                'id' => $activity->getId(),
                'popular' => $activity->getPopular(),
                'name' => $activity->getName(),
                'description' => $activity->getDescription(),
                'price' => $activity->getPrice(),
                'images' => $activity->getImagesArray(),
                'category' => $activity->getCategoriesArray(),
            ];
        }

        return $result;
    }

    // /**
    //  * @return Activity[] Returns an array of Activity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Activity
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
