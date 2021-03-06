<?php

namespace App\Repository;

use App\Entity\Achat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Achat>
 *
 * @method Achat|null find($id, $lockMode = null, $lockVersion = null)
 * @method Achat|null findOneBy(array $criteria, array $orderBy = null)
 * @method Achat[]    findAll()
 * @method Achat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AchatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Achat::class);
    }

    public function supprimerTousProduits()
    {
        $connection = $this->getEntityManager()->getConnection();

        $sql = 'DELETE FROM achat';
        $requete = $connection->prepare($sql);

        $requete->executeStatement();
    }

    public function supprimerProduitsPris()
    {
        $connection = $this->getEntityManager()->getConnection();

        $sql = 'DELETE FROM achat WHERE pris = 1';
        $requete = $connection->prepare($sql);

        $requete->executeStatement();
    }
}
