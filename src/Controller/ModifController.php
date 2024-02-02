<?php

namespace App\Controller;

use ApiPlatform\Validator\ValidatorInterface;
use App\Entity\Employe;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
class ModifController extends AbstractController
{
    private $hasher;
    private $em;
    private $validator;


    public function __construct(UserPasswordHasherInterface $hasher, EntityManagerInterface $em, ValidatorInterface $validator){
        $this->hasher = $hasher;
        $this->em = $em;
        $this->validator = $validator;
    }

    #[Route(
        name: 'modif',
        path: '/api/modif/{id}',
        methods: ['PUT'],
        defaults: [
            '_api_resource_class' => Employe::class,
            '_api_operation_name' => '/api/modif/{id}',
        ],
    )]
    public function __invoke(Employe $employe): Employe
    {
        $employe->setPassword($this->hasher->hashPassword($employe, $employe->getPassword()));
        $employe->setUsername($employe->getUsername());
        $employe->setNom($employe->getNom());
        $employe->setPrenom($employe->getPrenom());
        $employe->setRoles(['ROLE_USER']);
        $this->validator->validate($employe);
        $this->em->persist($employe);
        $this->em->flush();
        return $employe;
    }
}
