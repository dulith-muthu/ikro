<?php
/**
 * Created by PhpStorm.
 * User: shan
 * Date: 2/5/17
 * Time: 12:08 AM
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Users;
use AppBundle\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class UserController extends BaseController
{
    /**
     * @Route("/register", name="register")
     */
    public function registerAction(Request $request)
    {
        $user = new Users();
        $form = $this->createForm(UserType::class, $user);
        $form->remove('role');

        $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()) {
            $date = new \DateTime();
            $encoder = $this->container->get('security.password_encoder');
            $encoded = $encoder->encodePassword($user, $form->get('password')->getData());
            $user->setPassword($encoded);
            $role = $this->getRepository('Roles')->findOneBy(array('metacode' => 'ROLE_CASHIER'));
            $user->setRole($role);
            $user->setIsactive(0);
            $user->setCreatedAt($date);
            $user->setUpdatedAt($date);

            $this->insert($user);
            $this->addFlash(
                'success',
                'User created successfully. Admin should activate it'
            );

            return $this->redirectToRoute('adminLogin');
        }

        return $this->render('user/register.html.twig', array(
            'form' => $form->createView()
        ));

    }

    /**
     * @Route("admin/users/approve" , name ="userApprove")
     */

    public function userApproveAction(Request $request)
    {

        $inactiveUsers = $this->getDoctrine()->getRepository('AppBundle:Users')->findBy(array('isactive' => '0'));
        return $this->render('user\listInactiveUsers.html.twig', array('inactiveUsers' => $inactiveUsers));
    }

    /**
     * @Route("admin/users/approve/userActive/{id}", name="userActive")
     */
    public function UserActive($id, Request $request)
    {
        $this->getRepository('Users')->find($id);
        $InactiveUser = $this->getDoctrine()->getRepository('AppBundle:Users')->find($id);
        $InactiveUser->setIsactive(1);
        $this->insert($InactiveUser);
        $this->addFlash('Activated', 'User Activated');

        return $this->redirectToRoute('userApprove');
    }
}