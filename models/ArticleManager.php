<?php

/**
 * Classe qui gère les articles.
 */
class ArticleManager extends AbstractEntityManager
{
    /**
     * Récupère tous les articles.
     * @return array : un tableau d'objets Article.
     */
    public function getAllArticles(): array
    {
        $sql = "SELECT * FROM article";
        $result = $this->db->query($sql);
        $articles = [];

        while ($article = $result->fetch()) {
            $articles[] = new Article($article);
        }
        return $articles;
    }

    /**
     * Récupère un article par son id.
     * @param int $id : l'id de l'article.
     * @return Article|null : un objet Article ou null si l'article n'existe pas.
     */
    public function getArticleById(int $id): ?Article
    {
        $sql = "SELECT * FROM article WHERE id = :id";
        $result = $this->db->query($sql, ['id' => $id]);
        $article = $result->fetch();
        if ($article) {
            return new Article($article);
        }
        return null;
    }

    /**
     * Ajoute ou modifie un article.
     * On sait si l'article est un nouvel article car son id sera null.
     * @param Article $article : l'article à ajouter ou modifier.
     * @return void
     */
    public function addOrUpdateArticle(Article $article): void
    {
        if ($article->getId() === null) {
            $this->addArticle($article);
        } else {
            $this->updateArticle($article);
        }
    }

    /**
     * Ajoute un article.
     * @param Article $article : l'article à ajouter.
     * @return void
     */
    public function addArticle(Article $article): void
    {
        $sql = "INSERT INTO article (id_user, title, content, date_creation) VALUES (:id_user, :title, :content, NOW())";
        $this->db->query($sql, [
            'id_user' => $article->getIdUser(),
            'title' => $article->getTitle(),
            'content' => $article->getContent()
        ]);
    }

    /**
     * Modifie un article.
     * @param Article $article : l'article à modifier.
     * @return void
     */
    public function updateArticle(Article $article): void
    {
        $sql = "UPDATE article SET title = :title, content = :content, date_update = NOW() WHERE id = :id";
        $this->db->query($sql, [
            'title' => $article->getTitle(),
            'content' => $article->getContent(),
            'id' => $article->getId()
        ]);
    }

    /**
     * Supprime un article.
     * @param int $id : l'id de l'article à supprimer.
     * @return void
     */
    public function deleteArticle(int $id): void
    {
        $sql = "DELETE FROM article WHERE id = :id";
        $this->db->query($sql, ['id' => $id]);
    }

    /**
     * Incrémente le nombre de vues d'un article.
     * @param int $articleId : l'ID de l'article.
     */
    public function incrementView(int $articleId): void
    {
        $sql = "UPDATE article SET `view` = `view` + 1 WHERE id = :id";
        $this->db->query($sql, ['id' => $articleId]);
    }

    /**
     * Récupère tous les articles avec leur nombre de vues et de commentaires.
     * @param string $sort : le critère de tri.
     * @param string $order : l'ordre de tri (ASC ou DESC).
     * @return array : un tableau associatif des articles avec leurs vues et commentaires.
     */
    public function getAllArticlesWithViewsAndComments(string $sort = 'date_creation', string $order = 'DESC'): array
    {
        $order = strtoupper($order) === 'ASC' ? 'ASC' : 'DESC';
        $sql = "SELECT id, title, `view`, date_creation FROM article";

        if ($sort !== 'comments_count') {
            $validSorts = ['id', 'title', 'view', 'date_creation'];
            if (in_array($sort, $validSorts)) {
                $sql .= " ORDER BY $sort $order";
            }
        }

        $result = $this->db->query($sql);
        $articles = $result->fetchAll(PDO::FETCH_CLASS, 'Article');

        // Ajouter le nombre de commentaires pour chaque article
        $commentManager = new CommentManager();
        foreach ($articles as $article) {
            $article->comments_count = $commentManager->countCommentsForArticle($article->getId());
        }

        // Trier par comments_count si nécessaire
        if ($sort === 'comments_count') {
            usort($articles, function ($a, $b) use ($order) {
                return ($order === 'ASC')
                    ? $a->comments_count <=> $b->comments_count
                    : $b->comments_count <=> $a->comments_count;
            });
        }

        return $articles;
    }
}
