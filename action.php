<?php

require_once 'config.php';

try {

    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        if(isset($_POST['message']) && !empty($_POST['message'])) {
            $message = $_POST['message'];
            $userId = null;

            if(isset($_POST['user']) && !empty($_POST['user'])) {
                $user = $_POST['user'];

                $request = $database->prepare(
                    'SELECT id FROM users WHERE pseudo = :pseudo'
                );
                $request->execute([
                    'pseudo' => $user
                ]);
                $userId = $request->fetchColumn();

                
                if ($userId) {
                    $request = $database->prepare(
                        'INSERT INTO tweets (message, author_id) VALUES (:message, :author_id)'
                    );
                    $request->execute([
                        'message' => $message,
                        'author_id' => $userId
                    ]);
                }
            }

            if(isset($user)){
                header('Location: index.php?user=' . $user);
            }

        } else {
            die("Error");
        }
    }

    exit();

} catch (PDOExeption $e) {
    die('Erreur : ' . $e->getMessage());
}

