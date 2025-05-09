<?php

namespace User\Infrastructure\Symfony\Http\Action;

use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use User\Application\Service\AuthCodeVerificationService;

#[Route('/api/auth/verify', name: 'auth.verify', methods: ['POST'])]
final class AuthVerifyAction extends AbstractController
{
    public function __construct(
        private readonly AuthCodeVerificationService $authCodeVerificationService
    ) {}

    public function __invoke(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $phoneCode = $data['phone_code'] ?? null;
        $phoneNumber = $data['phone_number'] ?? null;
        $code = $data['code'] ?? null;

        if (!$phoneCode || !$phoneNumber || !$code) {
            return $this->json(['error' => 'Missing parameters'], Response::HTTP_BAD_REQUEST);
        }

        try {
            $user = $this->authCodeVerificationService->verify($phoneCode, $phoneNumber, $code);
        } catch (Exception $e) {
            return $this->json(['error' => 'Code verification failed'], Response::HTTP_BAD_REQUEST);
        }

        return $this->json([
            'id' => $user->getId()->toString(),
            'name' => $user->getName(),
        ]);
    }
}
