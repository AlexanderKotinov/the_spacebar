<?php

namespace App\Controller;

use App\Repository\CommentRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class CommentAdminController extends AbstractController
{
    public function index(CommentRepository $repository, Request $request, PaginatorInterface $paginator)
    {
        $q = $request->query->get('q');
//        $comments = $repository->findCommentsWithSearch($q);

        $queryBuilder = $repository->findCommentsWithSearch($q);
        $pagination = $paginator->paginate(
            $queryBuilder,
            $request->query->getInt('page', 1),
            3/*limit per page*/
        );

        return $this->render('comment_admin/index.html.twig', [
            'pagination' => $pagination
        ]);
    }
}