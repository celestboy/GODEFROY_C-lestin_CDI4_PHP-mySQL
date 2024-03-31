<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['tweet_id']) && !empty($_POST['tweet_id'])) {
        $tweet_id = $_POST['tweet_id'];
        $user = isset($_POST['user']) ? $_POST['user'] : 'Utilisateur inconnu';

        $request = $database->prepare("SELECT id FROM users WHERE pseudo = :pseudo");
        $request->execute(['pseudo' => $user]);
        $user_id = $request->fetchColumn();

        $request = $database->prepare("SELECT author_id FROM tweets WHERE id = :tweet_id");
        $request->execute(['tweet_id' => $tweet_id]);
        $author_id = $request->fetchColumn();

        if ($user_id == $author_id) {
            $request = $database->prepare("DELETE FROM tweets WHERE id = :tweet_id");
            $request->execute(['tweet_id' => $tweet_id]);

            header('Location: index.php?user=' . $user);
            exit();
        } else {
            echo "Vous n'avez pas les droits pour supprimer ce tweet.";
        }
    } else {
        echo "mauvais ID du tweet";
    }
}
