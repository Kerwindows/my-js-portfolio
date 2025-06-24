<?php
class UserVerificationUtility {

    // Checks if the user exists by email
    public static function checkUserByEmail($loggedInUserArray) {
        if(empty($loggedInUserArray['email'])) {
            self::redirect('/404');
        }
    }

    // Checks if the user exists by ID
    public static function checkUserById($userByIdArray) {
        if(empty($userByIdArray)) {
            self::redirect('/404');
        }
    }

    // Redirects to a given path
    private static function redirect($path) {
        header('Location: ' . $path);
        exit();
    }
}