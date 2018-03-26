<?php

namespace App\Controller;

use App\Entity\Folder;
use App\Entity\User;
use FOS\RestBundle\Controller\Annotations as FOSRest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class FoldersController extends FOSRestController
{
    /**
     * Get all folders.
     *
     * @return View
     *
     * @Security("has_role('ROLE_USER')")
     *
     * @FOSRest\Get("/folder/all")
     */
    public function allFolders()
    {
        $folders = $this->getDoctrine()->getRepository(Folder::class)->findAll();

        return View::create($folders, Response::HTTP_OK, []);
    }

    /**
     * Create new folder.
     *
     * @param Request $request
     *
     * @return View
     *
     * @Security("has_role('ROLE_USER')")
     *
     * @FOSRest\Post("/folder/new")
     *
     * @throws BadRequestHttpException
     */
    public function create(Request $request)
    {
        /** @var User $user */
        $user = $this->getUser();

        $folderName = $request->request->get('folder_name');
        if ($folderName) {
            $escapedFolderName = htmlspecialchars($folderName);

            $folder = new Folder();
            $folder->setName($escapedFolderName);
            $folder->setOwner($user);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($folder);
            $entityManager->flush();

            return View::create($folder, Response::HTTP_OK, []);
        }

        throw new BadRequestHttpException();
    }
}
