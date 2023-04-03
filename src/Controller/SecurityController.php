<?php

namespace App\Controller;

use App\Validator\LoginValidator;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


class SecurityController extends AbstractController
{
    /**
     * @param  Request  $request
     * @param  AuthenticationUtils  $authenticationUtils
     * @param  JWTTokenManagerInterface  $jwtManager
     * @param  LoginValidator  $loginValidator
     * @return JsonResponse
     */
    #[Route(path: '/api/v1/login', name: 'api_v1_app_login', methods: ['POST'])]
    public function login(
        Request $request,
        AuthenticationUtils $authenticationUtils,
        JWTTokenManagerInterface $jwtManager,
        LoginValidator $loginValidator
    ): JsonResponse {
        $email = $request->request->get('email');

        $token = $jwtManager->create([
            'username' => $email, // you can add more payload data here
        ]);

        return new JsonResponse(['token' => $token]);
    }

    #[Route(path: '/api/v1/logout', name: 'api_v1_app_logout', methods: ['POST'])]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
