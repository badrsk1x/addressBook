<?php
namespace AppBundle\Controller\Address;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use AppBundle\Entity\Address;

class ShowController extends Controller
{
    /**
     * @Route("/address")
    */
    public function showAction()
    {
        $addresses = $this->getDoctrine()
                          ->getRepository('AppBundle:Address')
                          ->findAll();
  
        return $this->render(
            'address/show.html.twig',
            array('addresses' => $addresses)
      );
    }
}
