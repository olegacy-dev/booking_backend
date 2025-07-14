<?php

namespace User\Infrastructure\Symfony\Http\Action;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use User\Domain\Model\User;
use User\Domain\Repository\UserRepositoryInterface;
use User\Infrastructure\Security\JwtUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/api/me', name: 'user.me', methods: ['GET'])]
final class GetMeAction extends AbstractController
{
    public function __construct(
      private readonly UserRepositoryInterface $userRepository
    ) {
    }

    public function __invoke(UserInterface $user): Response
    {
        if (!$user instanceof JwtUser) {
            return $this->json(['error' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
        }

        $userId = $user->getUserIdentifier();

        $domainUser = $this->userRepository->findById($userId);

        if (!$domainUser instanceof User) {
            return $this->json(['error' => 'User was not found'], Response::HTTP_UNAUTHORIZED);
        }

        return $this->json([
            'id' => $domainUser->getId()->toString(),
            'name' => $domainUser->getName(),
        ]);
    }
}
