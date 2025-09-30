<?php
class Auth {
    private $users = [
        ['username'=>'admin1','password'=>'password1'],
        ['username'=>'admin2','password'=>'password2'],
        ['username'=>'admin3','password'=>'password3'],
    ];

    public function login($username, $password){
        foreach($this->users as $user){
            if($user['username'] === $username && $user['password'] === $password){
                $_SESSION['user_id'] = $username;
                return true;
            }
        }
        return false;
    }

    public function logout(){
        session_destroy();
    }
}
