<?php

namespace App\Controller;

use App\Entity\EmployeePosition;
use App\Form\EmployeePositionType;
use App\Repository\EmployeePositionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/employee_position")
 */
class EmployeePositionController extends AbstractController
{
    /**
     * @Route("/", name="app_employee_position_index", methods={"GET"})
     */
    public function index(EmployeePositionRepository $employeePositionRepository): Response
    {
        return $this->render('employee_position/index.html.twig', [
            'employee_positions' => $employeePositionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_employee_position_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EmployeePositionRepository $employeePositionRepository): Response
    {
        $employeePosition = new EmployeePosition();
        $form = $this->createForm(EmployeePositionType::class, $employeePosition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $employeePositionRepository->add($employeePosition, true);

            return $this->redirectToRoute('app_employee_position_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('employee_position/new.html.twig', [
            'employee_position' => $employeePosition,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_employee_position_show", methods={"GET"})
     */
    public function show(EmployeePosition $employeePosition): Response
    {
        return $this->render('employee_position/show.html.twig', [
            'employee_position' => $employeePosition,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_employee_position_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, EmployeePosition $employeePosition, EmployeePositionRepository $employeePositionRepository): Response
    {
        $form = $this->createForm(EmployeePositionType::class, $employeePosition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $employeePositionRepository->add($employeePosition, true);

            return $this->redirectToRoute('app_employee_position_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('employee_position/edit.html.twig', [
            'employee_position' => $employeePosition,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_employee_position_delete", methods={"POST"})
     */
    public function delete(Request $request, EmployeePosition $employeePosition, EmployeePositionRepository $employeePositionRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$employeePosition->getId(), $request->request->get('_token'))) {
            $employeePositionRepository->remove($employeePosition, true);
        }

        return $this->redirectToRoute('app_employee_position_index', [], Response::HTTP_SEE_OTHER);
    }
}
