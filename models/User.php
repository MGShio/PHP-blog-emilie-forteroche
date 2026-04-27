<?php

/**
 * Entité User : un user est défini par son id, un login et un password.
 */ 
class User extends AbstractEntity 
{
    private string $login;
    private string $password;

    /**
     * Setter pour le login.
     * @param string $login
     */
    public function setLogin(string $login) : self
    {
        $this->login = $login;
        return $this;
    }

    /**
     * Getter pour le login.
     * @return string
     */
    public function getLogin() : string 
    {
        return $this->login;
    }

    /**
     * Setter pour le password.
     * @param string $password
     */
    public function setPassword(string $password) : self
    {
        $this->password = $password;
        return $this;
    }

    /**
     * Getter pour le password.
     * @return string
     */
    public function getPassword() : string 
    {
        return $this->password;
    }
}