<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class Receipt extends Data
{
    public function __construct(
        public int $processingTimeMillis,
        public Verdict $spamVerdict,
        public Verdict $virusVerdict,
        public Verdict $spfVerdict,
        public Verdict $dkimVerdict,
        public Verdict $dmarcVerdict
    ) {
    }

    /**
     * Determine if the email is classified as spam.
     *
     * @return bool
     */
    public function isSpam(): bool
    {
        return $this->spamVerdict->status === 'PASS';
    }

    /**
     * Determine if the email has passed the virus check.
     *
     * @return bool
     */
    public function isVirusFree(): bool
    {
        return $this->virusVerdict->status === 'PASS';
    }

    /**
     * Determine if the email has passed all DNS checks (SPF, DKIM, DMARC).
     *
     * @return bool
     */
    public function hasPassedDnsCheck(): bool
    {
        return collect([
            $this->spfVerdict->status,
            $this->dkimVerdict->status,
            $this->dmarcVerdict->status,
        ])->every(fn($status) => $status === 'PASS');
    }
}
