<?php

namespace App\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class SES extends DataTransferObject
{
    public Mail $mail;
    public Receipt $receipt;
}
