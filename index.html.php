<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mini Twitter</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <div class="container">
        <nav>
            <ul>
                <li><a href="#">Accueil</a></li>
                <li><a href="#">Explorer</a></li>
                <li><a href="#">Notifications</a></li>
                <li><a href="#">Messages</a></li>
                <li><a href="#">Profil</a></li>
            </ul>
        </nav>
        <section class="feed">
            <?php if(!empty($user)): ?>
                <h3>Bienvenue, <?= $user ?>.</h3>
            <?php endif; ?>
            
            <?php if (!empty($user)): ?>
                <form id="tweetForm" action="action.php" method="POST">
                    <input type="hidden" name="user" value="<?= $user ?>">
                    <textarea placeholder="Quoi de neuf ?" name="message"></textarea>
                    <button type="submit">Tweeter</button>
                </form>
            <?php endif; ?>

            
            <div class="tweets">
                
                <?php foreach($tweets as $tweet): ?>
                    <div class="tweet">

                        <h1><?= $tweet['pseudo']?></h1>
                        <p><?= $tweet['message']?></p>

                        <?php if ($tweet['pseudo'] == $user): ?>
                            <form method="post" action="delete_tweet.php">
                                <input type="hidden" name="tweet_id" value="<?= $tweet['id'] ?>">
                                <input type="hidden" name="user" value="<?= $user ?>">  
                                <button type="submit" id="delete-button">Supprimer</button>
                            </form>
                        <?php endif; ?>

                    </div>
                <?php endforeach?>
        
            </div>
        </section>
    </div>
</body>
</html>
