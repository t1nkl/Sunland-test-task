<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;

class BaseController extends AbstractController
{
    /**
     * @param  CsrfTokenManagerInterface  $csrfTokenManager
     * @return Response
     */
    #[Route('/', name: 'app_base')]
    #[Route('/{vueRouting}', name: 'app_base_vueRouting', requirements: ['vueRouting' => '^(?!api|_(profiler|wdt)).*$'])]
    public function index(CsrfTokenManagerInterface $csrfTokenManager): Response
    {
        $csrfToken = $csrfTokenManager->getToken('authenticate')->getValue();

        return $this->render('base.html.twig', [
            'csrf_token' => $csrfToken,
        ]);
    }
}
