<?php


namespace App\Controller\Front;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/user/add", name="add_user")
     */
    public function addUser()
    {
         return $this->render('front/useradd.html.twig');
    }

    /**
     * @Route("/user/insert", name="insert_user")
     */                                                                                                                            // Utile pour remplacer la version dépréciée
    public function insertUser(EntityManagerInterface $entityManager, Request $request, UserPasswordEncoderInterface $encoder, UserPasswordHasherInterface $userPasswordHasher)
    {
        $user = new User();

        $email = $request->request->get('email');
        $role = ["ROLE_ADMIN"];
        $password = $request->request->get('password');
        $encoded = $encoder->encodePassword($user, $password);

        $user->setEmail($email);
        $user->setRoles($role);
        $user->setPassword($encoded);

        $entityManager->persist($user);
        $entityManager->flush();

        return $this->redirectToRoute('app_login');

            // Méthode avec Form de Symfony
        // $user = new User();
        // $userForm = $this->createForm(UserType::class, $user);
        // $userForm = handleRequest($request);

        // if($userForm->isSubmitted() && $userForm->isValid(){
        // user->setRoles(["ROLE_ADMIN"]);
        // $plainPassWord = $userForm->get('password')->getData();
        // $hashedPassword = $userPasswordHasher->hashPassword($user, $plainPassword);
        // $entityManager->persist($user);
        // $entityManager->flush();
        // return $this->redirectToRoute('admin_home');
        //}

        // return return $this->render('front/useradd.html.twig', ['userForm' => $userForm->createView()]);


    }


}