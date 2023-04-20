<?php
namespace App\Controller\Admin;

use App\Entity\Option;
use App\Entity\Property;
use App\Form\PropertyType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminPropertyController extends AbstractController 
{
    protected $em;

    /**
     * @var PropertyRepository
     * @var EntityManagerInterface
     */
    private $repository;

    public function __construct(PropertyRepository $repository,EntityManagerInterface $entitymanager)
    {
        $this->repository = $repository;
        $this->em = $entitymanager;
    }
   
    #[Route('/admin', name:'admin.property.index')]
    public function index()
    {
        $properties = $this->repository->findAll();
        return $this->render('admin/property/index.html.twig', compact('properties'));
    }

    #[Route('/admin/property/create', name:'admin.property.new')]
    public function new(Request $request)
    {
        $property = new Property();
        $form = $this->createForm(PropertyType::class, $property);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($property);
            $this->em->flush();
            // Permet d'afficher un message
            $this->addFlash('success', 'Création du bien avec succés');
            return $this->redirectToRoute('admin.property.index');
        }

        return $this->render('admin/property/new.html.twig', [
            'property' => $property,
            'form' => $form->createView()
        ]);
    }

    /**
     * @param Property $property
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    #[Route('/admin/property/{id}', name:'admin.property.edit', methods:['GET','POST'])]
    public function edit(Property $property, Request $request)
    {
        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            // Permet d'afficher un message
            $this->addFlash('success', 'Bien modifié avec succés');
            return $this->redirectToRoute('admin.property.index');
        }

        return $this->render('admin/property/edit.html.twig', [
            'property' => $property,
            'form' => $form->createView()
        ]);
    }

    #[Route('/admin/property/{id}', name:'admin.property.delete', methods:['DELETE'])]
    public function delete(Property $property, Request $request)
    {
        // Permet de ne pas etre piraté, chaque champ ou ligne en BDD a un token, donc il va supprimer
        // si le token est ok
        if($this->isCsrfTokenValid('delete'. $property->getID(), $request->get('_token'))){
            $this->em->remove($property);
            $this->em->flush();
            // Permet d'afficher un message
            $this->addFlash('success', 'Bien supprimé avec succés');
        };
        return $this->redirectToRoute('admin.property.index');

    }

}