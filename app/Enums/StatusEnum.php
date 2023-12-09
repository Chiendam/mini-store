<?php declare(strict_types=1);

namespace App\Enums;


use BenSampo\Enum\Enum;

final class StatusEnum extends Enum
{
    const Inactive = 0;

    const Active = 1;

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
        foreach (StatusEnum::getInstances() as $key => $value) {
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
            self::Active => 'Hoạt động',
            self::Inactive => 'Tạm khóa',
        };
    }

    public static function getBYKey(mixed $value)
    {
        return match ($value) {
            'inactive' => self::Inactive,
            'active' => self::Active,
        };
    }
}
