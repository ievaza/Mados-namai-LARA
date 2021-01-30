<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Outfit;
use App\Entity\Master;


class OutfitController extends AbstractController
{
    #[Route('/outfit', name: 'outfit_index', methods:['GET'])]
    public function index(): Response
    {
        $outfit = $this->getDoctrine()->
        getRepository(Outfit::class)->
        findAll();
        return $this->render('outfit/index.html.twig', [
            'outfit' => $outfit,
        ]);
    }
     #[Route('/outfit/create', name: 'outfit_create', methods:['GET'])]
    public function create(): Response
    {
        $master = $this->getDoctrine()->
        getRepository(Master::class)->
        findAll();

        return $this->render('outfit/create.html.twig',[
            'master' => $master,
        ]);
    }
    #[Route('/outfit/store', name: 'outfit_store', methods:['POST'])]
    public function store(Request $r): Response
    {
        $master = $this->getDoctrine()->
        getRepository(Master::class)->
        find($r->request->get('master_id'));

        $outfit = new Outfit;
        $outfit->
        setType($r->request->get('outfit_type'))->
        setColor($r->request->get('outfit_color'))->
        setSize($r->request->get('outfit_size'))->
        setAbout($r->request->get('outfit_about'))->
        setMaster($master);

        $enitytManager = $this->getDoctrine()->getManager();
        $enitytManager->persist($outfit);
        $enitytManager->flush();

        return $this->redirectToRoute('outfit_index');
    }
    #[Route('/outfit/edit/{id}', name: 'outfit_edit', methods:['GET'])]
    public function edit(int $id): Response
    {
        $outfit = $this->getDoctrine()->
        getRepository(Outfit::class)->
        find($id);

        $master = $this->getDoctrine()->
        getRepository(Master::class)->
        findAll();

         return $this->render('outfit/edit.html.twig', [
            'master' => $master,
            'outfit' => $outfit
        ]);
    }
    #[Route('/outfit/update/{id}', name: 'outfit_update', methods:['POST'])]
    public function update(Request $r,$id): Response
    {   
        $outfit = $this->getDoctrine()->
        getRepository(Outfit::class)->
        find($id);

        $outfit->
        setType($r->request->get('outfit_type'))->
        setColor($r->request->get('outfit_color'))->
        setSize($r->request->get('outfit_size'))->
        setAbout($r->request->get('outfit_about'))->
        setMasterId($r->request->get('master_id'));

        $enitytManager = $this->getDoctrine()->getManager();
        $enitytManager->persist($outfit);
        $enitytManager->flush();

        return $this->redirectToRoute('outfit_index');
    }
    #[Route('/outfit/delete/{id}', name: 'outfit_delete', methods:['POST'])]
    public function delete(int $id): Response
    {   
        $outfit = $this->getDoctrine()->
        getRepository(Outfit::class)->
        find($id);

        $enitytManager = $this->getDoctrine()->getManager();
        $enitytManager->remove($outfit);
        $enitytManager->flush();

        return $this->redirectToRoute('outfit_index');
    }

}
