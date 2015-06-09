<?php
// src/VTR/TimelandBundle/Controller/FileController.php

namespace VTR\TimelandBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;
use VTR\TimelandBundle\Entity\File;
use VTR\TimelandBundle\Entity\Archive;
use VTR\TimelandBundle\Form\FileType;

class FileController extends Controller
{

  public function addAction(Request $request)
  {
    $file = new File();
    $form = $this->createForm(new FileType(), $file);

    if ($form->handleRequest($request)->isValid()) {

      $em = $this->getDoctrine()->getManager();
      $em->persist($file);
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');
return new Response("Saved file");
      //return $this->redirect($this->generateUrl('vtr_timeland_view', array('id' => $file->getId())));
    }

    // À ce stade :
    // - Soit la requête est de type GET, donc le visiteur vient d'arriver sur la page et veut voir le formulaire
    // - Soit la requête est de type POST, mais le formulaire n'est pas valide, donc on l'affiche de nouveau
    return $this->render('VTRTimelandBundle:File:add.html.twig', array(
      'form' => $form->createView(),
    ));
  }

  public function add2Action(Request $request)
  {


    //$file = new File();
    
    /*$f = new UploadedFile($_FILES['userfile']['tmp_name'],
$_FILES['userfile']['name'],
$_FILES['userfile']['type'],
$_FILES['userfile']['size'],
$_FILES['userfile']['error']);*/


        if ($request->isXmlHttpRequest() && $request->isMethod('POST'))
        {

    $f = $request->files->get('files');
    $a = $request->files->all();
/*
    print_r($request->files);print("<br><br><br>");
print_r("111111".$f);print("<br><br><br>");
print_r($a);print("<br><br><br>");
print_r($_FILES);print("<br><br><br>");
print_r("vavacaca");print("<br><br><br>");
print_r($request->files->all());
*/        

print_r($request->files);print("<br><br><br>");


    foreach( $request->files as $f ) {
//print_r($f);
//print_r(gettype($f));
      $file = new File();            

/*$f = new UploadedFile($ff['tmp_name'],
$ff['name'],
$ff['type'],
$ff['size'],
$ff['error']);
*/

       $file->setFile($f);

print_r($file);
 $em = $this->getDoctrine()->getManager();
$em->persist($file);

    }

 //$em->flush();


            return new Response("Saved file");
        }

return new Response("Merde file");
  }


 public function dropzoneAction(Request $request)
{


    $ff = 'pipi.txt';


    //file_put_contents($ff, print_r(gettype($request->files/*->get('file')*/), true), FILE_APPEND | LOCK_EX);
    //file_put_contents($ff, print_r($request->files->keys(), true), FILE_APPEND | LOCK_EX);

     file_put_contents($ff, print_r($_FILES, true), FILE_APPEND | LOCK_EX);


    //$session = new Session();
    //$session->start();

    // définit et récupère des attributs de session
    //$session->set('name', 'Drak');
    //print_r($session->get('name'));
    //print("<br>CACA<br>PIPI<br>");


    //file_put_contents($ff, print_r($_SESSION, true), FILE_APPEND | LOCK_EX);


    //$session = new Session();
    //$session->start();

    // définit et récupère des attributs de session
    //$session = new Session();
    //$session->start();
    //        $session = $request->getSession();
    //        if($session->get('filename') == '') $session->set('filename', md5(date('Y-m-d H:i:s:u')));

    //file_put_contents($ff, $session->get('filename'), FILE_APPEND | LOCK_EX);        


    $totalFilesSize = 0;
    $archive = new Archive();
    //$archive->setFilename($session->get('filename'));

    $em = $this->getDoctrine()->getManager();
    foreach( $request->files as $f ) {
        $totalFilesSize += $f->getClientSize();
        if($totalFilesSize > 10000000) break;

        $file = new File();            
        $file->setFile($f);
        /*        $file->setExtension($f->guessExtension());
        $file->setAlt("ta mere");
        */
        //print_r($_SERVER['CONTENT_LENGTH'], true)
        //file_put_contents($ff, $f->getClientSize() . "  CACA  ", FILE_APPEND | LOCK_EX);

        $em->persist($file);
        $em->flush();

        $archive->addFile($file); 
        //return new Response("Saved file here for test"); 
    }

    $em->persist($archive);
    $em->flush();

    return new Response("Saved file");
  }

 public function upload3Action(Request $request)
  {
    return $this->render('VTRTimelandBundle:File:upload3.html.twig');
  }

 public function upload2Action(Request $request)
  {
    return $this->render('VTRTimelandBundle:File:upload2.html.twig');
  }


 public function uploadAction(Request $request)
  {
    return $this->render('VTRTimelandBundle:File:upload.html.twig');
  }

 public function viewAction(Request $request, $id)
  {
    return $this->render('VTRTimelandBundle:File:view.html.twig', array(
      'id' => $id
    ));
  }
}
