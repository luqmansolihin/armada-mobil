<?php

namespace App\Enums;

enum ContactTypeEnum: string
{
    case PHONE = 'Phone';
    case FAX = 'Fax';
    case EMAIL = 'Email';
    case TWITTER = 'Twitter';
    case FACEBOOK = 'Facebook';
    case YOUTUBE = 'Youtube';
    case INSTAGRAM = 'Instagram';
}
