<?php
namespace App\Controller;

use App\Entity\Property;
use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
use App\Repository\PropertyRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Bundle\FrameworkBundle\Controller\createForm;

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
    function index(ManagerRegistry $doctrine, PaginatorInterface $paginator,Request $request): Response
    {
        $search = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class, $search);
        $form->handleRequest($request);


        $properties = $paginator->paginate(
            $this->repository->findAllVisibleQuery($search),
            $request->query->getInt('page',1),
            12
        );

        return $this->render('property/index.html.twig', [
            'current_menu' => 'properties',
            'properties' => $properties,
            'form' => $form->createView()
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
