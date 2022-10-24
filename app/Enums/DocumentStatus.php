<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class DocumentStatus extends Enum
{
    const Submitted = "submitted";
    const NotSubmitted = "not_submitted";
    const Revision = "revision";
    const Approved = "approved";

    public static function getDescription($value): string
    {
        if ($value === self::Submitted) {
            return 'Sudah Submit';
        } elseif ($value === self::NotSubmitted) {
            return 'Belum Submit';
        } elseif ($value === self::Revision) {
            return 'Revisi';
        } elseif ($value === self::Approved) {
            return 'Disetujui';
        }

        return parent::getDescription($value);
    }
}
