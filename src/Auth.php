<?php
// Définition de la classe Auth pour gérer l'authentification des utilisateurs
class Auth {
    // Tableau privé des utilisateurs avec leur nom d'utilisateur et mot de passe
    private $users = [
        ['username'=>'admin1','password'=>'password1'], // Premier utilisateur
        ['username'=>'admin2','password'=>'password2'], // Deuxième utilisateur
        ['username'=>'admin3','password'=>'password3'], // Troisième utilisateur
    ];

    // Méthode pour connecter un utilisateur
    public function login($username, $password){
        // Parcourt la liste des utilisateurs
        foreach($this->users as $user){
            // Vérifie si le nom d'utilisateur et le mot de passe correspondent
            if($user['username'] === $username && $user['password'] === $password){
                // Stocke le nom d'utilisateur dans la session pour marquer l'utilisateur comme connecté
                $_SESSION['user_id'] = $username;
                return true; // Connexion réussie
            }
        }
        return false; // Aucun utilisateur correspondant, connexion échouée
    }

    // Méthode pour déconnecter l'utilisateur
    public function logout(){
        session_destroy(); // Détruit la session en cours et déconnecte l'utilisateur
    }
}
