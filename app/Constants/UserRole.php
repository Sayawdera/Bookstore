<?php

namespace App\Constants;

class UserRole
{
    const SUPERADMIN = 'super_admin';
    const MODERATOR = 'moderator';
    const EDITOR = 'editor';
    const USER = 'user';
    const SUPERUSER = 'superuser';
    const NEWUSER = 'newuser';

    /**
     * @return string[]
     */
    public static function getRoleList(): array
    {
        return [
            self::SUPERADMIN => 'super_admin',
            self::MODERATOR => 'moderator',
            self::EDITOR => 'editor',
            self::USER => 'user',
            self::SUPERUSER => 'superuser',
            self::NEWUSER => 'newuser',
        ];
    }

    /**
     * @param string $role_code
     * @return string
     */
    public static function getRoleName(string $role_code): string
    {
        return match ($role_code) {
                self::SUPERADMIN => 'super_admin',
                self::MODERATOR => 'moderator',
                self::EDITOR => 'editor',
                self::USER => 'user',
                self::SUPERUSER => 'superuser',
                self::NEWUSER => 'newuser',
                default => '',
            };
    }
}