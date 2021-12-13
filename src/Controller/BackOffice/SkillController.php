<?php

namespace App\Controller\BackOffice;

use App\Entity\Skill;
use App\Repository\SkillRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\SkillType;

/**
 * @Route("/admin/skills")
 */
class SkillController extends AbstractController
{
    /**
     * @Route(name="skills_manage")
     * @param SkillRepository $skillrepo
     */
    public function manage(SkillRepository $skillrepo ): Response
    {
        $skills = $skillrepo->findAll();
        return $this->render('BackOffice/skill/manage.html.twig', [
            'skills' => $skills,
        ]);
    }

    /**
     * @Route("/create", name="create_skill")
     * @param Request $request
     * @return Response
     */
    public function create(Request $request, EntityManagerInterface $emi): Response
    {
        $skill = new Skill();

        $formSkill = $this->createForm(SkillType::class, $skill);
        $formSkill->handleRequest($request);
        
        if ($formSkill->isSubmitted() && $formSkill->isValid()) { 
            $emi->persist($skill);
            $emi->flush();
            $this->addFlash(
               'success',
               'La compétence a été ajoutée avec succés !'
            );
            return $this->redirectToRoute('skills_manage');
        }

        return $this->render('BackOffice/skill/createSkill.html.twig', [
            'formSkill' => $formSkill->createView(),
            'skill' => $skill
        ]);
    }
}
