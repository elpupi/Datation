<?php
// src/VTR/TimelandBundle/Controller/FileController.php

namespace VTR\TimelandBundle\Controller;

use Thrift\Base\TBase;
use Thrift\Type\TType;
use Thrift\Type\TMessageType;
use Thrift\Exception\TException;
use Thrift\Exception\TProtocolException;
use Thrift\Protocol\TProtocol;
use Thrift\Protocol\TBinaryProtocolAccelerated;
use Thrift\Exception\TApplicationException;

use Thrift\Protocol\TBinaryProtocol;
use Thrift\Transport\TSocket;
use Thrift\Transport\THttpClient;
use Thrift\Transport\TBufferedTransport;
//use Thrift\Exception\TException;


require_once '/usr/lib/php/Thrift/ClassLoader/ThriftClassLoader.php';//__DIR__.'/../../lib/php/lib/Thrift/ClassLoader/ThriftClassLoader.php';

//require __DIR__.'/../Thrift/gen-php/timeland_thrift/Timeland.php';
//require '../Thrift/gen-php/Timeland.php';
//require __DIR__.'/Timeland.php';


/**
 * Autogenerated by Thrift Compiler (0.9.2)
 *
 * DO NOT EDIT UNLESS YOU ARE SURE THAT YOU KNOW WHAT YOU ARE DOING
 *  @generated
 */



/**
 * Ahh, now onto the cool part, defining a service. Services just need a name
 * and can optionally inherit from another service using the extends keyword.
 */
interface TimelandIf {
  /**
   * @param string $file
   * @return string
   */
  public function compute($file);
}

class TimelandClient implements TimelandIf {
  protected $input_ = null;
  protected $output_ = null;

  protected $seqid_ = 0;

  public function __construct($input, $output=null) {
    $this->input_ = $input;
    $this->output_ = $output ? $output : $input;
  }

  public function compute($file)
  {
    $this->send_compute($file);
    return $this->recv_compute();
  }

  public function send_compute($file)
  {
    $args = new Timeland_compute_args();
    $args->file = $file;
    $bin_accel = ($this->output_ instanceof TBinaryProtocolAccelerated) && function_exists('thrift_protocol_write_binary');
    if ($bin_accel)
    {
      thrift_protocol_write_binary($this->output_, 'compute', TMessageType::CALL, $args, $this->seqid_, $this->output_->isStrictWrite());
    }
    else
    {
      $this->output_->writeMessageBegin('compute', TMessageType::CALL, $this->seqid_);
      $args->write($this->output_);
      $this->output_->writeMessageEnd();
      $this->output_->getTransport()->flush();
    }
  }

  public function recv_compute()
  {
    $bin_accel = ($this->input_ instanceof TBinaryProtocolAccelerated) && function_exists('thrift_protocol_read_binary');
    if ($bin_accel) $result = thrift_protocol_read_binary($this->input_, 'Timeland_compute_result', $this->input_->isStrictRead());
    else
    {
      $rseqid = 0;
      $fname = null;
      $mtype = 0;

      $this->input_->readMessageBegin($fname, $mtype, $rseqid);
      if ($mtype == TMessageType::EXCEPTION) {
        $x = new TApplicationException();
        $x->read($this->input_);
        $this->input_->readMessageEnd();
        throw $x;
      }
      $result = new Timeland_compute_result();
      $result->read($this->input_);
      $this->input_->readMessageEnd();
    }
    if ($result->success !== null) {
      return $result->success;
    }
    throw new \Exception("compute failed: unknown result");
  }

}

// HELPER FUNCTIONS AND STRUCTURES

class Timeland_compute_args {
  static $_TSPEC;

  /**
   * @var string
   */
  public $file = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'file',
          'type' => TType::STRING,
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['file'])) {
        $this->file = $vals['file'];
      }
    }
  }

  public function getName() {
    return 'Timeland_compute_args';
  }

  public function read($input)
  {
    $xfer = 0;
    $fname = null;
    $ftype = 0;
    $fid = 0;
    $xfer += $input->readStructBegin($fname);
    while (true)
    {
      $xfer += $input->readFieldBegin($fname, $ftype, $fid);
      if ($ftype == TType::STOP) {
        break;
      }
      switch ($fid)
      {
        case 1:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->file);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        default:
          $xfer += $input->skip($ftype);
          break;
      }
      $xfer += $input->readFieldEnd();
    }
    $xfer += $input->readStructEnd();
    return $xfer;
  }

  public function write($output) {
    $xfer = 0;
    $xfer += $output->writeStructBegin('Timeland_compute_args');
    if ($this->file !== null) {
      $xfer += $output->writeFieldBegin('file', TType::STRING, 1);
      $xfer += $output->writeString($this->file);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class Timeland_compute_result {
  static $_TSPEC;

  /**
   * @var string
   */
  public $success = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        0 => array(
          'var' => 'success',
          'type' => TType::STRING,
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['success'])) {
        $this->success = $vals['success'];
      }
    }
  }

  public function getName() {
    return 'Timeland_compute_result';
  }

  public function read($input)
  {
    $xfer = 0;
    $fname = null;
    $ftype = 0;
    $fid = 0;
    $xfer += $input->readStructBegin($fname);
    while (true)
    {
      $xfer += $input->readFieldBegin($fname, $ftype, $fid);
      if ($ftype == TType::STOP) {
        break;
      }
      switch ($fid)
      {
        case 0:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->success);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        default:
          $xfer += $input->skip($ftype);
          break;
      }
      $xfer += $input->readFieldEnd();
    }
    $xfer += $input->readStructEnd();
    return $xfer;
  }

  public function write($output) {
    $xfer = 0;
    $xfer += $output->writeStructBegin('Timeland_compute_result');
    if ($this->success !== null) {
      $xfer += $output->writeFieldBegin('success', TType::STRING, 0);
      $xfer += $output->writeString($this->success);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}




















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

 
    public function cppAction(Request $request)
    {
        //return new Response("caca");
        $GEN_DIR = __DIR__.'../Thrift/gen-php';
        //$GEN_DIR = '.';

        $loader = new \Thrift\ClassLoader\ThriftClassLoader();
        $loader->registerNamespace('Thrift','/usr/lib/php/');
//        $loader->registerDefinition('timeland_thrift', $GEN_DIR);
        $loader->register();



        $socket = new TSocket('localhost', 9090);
        $transport = new TBufferedTransport($socket, 1024, 1024);
        $protocol = new TBinaryProtocol($transport);
        //$client = new \timeland_thrift\TimelandClient($protocol);
        $client = new TimelandClient($protocol);

        $transport->open();

        $result = $client->compute("file.txt");

        return new Response($result);
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
