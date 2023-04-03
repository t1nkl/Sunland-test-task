<?php

namespace App\Controller;

use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use LogicException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    /**
     * @param  Request  $request
     * @param  JWTTokenManagerInterface  $jwtManager
     * @return JsonResponse
     */
    #[Route(path: '/api/v1/login', name: 'api_v1_app_login', methods: ['POST'])]
    public function login(
        Request $request,
        JWTTokenManagerInterface $jwtManager
    ): JsonResponse {
        $email = $request->request->get('email');

        $token = $jwtManager->create([
            'username' => $email, // you can add more payload data here
        ]);

        return new JsonResponse(['token' => $token]);
    }

    /**
     * @return void
     */
    #[Route(path: '/api/v1/logout', name: 'api_v1_app_logout', methods: ['POST'])]
    public function logout(): void
    {
        throw new LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
