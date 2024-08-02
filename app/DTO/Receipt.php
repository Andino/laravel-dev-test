<?php

namespace App\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class Receipt extends DataTransferObject
{
    public int $processingTimeMillis;
    public Verdict $spamVerdict;
    public Verdict $virusVerdict;
    public Verdict $spfVerdict;
    public Verdict $dkimVerdict;
    public Verdict $dmarcVerdict;
}
