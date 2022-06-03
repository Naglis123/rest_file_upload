<?php

namespace App\Repository;

use App\Entity\UploadStatistics;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Exception;

/**
 * @extends ServiceEntityRepository<UploadStatistics>
 *
 * @method UploadStatistics|null find($id, $lockMode = null, $lockVersion = null)
 * @method UploadStatistics|null findOneBy(array $criteria, array $orderBy = null)
 * @method UploadStatistics[]    findAll()
 * @method UploadStatistics[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UploadStatisticsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UploadStatistics::class);
    }

    public function add(UploadStatistics $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(UploadStatistics $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return UploadStatistics[] Returns an array of UploadStatistics objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?UploadStatistics
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    /**
     * @throws Exception
     */
    public function findOneByIpAndDate(string $ipAddress, \DateTime $currentDay): ?UploadStatistics
    {
        $from = new \DateTime($currentDay->format("Y-m-d")." 00:00:00");
        $to   = new \DateTime($currentDay->format("Y-m-d")." 23:59:59");

        $qb = $this->createQueryBuilder('u');
        $qb
            ->andWhere('u.dateOfUploads BETWEEN :from AND :to')
            ->andWhere('u.clientIpAddress = :ipAddress')
            ->setParameter('from', $from )
            ->setParameter('to', $to)
            ->setParameter('ipAddress', $ipAddress)
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }
}
