<?php

namespace App\Repository;

use App\Entity\Folder;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Folder|null find($id, $lockMode = null, $lockVersion = null)
 * @method Folder|null findOneBy(array $criteria, array $orderBy = null)
 * @method Folder[]    findAll()
 * @method Folder[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FolderRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Folder::class);
    }

    /**
     * @param User $user
     *
     * @return array|Folder[]|ArrayCollection
     */
    public function getAllRootFoldersByUser(User $user)
    {
        return $this->createQueryBuilder('f')
            ->where('f.parent IS NULL')
            ->andWhere('f.owner = :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->getResult();
    }
}
