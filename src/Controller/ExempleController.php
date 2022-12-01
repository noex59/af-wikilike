<?php

namespace App\Controller;

use App\Repository\ExempleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExempleController extends AbstractController
{
	private $exempleRepository;

	public function __construct(ExempleRepository $exempleRepository){
		$this->exempleRepository = $exempleRepository;
	}

    #[Route('/exemples', name: 'app_exemple')]
    public function index(): Response
    {
		$exemples = $this->exempleRepository->findBy(['isValidated' => true], null, 10, null);

        return $this->render('exemple/index.html.twig', [
			'exemples' => $exemples
        ]);
    }
}
