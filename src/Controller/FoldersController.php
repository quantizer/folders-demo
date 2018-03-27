<?php

namespace App\Controller;

use App\Entity\Folder;
use App\Entity\User;
use FOS\RestBundle\Controller\Annotations as FOSRest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
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
     * @FOSRest\Get("/folder/all")
     */
    public function allFolders()
    {
        $user = $this->getUser();
        $folders = $this->getDoctrine()->getRepository(Folder::class)->getAllRootFoldersByUser($user);

        return View::create($folders, Response::HTTP_OK, []);
    }

    /**
     * Create new folder.
     *
     * @param Request $request
     *
     * @return View
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
        $parentId = $request->request->get('parent_folder_id');

        if ($folderName) {
            $escapedFolderName = htmlspecialchars($folderName);

            $folder = new Folder();
            $folder->setName($escapedFolderName);
            $folder->setOwner($user);

            $entityManager = $this->getDoctrine()->getManager();

            if ($parentId) {
                $parentFolder = $entityManager->getRepository(Folder::class)->find($parentId);

                if (!$parentFolder) {
                    throw new BadRequestHttpException();
                }

                $folder->setParent($parentFolder);
            }

            $entityManager->persist($folder);
            $entityManager->flush();

            $folders = $this->getDoctrine()->getRepository(Folder::class)->getAllRootFoldersByUser($user);

            return View::create($folders, Response::HTTP_OK, []);
        }

        throw new BadRequestHttpException();
    }
}
