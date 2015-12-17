<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Publicite;
use AppBundle\Form\PubliciteType;

/**
 * Publicite controller.
 *
 * @Route("/publicite")
 */
class PubliciteController extends Controller
{

    /**
     * Lists all Publicite entities.
     *
     * @Route("/", name="publicite")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Publicite')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Publicite entity.
     *
     * @Route("/", name="publicite_create")
     * @Method("POST")
     * @Template("AppBundle:Publicite:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Publicite();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('publicite_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Publicite entity.
     *
     * @param Publicite $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Publicite $entity)
    {
        $form = $this->createForm(new PubliciteType(), $entity, array(
            'action' => $this->generateUrl('publicite_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Publicite entity.
     *
     * @Route("/new", name="publicite_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Publicite();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Publicite entity.
     *
     * @Route("/{id}", name="publicite_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Publicite')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Publicite entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Publicite entity.
     *
     * @Route("/{id}/edit", name="publicite_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Publicite')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Publicite entity.');
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
    * Creates a form to edit a Publicite entity.
    *
    * @param Publicite $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Publicite $entity)
    {
        $form = $this->createForm(new PubliciteType(), $entity, array(
            'action' => $this->generateUrl('publicite_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Publicite entity.
     *
     * @Route("/{id}", name="publicite_update")
     * @Method("PUT")
     * @Template("AppBundle:Publicite:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Publicite')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Publicite entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('publicite_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Publicite entity.
     *
     * @Route("/{id}", name="publicite_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Publicite')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Publicite entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('publicite'));
    }

    /**
     * Creates a form to delete a Publicite entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('publicite_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
