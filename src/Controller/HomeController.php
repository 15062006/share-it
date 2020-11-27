<?php

namespace App\Controller;

use App\Database\Fichier;
use App\Database\FichierManager;
use App\File\UploadService;
use Doctrine\DBAL\Connection;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestFactoryInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UploadeFileInterface;

class HomeController extends AbstractController
{
    public function homepage(
        ResponseInterface $response,
        ServerRequestInterface $request,
        Fichier $fichier,
        FichierManager $fichierManager,
        UploadService $uploadService
    ){
        // Récupérer les fichiers envoyés:
        $listeFichiers = $request->getUploadedFiles();

        // Si le formulaire est envoyé
        if (isset($listeFichiers['fichier'])) {
            /** @var UploadedFileInterface $fichier */
             $fichier = $listeFichiers['fichier'];

            // Récuperer le nouveau nom du fichier
            $nouveauNom = $uploadService->saveFile($fichier);
             
            // Enregistrer les infos du fichier en base de données
            // méthode insert()
    $fichier = $fichierManager->createFichier($nouveauNom,$fichier->getClientFilename());

 /**
  * méthode executeStatement()
$connection->executeStatement('INSERT INTO fichier (nom, nom_original) VALUES (:nom, :nom_original)', [
    'nom' => $nouveauNom,
  'nom_original' => $fichier->getClientFilename(),
 ]);

  méthode prepare() (style PDO)
    $query = $connection->prepare('INSERT INTO fichier (nom, nom_original) VALUES (:nom, :nom_original)');
    $query->bindValue('nom', $nouveauNom);
    $query->bindValue('nom_original', $fichier->getClientFilename());
    $query->execute();

 Query Builder
  $queryBuilder = $connection->createQueryBuilder();
  $queryBuilder
    ->insert('fichier')
    ->values([
   'nom' => $nouveauNom,
   'nom_original' => $fichier->getClientFilename(),
 ]);
  $queryBuilder->execute();
  */
        
            // redirection vers la page de succès
            return $this->redirect('success', [
                'id' => $fichier->getId()
        ]);
    }

        return $this->template($response, 'home.html.twig');
    }

    public function success(ResponseInterface $response, int $id, FichierManager $fichierManager)
    {
         $fichier = $fichierManager->getById($id);
         if($fichier === null){

             return $this->redirect('file-error');
     }
         return $this->template($response, 'success.html.twig', [
             'fichier' =>$fichier
         ]);
    }

    public function fileError(ResponseInterface $response){
        return $this->template($response, 'file_error.html.twig');
    }

    public function download(ResponseInterface $response, string $id)
    {
        $response->getBody()->write(sprintf('Identifiant: %d', $id));
        return $response;
    }
    
    /**
     * 
         $originalFilename = $files->getOriginalFileName(); 
        $fileName = $files->getNom();

    echo '<pre';
    var_dump($originalFilename);
    echo '</pre>';

    echo '<pre';
    var_dump($fileName);
    echo '</pre>';

    $path = __DIR__ . '/../../files/' . $files->getFileName();

    if (file_exists($pathFilName)) {
        header("Content-Disposition: attachment; filename=\"$originalFilename\"");
        $files = $filesManager->getById($id);
        $originalFilename = $files->getOriginalFileName();
        fopen($pathFilName, 'w+');
        readfile($pathFilName);
        exit;

    }

    return $response;
     */

}
