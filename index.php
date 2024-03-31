<?php

try {
    $database = new PDO('mysql:host=localhost;dbname=twitter', 'root', '');

    $request = $database->prepare(
        'SELECT tweets.id, tweets.message, users.pseudo FROM tweets
        LEFT JOIN users ON users.id = tweets.author_id
        ORDER BY tweets.id DESC'
    );
    $request->execute();
    $tweets = $request->fetchAll(
        PDO::FETCH_ASSOC
    );



} catch (PDOExeption $e) {
    die('Erreur: ' . $e -> getMessage());
}






$user = isset($_GET['user']) ? $_GET['user'] : 'Utilisateur inconnu';

require_once 'index.html.php';