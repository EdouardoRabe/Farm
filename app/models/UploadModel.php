<?php 
namespace app\models;

class UploadModel{

    public function __construct() {
    }


     function checkError($photo,$index)
    {
        $tailleMax = 5000000000;
        $taille = $photo['size'][$index];
        if ($taille > $tailleMax) {
            return 1;
        }
        $extensions = array('.png', '.jpg', '.jpeg');
        $extension = strrchr($photo['name'][$index], '.');
        if (!in_array($extension, $extensions)) {
            return 2;
        }
        return 0;
    }

     function uploadImg($files,$index)
    {
        $dossier = 'assets/img/';
        $fileName = time() . basename($files['name'][$index]);
        $fileName = strtr(
            $fileName,
            'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
            'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy'
        );
        $fileName = preg_replace('/([^.a-z0-9]+)/i', '-', $fileName);
        $path = $dossier . $fileName;
        if (move_uploaded_file($files['tmp_name'][$index], $path)) {
            return $fileName;
        }
    }

    

}
?>