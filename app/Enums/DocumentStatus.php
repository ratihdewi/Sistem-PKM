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
}
