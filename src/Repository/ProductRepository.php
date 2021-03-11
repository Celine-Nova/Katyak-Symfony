<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

  // je récupère les produits par le  nom de la catégory ex 'Bâteau'
    public function findByCategoryName($boats){
        $query = $this->createQueryBuilder('p')
            // ->from('Product', 'p')
            ->join('p.category', 'c')
            ->addSelect('c')
            ->where('c.name = :boats')
            ->setParameter('boats', $boats);
            
        return $query->getQuery()->getResult();
    }

     // je récupère les produits par le  nom du type ex 'Mer, Moteur'
     public function findByTypeName($type){
        $query = $this->createQueryBuilder('p')
            // ->from('Product', 'p')
            ->join('p.type', 't')
            ->addSelect('t')
            ->where('t.name = :boats')
            ->setParameter('boats', $type);
            
        return $query->getQuery()->getResult();
    }
  
    // /**
    //  * @return Product[] Returns an array of Product objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Product
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
