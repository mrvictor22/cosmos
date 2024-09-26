<?php
namespace App\Controller;

use App\Repository\SummaryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    #[Route('/api/summary', methods: ['GET'])]
    public function getSummary(SummaryRepository $summaryRepository): JsonResponse
    {
        $summaries = $summaryRepository->findAll();
        return $this->json($summaries);
    }
}
