<?php

namespace Repositories;

use PDO;
use PDOException;
use Repositories\Repository;

class UserRepository extends Repository
{
    function getUser($username, $password)
    {
        try {
            // retrieve the user with the given username
            $stmt = $this->connection->prepare("SELECT * FROM users WHERE LOWER(username) = LOWER(:username) OR LOWER(email) = LOWER(:email)");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $username);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Models\User');
            $user = $stmt->fetch();


            return $user;
        } catch (PDOException $e) {
            echo $e;
        }
    }
    function insert($username, $email, $hashedPassword)
    {
            $stmt = $this->connection->prepare("INSERT into users (username, email, password, joined_at) 
            VALUES (:username, :email, :password, NOW())");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashedPassword);

            try
            {
            $stmt->execute();
            }
            catch (PDOException $e)
            {
            echo "Error: " . $e->getMessage();
            }

    }
    function getUserById($user_id)
    {
        try {
            // retrieve the user with the given username
            $stmt = $this->connection->prepare("SELECT * FROM users WHERE user_id = :user_id");
            $stmt->bindParam(':user_id', $user_id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Models\User');
            $user = $stmt->fetch();

            return $user;
        } catch (PDOException $e) {
            echo $e;
        }
    }
    
    function isExistingUsername($username) {
        $stmt = $this->connection->prepare("SELECT username FROM users WHERE LOWER(username) = LOWER(:username)");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        if ($stmt->fetchAll()) 
        {
                return true;
        } else {
                return false;
        }
}
    function isExistingEmail($email){
            $stmt = $this->connection->prepare("SELECT username FROM users WHERE LOWER(email) = LOWER(:email)");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            if ($stmt->fetchAll()) 
            {
                    return true;
            } else {
                    return false;
            }
    }

    // verify the password hash
    function verifyPassword($password, $hashedPassword)
    {
        return password_verify($password, $hashedPassword);
    }
}
