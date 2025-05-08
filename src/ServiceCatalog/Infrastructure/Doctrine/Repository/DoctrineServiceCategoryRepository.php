<?php

namespace ServiceCatalog\Infrastructure\Doctrine\Repository;

use Doctrine\ORM\EntityManagerInterface;
use ServiceCatalog\Domain\Model\ServiceCategory;
use ServiceCatalog\Domain\Repository\ServiceCategoryRepositoryInterface;
use ServiceCatalog\Infrastructure\Doctrine\Entity\ServiceCategoryEntity;
use ServiceCatalog\Infrastructure\Doctrine\Entity\ServiceEntity;
use ServiceCatalog\Infrastructure\Doctrine\Mapper\ServiceCategoryMapper;

final readonly class DoctrineServiceCategoryRepository implements ServiceCategoryRepositoryInterface
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    /**
     * @return ServiceCategory[]
     */
    public function findAllWithActiveServices(): array
    {
        $qb = $this->em->createQueryBuilder();

        $qb
            ->select('DISTINCT c')
            ->from(ServiceCategoryEntity::class, 'c')
            ->innerJoin(ServiceEntity::class, 's', 'WITH', 's.categoryId=c.id')
            ->andWhere('s.isActive = true');

        $entities = $qb->getQuery()->getResult();

        return array_map(fn (ServiceCategoryEntity $serviceCategoryEntity) => ServiceCategoryMapper::toDomain($serviceCategoryEntity), $entities);
    }
}
