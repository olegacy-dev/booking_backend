<?php

namespace User\Infrastructure\Symfony\Http\Action;

use InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Throwable;
use User\Application\Service\AuthCodeRequestService;

#[Route('/api/auth/request', name: 'auth.request', methods: ['POST'])]
final class AuthRequestAction extends AbstractController
{
    public function __construct(
        private readonly AuthCodeRequestService $authCodeRequestService
    ) {}

    public function __invoke(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $name = $data['name'] ?? null;
        $phoneCode = $data['phone_code'] ?? null;
        $phoneNumber = $data['phone_number'] ?? null;

        if (!$phoneCode || !$phoneNumber) {
            return $this->json(['error' => 'Missing parameters'], Response::HTTP_BAD_REQUEST);
        }

        try {
            $this->authCodeRequestService->request($name, $phoneCode, $phoneNumber);
        } catch (InvalidArgumentException $e) {
            return $this->json(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        } catch (Throwable $e) {
            return $this->json(['error' =>'Failed to send verification code'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->json(null, Response::HTTP_NO_CONTENT);
    }
}
