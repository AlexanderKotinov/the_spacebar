<?php

namespace App\Controller;

use App\Repository\CommentRepository;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class CommentAdminController
 * @package App\Controller
 * @IsGranted("ROLE_ADMIN_COMMENT")
 */

class CommentAdminController extends AbstractController
{
    /**
     * @param CommentRepository $repository
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(CommentRepository $repository, Request $request, PaginatorInterface $paginator)
    {
        $q = $request->query->get('q');

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
