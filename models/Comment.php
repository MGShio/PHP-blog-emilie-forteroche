<?php

/**
 * Entité représentant un commentaire.
 * Avec les champs id, pseudo, content, et idArticle.
 */
 
class Comment extends AbstractEntity 
{
    private int $idArticle;
    private string $pseudo;
    private string $content;
    private DateTime $dateCreation;
    public int $count = 0;
    
    /**
     * Getter pour l'id de l'article.
     * @return int
     */
    public function getIdArticle(): int 
    {
        return $this->idArticle;
    }

    /**
     * Setter pour l'id de l'article.
     * @param int $idArticle
     * @return void
     */
    public function setIdArticle(int $idArticle): self
    {
        $this->idArticle = $idArticle;
        return $this;
    }

    /**
     * Getter pour le pseudo.
     * @return string
     */
    public function getPseudo(): string 
    {
        return $this->pseudo;
    }

    /**
     * Setter pour le pseudo.
     * @param string $pseudo
     * @return void
     */
    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;
        return $this;
    }

    /**
     * Getter pour le contenu.
     * @return string
     */
    public function getContent(): string 
    {
        return $this->content;
    }

    /**
     * Setter pour le contenu.
     * @param string $content
     * @return void
     */
    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    /**
     * Getter pour la date de création.
     * @return DateTime
     */
    public function getDateCreation(): DateTime 
    {
        return $this->dateCreation;
    }

    /**
     * Setter pour la date de création. 
     * Si la date est une string, on la convertit en DateTime.
     * @param string|DateTime $dateCreation
     * @param string $format : le format pour la convertion de la date si elle est une string.
     * Par défaut, c'est le format de date mysql qui est utilisé. 
     */
    public function setDateCreation(string|DateTime $dateCreation, string $format = 'Y-m-d H:i:s') : self
    {
        if (is_string($dateCreation)) {
            $this->dateCreation = new DateTime($dateCreation);
        } else {
            $this->dateCreation = $dateCreation;
        }
        return $this;
    }

    public function __set($name, $value)
    {
        if ($name === 'id') {
            $this->setId((int)$value);
        } elseif ($name === 'id_article') {
            $this->setIdArticle((int)$value);
        } elseif ($name === 'pseudo') {
            $this->setPseudo($value);
        } elseif ($name === 'content') {
            $this->setContent($value);
        } elseif ($name === 'date_creation') {
            $this->setDateCreation($value);
        } elseif ($name === 'count') {
            $this->count = (int)$value;
        }
    }
}