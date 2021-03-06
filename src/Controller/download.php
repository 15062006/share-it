<?php

namespace App\Controller;



/**
 * Récupération du fichier envoyé par le formulaire
 * dans la méthode homepage() du HomeController
 *
 * En partant du principe qu'un argument $request typé par: Psr\Http\Message\ServerRequestInterface
 * Et que le formulaire comporte un champ nommé "fichier"
 */

use Psr\Http\Message\UploadedFileInterface;

// Récupérer les fichiers envoyés:
$listeFichiers = $request->getUploadedFiles();

// Si le formulaire est envoyé
if (isset($listeFichiers['fichier'])) {
    /** @var UploadedFileInterface $fichier */
    $fichier = $listeFichiers['fichier'];

    /**
     * Méthodes à utiliser de $fichier:
     *      getClientFilename()     nom original du fichier
     *      getError()              code d'erreur
     *      moveTo()                déplacer le fichier
     */
     $nouveau_nom = '...';
     $fichier->moveTo($nouveauNom);
}