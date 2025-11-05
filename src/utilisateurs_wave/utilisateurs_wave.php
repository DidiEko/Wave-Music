<?php

//Ce bout de code on l'a vue en classe dans le cours "2.1 - 02.01-bases-de-donnees-et-pdo-avance"

class User
{
    // Propriétés privées pour assurer l'encapsulation
    private string $email;
    private string $nomUtilisateur;
    private int $age;
    private string $motDePasse;
    private DateTime $dateDeCreation;


    // Constructeur pour initialiser l'objet
    public function __construct(string $email, string $nomUtilisateur, int $age, string $motDePasse, DateTime $dateDeCreation)
    {
        $this->email = $email;
        $this->nomUtilisateur = $nomUtilisateur;
        $this->age = $age;
        $this->motDePasse = $motDePasse;
        $this->dateDeCreation = $dateDeCreation;
    }

    // Getters pour accéder aux propriétés
    public function getEmail(): string
    {
        return $this->email;
    }

    public function getNomUtilisateur(): string
    {
        return $this->nomUtilisateur;
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function getMotDePasse(): string
    {
        return $this->motDePasse;
    }

    public function getDateDeCreation(): DateTime
    {
        return $this->dateDeCreation;
    }


    // Setters pour modifier les propriétés
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setNomUtilisateur(string $nomUtilisateur): void
    {
        $this->nomUtilisateur = $nomUtilisateur;
    }

    public function setAge(int $age): void
    {
        if ($age >= 0) {
            $this->age = $age;
        }
    }

    public function setMotDePasse(string $motDePasse): void
    {
        $this->motDePasse = $motDePasse;
    }

    // Méthode pour valider les données de l'utilisateur
    public function validate(): array
    {
        $errors = [];

        if (empty($this->email) || !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Un email valide est requis.";
        }

        if (empty($this->nomUtilisateur) || strlen($this->nomUtilisateur) < 2) {
            $errors[] = "Le nom d'utilisateur doit contenir au moins 2 caractères.";
        }

        if ($this->age < 0) {
            $errors[] = "L'âge doit être un nombre positif.";
        }
        
        if (strlen($this->motDePasse) < 8) {
    $errors[] = "Le mot de passe doit contenir au moins 8 caractères.";
}
        //On n'a pas vu cela lors des cours, mais voici le lien de la doc (c'est pas hyper complexe)
        //https://www.php.net/manual/fr/function.preg-match.php
        if (!preg_match('/[0-9]/', $this->motDePasse)) {
    $errors[] = "Le mot de passe doit contenir au moins un chiffre.";
}


        return $errors;
    }
}
