<?php

namespace Repositories;

use PDO;
use PDOException;
use Repositories\Repository;

class UserRoleRepository extends Repository
{
    function getRoleById($user_id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT role_name FROM user_roles r JOIN users u ON r.role_id = u.role_id  WHERE user_id = :user_id");
            $stmt->bindParam(':user_id', $user_id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_COLUMN, 0);
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo $e;
        }
    }
}
