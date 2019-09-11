<?php
namespace AppBundle\Services;

use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileManager
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param UploadedFile $uploadedFile
     */
    public function uploadFile(UploadedFile $uploadedFile)
    {
        $fileName = $this->generateUniqueFileName() . '.' . $uploadedFile->guessExtension();

        $uploadedFile->move(
            $this->container->getParameter('images_dir'),
            $fileName
            );

        return $fileName;
    }


    /**
     * @return string
     */
    private function generateUniqueFileName() :string
    {
        return md5(uniqid());
    }
}
