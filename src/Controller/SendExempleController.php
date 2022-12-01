<?php

namespace App\Controller;

use App\Entity\Exemple;
use App\Form\SendExempleFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SendExempleController extends AbstractController
{
	private $manager;

	public function __construct(EntityManagerInterface $manager){
		$this->manager = $manager;
	}

    #[Route('/send-send-exemple', name: 'app_send_exemple')]
    public function index(Request $request, SluggerInterface $slugger): Response
    {
		$exemple = new Exemple();
		$form = $this->createForm(SendExempleFormType::class, $exemple);
		$form->handleRequest($request);
		$exemple->setCreatedAt(new \DateTimeImmutable());

		if($form->isSubmitted() && $form->isValid()){
			$videoFile = $form->get('video')->getData();

			if($videoFile){
				$newFilename = uniqid().'.'.$videoFile->guessExtension();

				try {
					$videoFile->move(
						$this->getParameter('app.path.videos'),
						$newFilename
					);
				} catch (FileException $e) {

				}

				$exemple->setVideo($newFilename);
			}

			$this->manager->persist($exemple);
			$this->manager->flush();
			$this->addFlash("succes", "Votre send-exemple a bien été envoyé");
		}

        return $this->render('send-exemple/index.html.twig', [
			'form' => $form->createView()
        ]);
    }
}
