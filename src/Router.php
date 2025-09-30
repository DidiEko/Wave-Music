<?php
class Router {
    public function route($page) {
        $publicPages = ['home','spotlight','login'];
        $privatePages = ['find_name','top10','calendar','chipies'];

        if(in_array($page, $publicPages)) {
            include __DIR__ . "/../views/$page.php";
        } elseif(in_array($page, $privatePages)) {
            if(!isset($_SESSION['user_id'])) {
                header('Location: index.php?p=login');
                exit();
            }
            include __DIR__ . "/../views/$page.php";
        } else {
            echo "Page non trouvée";
        }
    }
}
