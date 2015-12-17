<?php
namespace AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Device;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
/**
 * Event controller.
 *
 * @Route("/register")
 */
class RegistrationController extends Controller
{
    /**
      * create or update a device (the ID is email field)
     * @Route("/create")
     */
     public function createAction(Request $request)
     {
         $lastName =  $request->request->get('lastname');
         $firstName = $request->request->get('firstname');
         $email = $request->request->get('email');
         $deviceToken = $request->request->get('deviceToken');
         $deviceId = $request->request->get('deviceId');

/*
         DEBUG

         $lastName =  'lastname';
         $firstName = 'firstname';
         $email = 'kammoun.salem@gmail.com';
         $deviceToken = 'deviceToken';
         $deviceId = 'deviceId';
*/

         $device = New Device();
         $device->setLastname($lastName);
         $device->setFirstname($firstName);
         $device->setEmail($email);
         $device->setDeviceToken($deviceToken);
         $device->setDeviceId($deviceId);


           $em = $this->getDoctrine()->getManager();
           $entity = $em->getRepository('AppBundle:Device')->findOneBy(array('deviceId' => $deviceId));
         if(!$entity){
                 $em->persist($device);
                 $em->flush();
                 $return = array('registerResponse' =>$deviceId);
         }else{
             $entity->setDeviceToken($deviceToken);
             $em->merge($entity);
             $em->flush();
             $return = array('registerResponse' => "ok-update");
         }

         if( $email!="" && !$device->getEmailconfirmed() ){

                    $device->setEmailconfirmed();

                          $message = \Swift_Message::newInstance()
                              ->setSubject('Hello Email')
                              ->setFrom('kammoun.salem@gmail.com')
                              ->setTo($email)
                              ->setBody(
                                  $this->renderView(
                                      // app/Resources/views/Emails/registration.html.twig
                                      'Emails/registration.html.twig',
                                      array('entity'=>$device)
                                  ),
                                  'text/html'
                              )
                              /*
                               * If you also want to include a plaintext version of the message
                              ->addPart(
                                  $this->renderView(
                                      'Emails/registration.txt.twig',
                                      array('name' => $name)
                                  ),
                                  'text/plain'
                              )
                              */
                          ;
                          $this->get('mailer')->send($message);
         }
         return new JsonResponse( $return );


     }


     /**
       * create or update a device (the ID is email field)
       * @Route("/activateemail/{deviceId}", name="activateemail")
       * @Template()
      */
      public function activateemailAction($deviceId)
      {

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppBundle:Device')->findOneBy(array('deviceId' => $deviceId));

        if( $entity->getEmailconfirmed() ){


        }else{
            $entity->setEmailconfirmed( new \DateTime() );
            $em->persist($entity);
            $em->flush();
        }

        return array();

      }
}
