<?php

namespace App\Controller;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Animals;

class AnimalsController extends AbstractController
{
    #[Route('/animals', name: 'animals')]
    public function index(): Response
    {
        $doctrine = $this->getDoctrine();
        $animals = $doctrine->getRepository('App:Animals')->findAll();

        // try getting column names
        $mappings = $doctrine->getManager()->getClassMetadata('App:Animals');
        $fieldnames = $mappings->getFieldNames();
        // dd($fieldNames);        

        return $this->render('animals/index.html.twig', array('animals'=>$animals, "fieldnames" => $fieldnames));
    }

    #[Route("/animals/create", name:"animals_create")]
    public function create(Request $request): Response
    {
        // Here we create an object from the class that we made
        $animals = new Animals;
        
        //* Here we will build a form using createFormBuilder and inside this function we will put our object and then we write add then we select the input type then an array to add an attribute that we want in our input field */
        $form = $this->createFormBuilder($animals)->add('name', TextType::class, array('attr' => array('class'=> 'form-control')))
        ->add('name', TextType::class, array('attr' => array('class'=> 'form-control my-1')))
        ->add('location', TextType::class, array('attr' => array('class'=> 'form-control my-1')))
        ->add('description', TextareaType::class, array('attr' => array('class'=> 'form-control my-1')))
        ->add('size', ChoiceType::class, array('choices'=>array('Small'=>'small', 'Large'=>'Large'),'attr' => array('class'=> 'form-control my-1')))
        ->add('age', NumberType::class, array('attr' => array('class'=> 'form-control my-1')))
        ->add('hobbies', TextType::class, array('attr' => array('class'=> 'form-control my-1')))
        ->add('breed', TextType::class, array('attr' => array('class'=> 'form-control my-1')))
        ->add('save', SubmitType::class, array('label'=> 'Add animal', 'attr' => array('class'=> 'btn-primary')))
        ->getForm();
        $form->handleRequest($request);

        /* Here we have an if statement, if we click submit and if  the form is valid we will take the values from the form and we will save them in the new variables */
        if($form->isSubmitted() && $form->isValid()){
            //fetching data
            // taking the data from the inputs by the name of the inputs then getData() function
            // status == FREE, DEFAULT IMAGE
            $name = $form['name']->getData();
            $location = $form['location']->getData();
            $description = $form['description']->getData();
            $size = $form['size']->getData();
            $age = $form['age']->getData();
            $hobbies = $form['hobbies']->getData();
            $breed = $form['breed']->getData();

            // Here we will get the current date
            $now = new \DateTime('now');

            /* these functions we bring from our entities, every column have a set function and we put the value that we get from the form */
            $animals->setName($name);
            $animals->setLocation($location);
            $animals->setDescription($description);
            $animals->setSize($size);
            $animals->setAge($age);
            $animals->setHobbies($hobbies);
            $animals->setBreed($breed);
            $animals->setStatus("Free");
            $animals->setPicture("animal.png");
            $em = $this->getDoctrine()->getManager();
            $em->persist($animals);
            $em->flush();
            $this->addFlash(
                    'notice',
                    'animals Added'
                    );
            return $this->redirectToRoute('animals');
        }

        /* now to make the form we will add this line form->createView() and now you can see the form in create.html.twig file  */
        return $this->render('animals/create.html.twig', array('form' => $form->createView()));
    }


    #[Route("/animals/edit/{id}", name:"animals_edit")]
    public function edit(Request $request, $id): Response
    {
        // Here we create an object from the class that we made
        $animals = $this->getDoctrine()->getRepository('App:Animals')->find($id);
        
        //* Here we will build a form using createFormBuilder and inside this function we will put our object and then we write add then we select the input type then an array to add an attribute that we want in our input field */
        $form = $this->createFormBuilder($animals)->add('name', TextType::class, array('attr' => array('class'=> 'form-control')))
        ->add('name', TextType::class, array('attr' => array('class'=> 'form-control my-1')))
        ->add('location', TextType::class, array('attr' => array('class'=> 'form-control my-1')))
        ->add('description', TextareaType::class, array('attr' => array('class'=> 'form-control my-1')))
        ->add('size', ChoiceType::class, array('choices'=>array('Small'=>'small', 'Large'=>'Large'),'attr' => array('class'=> 'form-control my-1')))
        ->add('age', NumberType::class, array('attr' => array('class'=> 'form-control my-1')))
        ->add('hobbies', TextType::class, array('attr' => array('class'=> 'form-control my-1')))
        ->add('breed', TextType::class, array('attr' => array('class'=> 'form-control my-1')))
        ->add('status', ChoiceType::class, array('choices'=>array('Free'=>'free', 'Adopted'=>'adopted'),'attr' => array('class'=> 'form-control my-1')))
        ->add('save', SubmitType::class, array('label'=> 'Add animal', 'attr' => array('class'=> 'btn-primary')))
        ->getForm();
        $form->handleRequest($request);

        /* Here we have an if statement, if we click submit and if  the form is valid we will take the values from the form and we will save them in the new variables */
        if($form->isSubmitted() && $form->isValid()){
            //fetching data
            // taking the data from the inputs by the name of the inputs then getData() function
            // status == FREE, DEFAULT IMAGE
            $name = $form['name']->getData();
            $location = $form['location']->getData();
            $description = $form['description']->getData();
            $size = $form['size']->getData();
            $age = $form['age']->getData();
            $hobbies = $form['hobbies']->getData();
            $breed = $form['breed']->getData();
            $status = $form['status']->getData();
            /* these functions we bring from our entities, every column have a set function and we put the value that we get from the form */
            $animals->setName($name);
            $animals->setLocation($location);
            $animals->setDescription($description);
            $animals->setSize($size);
            $animals->setAge($age);
            $animals->setHobbies($hobbies);
            $animals->setBreed($breed);
            $animals->setStatus($status);
            $em = $this->getDoctrine()->getManager();
            $em->persist($animals);
            $em->flush();
            $this->addFlash(
                    'notice',
                    'animal updated'
                    );
            return $this->redirectToRoute('animals');
        }

        /* now to make the form we will add this line form->createView() and now you can see the form in create.html.twig file  */
        return $this->render('animals/edit.html.twig', array('animal' => $animals, 'form' => $form->createView())); 
    }


    #[Route("/animals/details/{id}", name:"animals_details")]
    public function details($id): Response
    {
        $animal = $this->getDoctrine()->getRepository('App:Animals')->find($id);
        return $this->render('animals/details.html.twig', array('animal' => $animal));
    }

    #[Route("/animals/delete/{id}", name:"animal_delete")]
    public function delete($id){
        $em = $this->getDoctrine()->getManager();
        $animal = $em->getRepository('App:Animals')->find($id);
        $em->remove($animal);
        $em->flush();
        $this->addFlash(
            'notice',
            'Animal Removed'
        );
        return $this->redirectToRoute('animals');

    }   
}
