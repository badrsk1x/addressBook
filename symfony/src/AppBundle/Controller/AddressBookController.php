<?php
declare(strict_types=1);
namespace AppBundle\Controller;

use AppBundle\Entity\AddressBook;
use AppBundle\Form\AddressBookType;
use AppBundle\Services\FileManager;
use AppBundle\Repository\AddressBookRepository;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Filesystem\Filesystem;

use Symfony\Component\HttpFoundation\File\File;

class AddressBookController extends Controller
{

    /**
     * @var AddressBookRepository
     * @access private
     */
    private $addressBookRepository;


    /**
     * @var FileManager
     * @access private
     */
    private $fileManager;

    /**
     * @var string
     * @access public
     */
    public $imagesDir;

    /**
     * @var int
     * @access public
     */
    public $pageLimit;
    
    public function __construct(
        string $imagesDir,
        int $pageLimit,
        AddressBookRepository $addressBookRepository,
        FileManager $fileManager
    ) {
        $this->addressBookRepository = $addressBookRepository;
        $this->fileManager = $fileManager;
        $this->imagesDir = $imagesDir;
        $this->pageLimit = $pageLimit;
    }

    /**
    * Add a new AddressBook entity.
    * @Route("/addressbook/add",name="AddAddressBook", methods={"GET","POST"})
    * @param Request $request
    * @param FileManager $fileManager
    * @return Response
    */
    public function InsertAction(Request $request):Response
    {
        $addressBook = new AddressBook();
        $form = $this->createForm(AddressBookType::class, $addressBook);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->handleAddressBookRequest($form, $addressBook, 'new');
            return $this->redirectToRoute('ReadAddressBook', array('page' => '1'));
        }
        return $this->render(
            '@App/AddressBook/addressbook.html.twig',
            [
                'form'=> $form->createView()
            ]
        );
    }

    /**
     * Edit an existing AdressBook entity.
     * @Route("/addressbook/{id}/edit", name="EditAddressBook", methods={"GET","POST"})
     * @param AddressBook $addressBook
     * @param request $request
     * @return Response
     */
    public function editAction(AddressBook $addressBook, Request $request):Response
    {
        $fileName = $addressBook->getPicture();
 
        if ($fileName && file_exists($this->imagesDir.'/'.$fileName)) {
            $file = new File($this->imagesDir.'/'.$fileName);
            $addressBook->setPicture($file);
        }

        $form = $this->createForm(AddressBookType::class, $addressBook);
        $form->handleRequest($request);
 
        if ($form->isSubmitted() && $form->isValid()) {
            $this->handleAddressBookRequest($form, $addressBook, 'edit');
            return $this->redirectToRoute('ReadAddressBook', array('page' => '1'));
        }

        return $this->render(
            '@App/AddressBook/addressbook.html.twig',
            [
                'form'=> $form->createView(),
                'picture'=>$fileName
            ]
        );
    }


    /**
    * Show AddressBook list
    * @Route("/addressbook/{page} ",name="ReadAddressBook",
    * defaults={"page": "1"}, methods="GET")
    * @param int $page
    * @return Response
    *
    */

    public function indexAction(int $page):Response
    {
        $addressBooks = $this->addressBookRepository->findListByPage($page, $this->pageLimit);
        $maxPages = ceil($addressBooks->count() / $this->pageLimit);
        return $this->render(
            '@App/AddressBook/addressBookList.html.twig',
            [
                'addressbooks'=> $addressBooks,
                'maxPages' => $maxPages,
                'curPage' => $page,
            ]
        );
    }


    /**
     * @Route("/addressbook/{id}/delete", name="DeleteAddressBook", methods={"GET","POST"})
     * @param AddressBook $addressBook
     * @return Response
     */
    public function deleteAction(AddressBook $addressBook):Response
    {
        $this->addressBookRepository->remove($addressBook);
        $this->addFlash('success', 'The entry was deleted successfully!');
        return $this->redirectToRoute('ReadAddressBook', array('page' => '1'));
    }

    

    /**
     * handle AddressBook form request
     * @param \Symfony\Component\Form\Form $form
     * @param  AddressBook $addressBook
     * @param FileManager $fileManager
     * @param string $type
     * @return bool
     */
    protected function handleAddressBookRequest(\Symfony\Component\Form\Form $form, AddressBook $addressBook, string $type):bool
    {
        $data = $form->getData();
        $fileEntered = $data->getPicture();

        if ($fileEntered) {
            try {
                if ($type=='edit') {
                    $filesystem = new Filesystem();
                    $filesystem->remove($this->imagesDir.'/'.$fileEntered);
                }

                $fileName = $this->fileManager->uploadFile($fileEntered);
                $data->setPicture($fileName);
            } catch (FileException $e) {
                $this->addFlash('error', 'The picture was not uploaded correctly!');
            }
        }

        $this->addressBookRepository->makeRequest($addressBook);
        
        $msg = ($type=='edit') ? 'The entry was modified!' : 'The new entry was added!';
        $this->addFlash('success', $msg);
        return true;
    }
}
