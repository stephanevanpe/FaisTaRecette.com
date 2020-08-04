<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\InscriptionType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class AdminSecuController extends AbstractController
{
    /**
     * @Route("/inscription", name="inscription")
     */
    public function index(Request $request,ObjectManager $om)
    {
        $utilisateur = new Utilisateur();
        $form = $this ->createForm(InscriptionType::class,$utilisateur);

        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
            $om->persist($utilisateur);
            $om->flush();
            return $this->redirectToRoute("aliments");
        }

        return $this->render('admin_secu/inscription.html.twig',[
            "form" => $form -> createView()
        ]);
    }
}
