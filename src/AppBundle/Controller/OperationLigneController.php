<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\OperationLigne;
use AppBundle\Form\OperationLigneType;

/**
 * OperationLigne controller.
 *
 * @Route("/operationligne")
 */
class OperationLigneController extends Controller
{

    /**
     * Lists all OperationLigne entities.
     *
     * @Route("/", name="operationligne")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:OperationLigne')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new OperationLigne entity.
     *
     * @Route("/", name="operationligne_create")
     * @Method("POST")
     * @Template("AppBundle:OperationLigne:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new OperationLigne();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('operationligne_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a OperationLigne entity.
     *
     * @param OperationLigne $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(OperationLigne $entity)
    {
        $form = $this->createForm(new OperationLigneType(), $entity, array(
            'action' => $this->generateUrl('operationligne_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new OperationLigne entity.
     *
     * @Route("/new", name="operationligne_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new OperationLigne();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a OperationLigne entity.
     *
     * @Route("/{id}", name="operationligne_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:OperationLigne')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find OperationLigne entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing OperationLigne entity.
     *
     * @Route("/{id}/edit", name="operationligne_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:OperationLigne')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find OperationLigne entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a OperationLigne entity.
    *
    * @param OperationLigne $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(OperationLigne $entity)
    {
        $form = $this->createForm(new OperationLigneType(), $entity, array(
            'action' => $this->generateUrl('operationligne_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing OperationLigne entity.
     *
     * @Route("/{id}", name="operationligne_update")
     * @Method("PUT")
     * @Template("AppBundle:OperationLigne:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:OperationLigne')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find OperationLigne entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('operationligne_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a OperationLigne entity.
     *
     * @Route("/{id}", name="operationligne_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:OperationLigne')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find OperationLigne entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('operationligne'));
    }

    /**
     * Creates a form to delete a OperationLigne entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('operationligne_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
