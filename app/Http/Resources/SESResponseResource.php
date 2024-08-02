<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SESResponseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'spam' => $this->ses->receipt->isSpam(),
            'virus' => $this->ses->receipt->isVirusFree(),
            'dns' => $this->ses->receipt->hasPassedDnsCheck(),
            'mes' => $this->getMonth($this->ses->mail->timestamp),
            'retrasado' => $this->isDelayed($this->ses->receipt->processingTimeMillis),
            'emisor' => $this->getUserFromEmail($this->ses->mail->source),
            'receptor' => $this->getUsersFromEmails($this->ses->mail->destination),
        ];
    }

    /**
     * Extract the month from the timestamp.
     *
     * @param string $timestamp
     * @return string
     */
    protected function getMonth(string $timestamp): string
    {
        return \Carbon\Carbon::parse($timestamp)->format('F'); // Devuelve el nombre del mes en inglés
    }

    /**
     * Determine if the processing time is greater than 1000 ms.
     *
     * @param int $processingTimeMillis
     * @return bool
     */
    protected function isDelayed(int $processingTimeMillis): bool
    {
        return $processingTimeMillis > 1000;
    }

    /**
     * Get the user part from an email address.
     *
     * @param string $email
     * @return string
     */
    protected function getUserFromEmail(string $email): string
    {
        return explode('@', $email)[0];
    }

    /**
     * Get the user parts from a list of email addresses.
     *
     * @param array $emails
     * @return array
     */
    protected function getUsersFromEmails(array $emails): array
    {
        return array_map(function ($email) {
            return $this->getUserFromEmail($email);
        }, $emails);
    }
}
