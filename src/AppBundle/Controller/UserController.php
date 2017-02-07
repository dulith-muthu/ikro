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
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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

        $inactiveUsers = $this->getRepository('Users')->findBy(array('isactive' => '0'));
        return $this->render('user\listInactiveUsers.html.twig', array(
            'inactiveUsers' => $inactiveUsers,
            'tab' => $this->inactiveUserList
        ));
    }

    /**
     * @Route("admin/users/approve/userActive/{id}", name="userActive")
     */
    public function UserActive($id, Request $request)
    {
        $this->getRepository('Users')->find($id);
        $InactiveUser = $this->getRepository('Users')->find($id);
        $InactiveUser->setIsactive(1);
        $this->insert($InactiveUser);
        $this->addFlash('success', 'User Activated');

        return $this->redirectToRoute('userApprove');
    }

    /**
     * @Route("admin/users/list" , name ="userList")
     */

    public function userList(Request $request)
    {

        $users = $this->getRepository('Users')->findAll();
        return $this->render('user\Users.html.twig', array(
            'users' => $users,
            'tab' => $this->users
        ));
    }

    /**
     * @Route("admin/users/account" , name ="userAccount")
     */

    public function userAccount(Request $request)
    {
        $id= $this->get('security.context')->getToken()->getUser()->getId();

        $user = $this->getRepository('Users')->find($id);
        return $this->render('user\userAccount.html.twig', array(
            'user' => $user,
            'tab' => $this->user
        ));
    }

    /**
     * @Route("admin/users/account/update", name="updateAccount")
     */
    public function EditAction(Request $request)
    {
        $id= $this->get('security.context')->getToken()->getUser()->getId();
        $user = $this->getRepository('Users')->find($id);

        $form = $this->createFormBuilder($user)
            ->add('username', TextType::class, array('attr' => array('class' => 'mdl-textfield__input', 'style' => 'margin:10px 0 30px 50px')))
            ->add('email', EmailType::class, array('attr' => array('class' => 'mdl-textfield__input', 'style' => 'margin:10px 0 30px 50px')))
            ->add('password', PasswordType::class, array('attr' => array('class' => 'mdl-textfield__input', 'style' => 'margin:10px 0 30px 50px')))
            ->add('save', SubmitType::class, array('label'=>'Update','attr' => array('class' => 'mdl-button mdl-js-button mdl-button--raised', 'style' => 'margin-top:20px')))
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            //get submitted data
            $username = $form['username']->getData();
            $email = $form['email']->getData();
            $password = $form['password']->getData();
            $now = new\DateTime('now');

            $user->setUsername($username);
            $user->setEmail($email);
            $user->setPassword($password);
            $user->setUpdatedAt($now);

            $this->insert($user);
            
            return $this->redirect('../account');

        }

        return $this->render('user/UpdateUserAccount.html.twig', array('tab' => $this->user, 'form' => $form->createView()));
    }
}