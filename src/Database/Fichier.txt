<?php
namespace App\Database;

 /**
     * Les objets de la classe Fichier respresent les données de la table "fichier"
     * 1 instance = 1 Ligne
     */

class Fichier
{
      /*
     * PHP 7.4 et +
     *      private ?int $id = null;
     * PHP < 7.4:
     *      private $id;
     */

   private ?int $id = null;
   // ou private $id
   private ?string $nom = null;
   private ?string $nom_original = null;

   public function getId(): ?int
   {
       return $this->id;
   }
/**
 * self designe la classe actuelle
 * @return self retourne l'objet actuel
 */
   public function setId(?int $id): self
   {
       $this->id = $id;
       return $this;
   }

   public function getNom(): ?string
   {
       return $this->nom;
   }
   public function setNom(string $nom): self
   {
       $this->nom = $nom;
       return $this;
   }
   public function setNomOriginal(string $nom_original): self
   {
       $this->nom_original = $nom_original;
       return $this;
   }
}
