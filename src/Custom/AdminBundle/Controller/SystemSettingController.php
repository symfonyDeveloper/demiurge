<?php

namespace Custom\AdminBundle\Controller;

use Custom\AdminBundle\Entity\SystemSetting;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Systemsetting controller.
 *
 */
class SystemSettingController extends Controller
{
    /**
     * Lists all systemSetting entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $systemSettings = $em->getRepository('CustomAdminBundle:SystemSetting')->findAll();

        return $this->render('systemsetting/index.html.twig', array(
            'systemSettings' => $systemSettings,
        ));
    }

    /**
     * Creates a new systemSetting entity.
     *
     */
    public function newAction(Request $request)
    {
        $systemSetting = new Systemsetting();
        $form = $this->createForm('Custom\AdminBundle\Form\SystemSettingType', $systemSetting);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($systemSetting);
            $em->flush($systemSetting);

            return $this->redirectToRoute('syssetting_show', array('id' => $systemSetting->getId()));
        }

        return $this->render('systemsetting/new.html.twig', array(
            'systemSetting' => $systemSetting,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a systemSetting entity.
     *
     */
    public function showAction(SystemSetting $systemSetting)
    {
        $deleteForm = $this->createDeleteForm($systemSetting);

        return $this->render('systemsetting/show.html.twig', array(
            'systemSetting' => $systemSetting,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing systemSetting entity.
     *
     */
    public function editAction(Request $request, SystemSetting $systemSetting)
    {
        $deleteForm = $this->createDeleteForm($systemSetting);
        $editForm = $this->createForm('Custom\AdminBundle\Form\SystemSettingType', $systemSetting);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('syssetting_edit', array('id' => $systemSetting->getId()));
        }

        return $this->render('systemsetting/edit.html.twig', array(
            'systemSetting' => $systemSetting,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a systemSetting entity.
     *
     */
    public function deleteAction(Request $request, SystemSetting $systemSetting)
    {
        $form = $this->createDeleteForm($systemSetting);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($systemSetting);
            $em->flush($systemSetting);
        }

        return $this->redirectToRoute('syssetting_index');
    }

    /**
     * Creates a form to delete a systemSetting entity.
     *
     * @param SystemSetting $systemSetting The systemSetting entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(SystemSetting $systemSetting)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('syssetting_delete', array('id' => $systemSetting->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
