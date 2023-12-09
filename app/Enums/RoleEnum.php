<?php declare(strict_types=1);

namespace App\Enums;


use BenSampo\Enum\Enum;

final class RoleEnum extends Enum
{
    const User = 2;

    const Admin = 1;

    public function name(): string
    {
        return self::getName($this);
    }

    public static function all()
    {
        return array_column(self::getInstances(), 'key', 'value');
    }

    /**
     * all
     *
     * @param null $value
     * @return mixed
     */
    public static function displayAll($value = null): mixed
    {
        $display = [];
        foreach (RoleEnum::getInstances() as $key => $value) {
            $display[] = [
                'value' => $value->value,
                'name' => self::getName($value->value)
            ];
        }
        return $display;
    }


    public static function getName($value): string
    {
        return match ($value) {
            self::Admin => 'Quản trị viên',
            self::User => 'Nhân viên',
        };
    }

    public static function getBYKey(mixed $value)
    {
        return match ($value) {
            'admin' => self::Admin,
            'user' => self::User,
        };
    }
}
