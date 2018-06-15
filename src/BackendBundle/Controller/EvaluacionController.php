<?php

namespace BackendBundle\Controller;

use BackendBundle\Entity\Evaluacion;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;


/**
 * Evaluacion controller.
 *
 * @Route("evaluacion")
 */
class EvaluacionController extends Controller
{
    /**
     * Lists all evaluacion entities.
     *
     * @Route("/", name="evaluacion_index")
     * @Method("GET")
     */
    public function indexAction()
    {
		$em = $this->getDoctrine()->getManager();
		$evaluacions = $em->getRepository('BackendBundle:Evaluacion')->findAll();
		$data = $this->get('jms_serializer')->serialize($evaluacions, 'json');
		
        return new JsonResponse(json_decode($data, Response::HTTP_CREATED));
    }

    /**
     * Creates a new evaluacion entity.
     *
     * @Route("/", name="evaluacion_new")
     * @Method({"POST"})
     */
    public function newAction(Request $request)
    {
		try{
			$data = $request->getContent();
			if($this->isJson($data)){
				$evaluacion = $this->get('jms_serializer')
									->deserialize($data, 'BackendBundle\Entity\Evaluacion', 'json');
				$em = $this->getDoctrine()->getManager();
				$em->persist($evaluacion);
				$em->flush();
				return new JsonResponse([
					'ok'=>true,
					'evaluation'=>json_decode($data)
				], Response::HTTP_CREATED);
			}
			return new JsonResponse([
				'ok'=>false,
				'msg'=>'Malformed Json'
			], Response::HTTP_BAD_REQUEST);
		}catch(Exception $e){
			return new JsonResponse([
				'ok'=>false,
				'err'=>json_decode($e)
			], Response::HTTP_INTERNAL_ERROR_SERVER0);
		}
		
    }

    /**
     * Finds and displays a evaluacion entity.
     *
     * @Route("/{id}", name="evaluacion_show")
     * @Method("GET")
     */
    public function showAction(Evaluacion $evaluacion)
    {
        $deleteForm = $this->createDeleteForm($evaluacion);

        return $this->render('evaluacion/show.html.twig', array(
            'evaluacion' => $evaluacion,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing evaluacion entity.
     *
     * @Route("/{id}", name="evaluacion_edit")
     * @Method({"PUT"})
     */
    public function editAction(Request $request, Evaluacion $evaluacion)
    {
        $deleteForm = $this->createDeleteForm($evaluacion);
        $editForm = $this->createForm('BackendBundle\Form\EvaluacionType', $evaluacion);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('evaluacion_edit', array('id' => $evaluacion->getId()));
        }

        return $this->render('evaluacion/edit.html.twig', array(
            'evaluacion' => $evaluacion,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a evaluacion entity.
     *
     * @Route("/{id}", name="evaluacion_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Evaluacion $evaluacion)
    {
        $form = $this->createDeleteForm($evaluacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($evaluacion);
            $em->flush();
        }

        return $this->redirectToRoute('evaluacion_index');
    }

    /**
     * Creates a form to delete a evaluacion entity.
     *
     * @param Evaluacion $evaluacion The evaluacion entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Evaluacion $evaluacion)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('evaluacion_delete', array('id' => $evaluacion->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
	}
	
	public function isJson($string){
		json_decode($string);
		return (json_last_error() == JSON_ERROR_NONE);
	}
}
