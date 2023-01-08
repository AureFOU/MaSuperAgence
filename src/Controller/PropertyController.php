<?php
namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController
{

    /*
     * @var PropertyRepository
     */
    private $repository;

    public function __construct(PropertyRepository $repository)
    {
        $this->repository = $repository;
    }

    #[Route('/biens', name:'property.index')]
function index(ManagerRegistry $doctrine): Response
    {
    $property = $this->repository->findAllVisible();
    dump($property);
    //$entityManager = $doctrine->getManager();
    //$property = $this->repository->findAllVisible();
    //$property[0] -> setSold(true);
    //$entityManager -> flush();

    /*$entityManager = $doctrine->getManager();
    $repository = $entityManager -> getRepository(Property::class);
    dump($repository);*/

    /*$entityManager = $doctrine->getManager();
    $property = new Property();
    $property-> setTitle('Mon premier bien')
    ->setPrice(200000)
    ->setRooms(4)
    ->setBedrooms(3)
    ->setDescription('Une petite description')
    ->setSurface(60)
    ->setFloor(4)
    ->setHeat(1)
    ->setCity('Montpellier')
    ->setAddress('15 Boulevard Gambetta')
    ->setPostalCode('34000');*/
    //$em = $this-> getDoctrine()-> getManager();
    //$em->persist($property);
    //$em->flush();
    /*$entityManager->persist($property);
    $entityManager->flush();*/

    return $this->render('property/index.html.twig', [
        'current_menu' => 'properties',
    ]);
}

#[Route('/biens/{slug}-{id}', name:'property.show', requirements:['slug' => '[\w\/\s.-]+'])]
function show(Property $property, $slug): Response
    {
    // Si on ajoute des lettres dans l'adresse URL ça permet de revenir au slug
    if ($property->getSlug() !== $slug) {
        return $this->redirectToRoute('property.show', [
            'id' => $property->getId(),
            'slug' => $property->getSlug(),
        ], 301);
    }

    return $this->render('property/show.html.twig', [
        'property' => $property,
        'current_menu' => 'properties',
    ]);
}
}
