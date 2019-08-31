<?php
namespace AppBundle\Controller\Address;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use AppBundle\Entity\Address;

class AddController extends Controller
{

    /**
    * @Route("/address/add")
    */
    public function createAction(Request $request)
    {
        $address = new Address();
        $form = $this->createFormBuilder($address)
                     ->add('firstname', TextType::class)
                     ->add('save', SubmitType::class, array('label' => 'New Address'))
                     ->getForm();
  
        $form->handleRequest($request);
  
        if ($form->isSubmitted()) {
            $address = $form->getData();
  
            $em = $this->getDoctrine()->getManager();
            $em->persist($address);
            $em->flush();
  
            return $this->redirect('/address/' . $address->getId());
        }
  
        return $this->render(
            'address/edit.html.twig',
            array('form' => $form->createView())
      );
    }
}
