<?php
    /**
     * Template pour afficher les commentaires d'un article dans la partie admin, avec un bouton "supprimer" pour chaque commentaire.
     */
?>

<h2>Gestion des commentaires</h2>

<table class="comments-table">
    <thead>
        <tr>
            <th>Commentaire</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($comments as $comment): ?>
        <tr>
            <td>
                <p><?= htmlspecialchars($comment->getContent()) ?></p>
                <small>par <?= htmlspecialchars($comment->getPseudo()) ?></small>
            </td>
            <td>
                <a class="submit" href="index.php?action=deleteComment&id=<?= $comment->getId() ?>&articleId=<?= $articleId ?>"
                   onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce commentaire ?')">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<a class="submit" href="index.php?action=monitoring">Retour au monitoring</a>