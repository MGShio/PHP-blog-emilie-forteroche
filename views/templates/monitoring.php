<?php
    /**
     * Template pour afficher la gestion plus poussé des articles : nombre de vues, nombre de commentaires, date de publication, etc.
     */
?>

<h2>Monitoring des articles</h2>

<table>
    <thead>
        <tr>
            <th>
                <a href="index.php?action=monitoring&sort=title&order=<?= ($sort === 'title' && $order === 'ASC') ? 'DESC' : 'ASC' ?>">
                    Titre <?= ($sort === 'title') ? ($order === 'ASC' ? '↑' : '↓') : '' ?>
                </a>
            </th>
            <th>
                <a href="index.php?action=monitoring&sort=view&order=<?= ($sort === 'view' && $order === 'ASC') ? 'DESC' : 'ASC' ?>">
                    Vues <?= ($sort === 'view') ? ($order === 'ASC' ? '↑' : '↓') : '' ?>
                </a>
            </th>
            <th>
                <a href="index.php?action=monitoring&sort=comments_count&order=<?= ($sort === 'comments_count' && $order === 'ASC') ? 'DESC' : 'ASC' ?>">
                    Commentaires <?= ($sort === 'comments_count') ? ($order === 'ASC' ? '↑' : '↓') : '' ?>
                </a>
            </th>
            <th>
                <a href="index.php?action=monitoring&sort=date_creation&order=<?= ($sort === 'date_creation' && $order === 'ASC') ? 'DESC' : 'ASC' ?>">
                    Date de publication <?= ($sort === 'date_creation') ? ($order === 'ASC' ? '↑' : '↓') : '' ?>
                </a>
            </th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($articles as $article): ?>
        <tr>
            <td><?= htmlspecialchars($article->getTitle()) ?></td>
            <td><?= $article->view ?></td>
            <td><?= $article->comments_count ?></td>
            <td><?= $article->getDateCreation()->format('d/m/Y H:i') ?></td>
            <td>
                <a class="submit" href="index.php?action=showComments&articleId=<?= $article->getId() ?>">Voir/Supprimer les commentaires</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>