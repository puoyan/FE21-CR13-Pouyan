<?php

namespace App\Controller;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Event;
use App\Entity\Type;

class EventController extends AbstractController
{
    #[Route('/', name: 'event')]
    public function index(): Response
    {
        $events = $this->getDoctrine()->getRepository(Event::class)->findAll();  
        return $this->render('base.html.twig', [
            "events" => $events
        ]);
    }


    #[Route('/admin', name: 'event.admin')]
    public function admin(): Response
    {
        $events = $this->getDoctrine()->getRepository(Event::class)->findAll();  
        return $this->render('event/index.html.twig', [
            "events" => $events
        ]);
    }


    #[Route('/create', name: 'createEvent')]
    public function create(Request $request,SluggerInterface $slugger): Response
    {
        $event = new Event();
        $form = $this->createFormBuilder($event)
        ->add("name", TextType::class, array('attr'=>array("class"=>"form-control input", "style"=>"margin-bottom: 15px")))
        ->add("date", DateTimeType::class, array('attr'=>array("class"=>"form-control", "style"=>"margin-bottom: 15px")))
        ->add("start_time", TextType::class, array('attr'=>array("class"=>"form-control", "style"=>"margin-bottom: 15px","id"=>"demo")))
        ->add("description", TextareaType::class, array('attr'=>array("class"=>"form-control", "style"=>"margin-bottom: 15px")))
        ->add("capacity", TextType::class, array('attr'=>array("class"=>"form-control", "style"=>"margin-bottom: 15px")))
        ->add("email", TextType::class, array('attr'=>array("class"=>"form-control", "style"=>"margin-bottom: 15px")))
        ->add("phone", TextType::class, array('attr'=>array("class"=>"form-control", "style"=>"margin-bottom: 15px")))
        ->add("url", TextareaType::class, array('attr'=>array("class"=>"form-control", "style"=>"margin-bottom: 15px")))
        ->add("location", TextareaType::class, array('attr'=>array("class"=>"form-control", "style"=>"margin-bottom: 15px")))
        ->add("zip_code", TextType::class, array('attr'=>array("class"=>"form-control", "style"=>"margin-bottom: 15px")))
        ->add("image", FileType::class, array('attr'=>array("class"=>"form-control", "style"=>"margin-bottom: 15px"),'label' => 'Image (png/jpg file)','mapped' => false,'required' => false,'constraints' => [
            new File([
                'maxSize' => '2048k',
                'mimeTypes' => [
                    'image/*'                
                ],
                'mimeTypesMessage' => 'Please upload a valid image document',
            ])
        ]))
        
        ->add("type_id", EntityType::class, array('attr'=>array("class"=>"form-control", "style"=>"margin-bottom: 15px"), 'class'=>Type::class, 'choice_label'=>'title'))

        ->add("save", SubmitType::class, array('attr'=>array("class"=>"btn-primary", "style"=>"margin-bottom: 15px"),"label"=>"create event"))->getForm();
        // <input name="name" type="text" class="form-control">

        $form->handleRequest($request);

        if($form->isSubmitted()){
            $name = $form["name"]->getData();
            $date = $form["date"]->getData();
            $description = $form['description']->getData();
            $capacity = $form['capacity']->getData();
            $email = $form["email"]->getData();
            $phone = $form['phone']->getData();
            $url = $form['url']->getData();
            $location = $form['location']->getData();
            $zip_code = $form['zip_code']->getData();
            $picture = $form['image']->getData();
            $start_time = $form['start_time']->getData();
            $type_id = $form['type_id']->getData();

            if ($picture) {
                $originalFilename = pathinfo($picture->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$picture->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $picture->move(
                        'upload',
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $event->setImage($newFilename);

            }
            $now = new \DateTime('now');
            $event->setName($name);
            $event->setStartTime($start_time);
            $event->setDescription($description);
            $event->setCapacity($capacity);
            $event->setDate($date);
            $event->setEmail($email);
            $event->setPhone($phone);
            $event->setUrl($url);
            $event->setLocation($location);
            $event->setZipCode($zip_code);
            $event->setTypeId($type_id);
            // $status = $this->getDoctrine()->getRepository(Status::class)->find(1);
            // // dd($status);
            // $event->setFkStatus(1);

            $em = $this->getDoctrine()->getManager();

            $em->persist($event);
            $em->flush();

            $this->addFlash('notice', 'Event Added');

            return $this->redirectToRoute('event.admin');
        }

        return $this->render('event/create.html.twig', [
            "form" => $form->createView()
        ]);
    }

    

    #[Route('/edit/{id}', name: 'editEvent')]
    public function edit($id, Request $request): Response
    {
        $event = $this->getDoctrine()->getRepository(Event::class)->find($id);
        $form = $this->createFormBuilder($event)
        ->add("name", TextType::class, array('attr'=>array("class"=>"form-control input", "style"=>"margin-bottom: 15px")))
        ->add("date", DateTimeType::class, array('attr'=>array("class"=>"form-control", "style"=>"margin-bottom: 15px")))
        ->add("start_time", TextType::class, array('attr'=>array("class"=>"form-control", "style"=>"margin-bottom: 15px","id"=>"demo")))
        ->add("description", TextareaType::class, array('attr'=>array("class"=>"form-control", "style"=>"margin-bottom: 15px")))
        ->add("capacity", TextType::class, array('attr'=>array("class"=>"form-control", "style"=>"margin-bottom: 15px")))
        ->add("email", TextType::class, array('attr'=>array("class"=>"form-control", "style"=>"margin-bottom: 15px")))
        ->add("phone", TextType::class, array('attr'=>array("class"=>"form-control", "style"=>"margin-bottom: 15px")))
        ->add("url", TextareaType::class, array('attr'=>array("class"=>"form-control", "style"=>"margin-bottom: 15px")))
        ->add("location", TextareaType::class, array('attr'=>array("class"=>"form-control", "style"=>"margin-bottom: 15px")))
        ->add("zip_code", TextType::class, array('attr'=>array("class"=>"form-control", "style"=>"margin-bottom: 15px")))
        ->add("type_id", EntityType::class, array('attr'=>array("class"=>"form-control", "style"=>"margin-bottom: 15px"), 'class'=>Type::class, 'choice_label'=>'title'))
        ->add("save", SubmitType::class, array('attr'=>array("class"=>"btn-primary", "style"=>"margin-bottom: 15px"),"label"=>"update event"))->getForm();
        // <input name="name" type="text" class="form-control">

        $form->handleRequest($request);

        if($form->isSubmitted()){
            $name = $form["name"]->getData();
            $date = $form["date"]->getData();
            $description = $form['description']->getData();
            $capacity = $form['capacity']->getData();
            $email = $form["email"]->getData();
            $phone = $form['phone']->getData();
            $url = $form['url']->getData();
            $location = $form['location']->getData();
            $zip_code = $form['zip_code']->getData();
            $start_time = $form['start_time']->getData();
            $type_id = $form['type_id']->getData();

            $now = new \DateTime('now');
            $event->setName($name);
            $event->setStartTime($start_time);
            $event->setDescription($description);
            $event->setCapacity($capacity);
            $event->setDate($date);
            $event->setEmail($email);
            $event->setPhone($phone);
            $event->setUrl($url);
            $event->setLocation($location);
            $event->setZipCode($zip_code);
            $event->setTypeId($type_id);
           

            $em = $this->getDoctrine()->getManager();

            $em->persist($event);
            $em->flush();

            $this->addFlash('notice', 'Event Updated');

            return $this->redirectToRoute('event.admin');
        }



        return $this->render('event/edit.html.twig', [
            "form" => $form->createView()
        ]);
    }
 

    #[Route('/update', name: 'updateEvent')]
    public function update($id): Response
    {
        return $this->render('event/update.html.twig', [
            "id"=> $id
        ]);
    }

    #[Route('/details/{id}', name: 'detailsEvent')]
    public function details($id): Response
    {
        return $this->render('details.html.twig', [
            "event"=> $this->getDoctrine()->getRepository(Event::class)->find($id)
        ]);
    }


     #[Route('/delete/{id}', name: 'eventDelete')]
    public function delete($id): Response
    {
        $event = $this->getDoctrine()->getRepository(Event::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($event);
        $em->flush();
        return $this->redirectToRoute('event.admin');
    }

    
}
