<?php

namespace App\Controller;

use App\Repository\TagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/tags")
 */
class TagController extends AbstractController
{
    /**
     * @Route("/search", name="tag_search", methods={"GET"})
     */
    public function search(Request $request, TagRepository $tagRepository)
    {
        $query = $request->query->get('q');
        $tags = array_map(function ($tag){ return $tag->getName(); }, $tagRepository->searchByName($query));

        return $this->json($tags);
    }
}