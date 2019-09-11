<?php declare(strict_types=1);

namespace AppBundle\Repository;

use AppBundle\Entity\AddressBook;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;
use Doctrine\ORM\Tools\Pagination\Paginator;

final class AddressBookRepository
{
    /**
     * @var EntityRepository
     */
    private $repository;

    /**
    * @var string
    */
    private $imagesDir;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $entityManager, string $imagesDir)
    {
        $this->em = $entityManager;
        $this->repository = $entityManager->getRepository(AddressBook::class);
        $this->imagesDir = $imagesDir;
    }

    public function find(int $id): ?AddressBook
    {
        return $this->repository->find($id);
    }

    public function makeRequest(AddressBook $addressBook):bool
    {
        try {
            $this->em->persist($addressBook);
            $this->em->flush();
        } catch (\Doctrine\DBAL\DBALException $e) {
            return false;
        }
        return true;
    }

    /**
     * Delete Entity
     */
    public function remove(AddressBook $addressBook):bool
    {
        try {
            $fileName = $addressBook->getPicture();
            $filesystem = new Filesystem();
            $filesystem->remove($this->imagesDir.'/'.$fileName);
            $this->em->remove($addressBook);
            $this->em->flush();
        } catch (\Doctrine\DBAL\DBALException $e) {
            return false;
        }
        return true;
    }

    /**
     *  Get all adresses for concrete page
     *
     * @param int $page
     * @param int $limit
     * @return \Doctrine\ORM\Tools\Pagination\Paginator
     */

    public function findListByPage(int $page = 1, int $limit): Paginator
    {
        $query = $this->repository->createQueryBuilder('p')
            ->orderBy('p.firstname', 'DESC')
            ->getQuery();

        $paginator = $this->paginate($query, $page, $limit);
        return $paginator;
    }

    /**
     * Paginator Helper
     *
     * @param Doctrine\ORM\Query $dql   DQL Query Object
     * @param integer            $page  Current page (defaults to 1)
     * @param integer            $limit The total number per page
     *
     * @return \Doctrine\ORM\Tools\Pagination\Paginator
     */

    public function paginate($dql, $page, $limit) : Paginator
    {
        $paginator = new Paginator($dql);
        $paginator->getQuery()
            ->setFirstResult($limit * ($page - 1))
            ->setMaxResults($limit);
        return $paginator;
    }
}
