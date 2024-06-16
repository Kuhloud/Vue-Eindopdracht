<?php
namespace Models;

enum UserRole: int{
    case Member = 1;
    case Moderator = 2;
    case Administrator = 3;

    function getUserRole(int $role_id): string {
        return match($role_id) {
            UserRole::Member => 'Member',
            UserRole::Moderator => 'Moderator',
            UserRole::Administrator => 'Administrator',
        };
    }
}
