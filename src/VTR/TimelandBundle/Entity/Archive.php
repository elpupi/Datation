<?php
namespace VTR\TimelandBundle\Entity;
use Symfony\Component\HttpFoundation\Session\Session;

use Doctrine\ORM\Mapping as ORM;
use VTR\TimelandBundle\Entity\File;

/**
 * @ORM\Entity(repositoryClass="OC\PlatformBundle\Entity\ImageRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Archive {

    /**
    * @ORM\Column(name="id", type="integer")
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    */
    private $id;

    /**
    * @ORM\Column(name="path", type="string", length=255)
    */
    private $filename;


    private $listFiles;


    public function __construct() {
        $this->listFiles = array();
        $this->filename = "";
    }

    public function addFile(File $file) {
        $this->listFiles[] = $file;
    }
    

    /**
    * @ORM\PrePersist()
    * @ORM\PreUpdate()
    */
    public function preUpload()
    {
        /*
        $session = new Session();
        $session->start();

        if($session->get('filename') == '') $session->set('filename', md5(date('Y-m-d H:i:s:u')));

        $this->filename = $session->get('filename');
        */
        $this->filename = md5(date('Y-m-d H:i:s:u'));
    }
    
    /**
    * @ORM\PostPersist()
    * @ORM\PostUpdate()
    */
    public function save($withEraseFiles = true) {

    
     $path = /*File::getUploadRootDir() .*/ "archive/". $this->filename . '.tar';
        try{
        $a = new \PharData($path);
        }
        catch (Exception $e) 
{
    echo "Exception : " . $e;
}
        foreach($this->listFiles as $f)
        {
        try{

            $a->addFile($f->getPath2());
            if($withEraseFiles) $f->removeFile();
        }
 catch (Exception $e) {
    echo "Exception : " . $e;
}

        }
        // COMPRESS archive.tar FILE. COMPRESSED FILE WILL BE archive.tar.gz
        try{
//        $a->compress(\Phar::GZ);        
}
 catch (Exception $e) {
    echo "Exception : " . $e;
}
        // NOTE THAT BOTH FILES WILL EXISTS. SO IF YOU WANT YOU CAN UNLINK archive.tar
        //unlink($path);
    }


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Get filename
     *
     * @return string 
     */
    public function getFilename()
    {
        return $this->filename;
    }

    public function setFilename($filename)
    {
        $this->filename = $filename;
    }
}
