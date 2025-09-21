<?php

namespace App\Enums;

enum Subject: string
{
    case COMPUTER_SCIENCE_IT = 'Computer_Science';
    case MEDICINE = 'medicine';
    case MANAGEMENT = 'management';
    case ACCOUNTING = 'accounting';
    case FINANCE = 'finance';
    case ECONOMICS = 'economics';
    case MARKETING = 'marketing';
    case MATHEMATICS = 'mathematics';
    case ENGINEERING = 'engineering';
    case LAW = 'law';
    case OTHER = 'other';

    public static function values(): array
    {
        return [
            self::COMPUTER_SCIENCE_IT->value => 'Computer Science (IT,Software Engineering)',
            self::MEDICINE->value => 'Medicine (Nursing, Pharmacy, Laboratory)',
            self::MANAGEMENT->value => 'Management',
            self::ACCOUNTING->value => 'Accounting',
            self::FINANCE->value => 'Finance',
            self::ECONOMICS->value => 'Economics',
            self::MARKETING->value => 'Marketing',
            self::MATHEMATICS->value => 'Mathematics',
            self::ENGINEERING->value => 'Engineering',
            self::LAW->value => 'Law',
            self::OTHER->value => 'Other',
        ];
    }
}
