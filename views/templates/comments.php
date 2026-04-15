<?php
    /**
     * Template pour afficher les commentaires d'un article dans la partie admin, avec un bouton "supprimer" pour chaque commentaire.
     */
?>

<h2>Gestion des commentaires</h2>

<ul class="comments">
    <?php foreach ($comments as $comment): ?>
    <li>
        <p><?= htmlspecialchars($comment->getContent()) ?> (par <?= htmlspecialchars($comment->getPseudo()) ?>)</p>
        <a class="submit" href="index.php?action=deleteComment&id=<?= $comment->getId() ?>&articleId=<?= $articleId ?>" <?= Utils::askConfirmation("Êtes-vous sûr de vouloir supprimer ce commentaire ?") ?>>Supprimer</a>
    </li>
    <?php endforeach; ?>
</ul>

<a class="submit" href="index.php?action=monitoring">Retour au monitoring</a>