<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SESRequest extends FormRequest
{
    // Define constants for the repeted values on verdict and dmarc
    protected const VERDICT_STATUSES = ['PASS', 'FAIL'];
    protected const DMARC_POLICIES = ['reject', 'none', 'quarantine'];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return array_merge(
            $this->getCommonRules(),
            $this->getVerdictRules()
        );
    }
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the common rules for the request.
     *
     * @return array
     */
    private function getCommonRules()
    {
        return [
            'Records' => ['required', 'array'],
            'Records.*.eventVersion' => ['required', 'string'],
            'Records.*.ses.receipt.timestamp' => ['required', 'date'],
            'Records.*.ses.receipt.processingTimeMillis' => ['required', 'integer'],
            'Records.*.ses.receipt.recipients' => ['required', 'array'],
            'Records.*.ses.receipt.recipients.*' => ['required', 'email'],
            'Records.*.ses.receipt.dmarcPolicy' => ['required', 'string', 'in:' . implode(',', self::DMARC_POLICIES)],
            'Records.*.ses.receipt.action.type' => ['required', 'string'],
            'Records.*.ses.receipt.action.topicArn' => ['required', 'string'],
            'Records.*.ses.mail.timestamp' => ['required', 'date'],
            'Records.*.ses.mail.source' => ['required', 'email'],
            'Records.*.ses.mail.messageId' => ['required', 'string'],
            'Records.*.ses.mail.destination' => ['required', 'array'],
            'Records.*.ses.mail.destination.*' => ['required', 'email'],
            'Records.*.ses.mail.headersTruncated' => ['required', 'boolean'],
            'Records.*.ses.mail.headers' => ['required', 'array'],
            'Records.*.ses.mail.headers.*.name' => ['required', 'string'],
            'Records.*.ses.mail.headers.*.value' => ['required', 'string'],
            'Records.*.ses.mail.commonHeaders.returnPath' => ['required', 'email'],
            'Records.*.ses.mail.commonHeaders.from' => ['required', 'array'],
            'Records.*.ses.mail.commonHeaders.from.*' => ['required', 'email'],
            'Records.*.ses.mail.commonHeaders.date' => ['required', 'date'],
            'Records.*.ses.mail.commonHeaders.to' => ['required', 'array'],
            'Records.*.ses.mail.commonHeaders.to.*' => ['required', 'email'],
            'Records.*.ses.mail.commonHeaders.messageId' => ['required', 'string'],
            'Records.*.ses.mail.commonHeaders.subject' => ['required', 'string'],
            'Records.*.eventSource' => ['required', 'string'],
        ];
    }

    /**
     * Get the rules for verdicts in the request.
     *
     * @return array
     */
    private function getVerdictRules()
    {
        $verdictFields = [
            'Records.*.ses.receipt.spamVerdict.status',
            'Records.*.ses.receipt.virusVerdict.status',
            'Records.*.ses.receipt.spfVerdict.status',
            'Records.*.ses.receipt.dkimVerdict.status',
            'Records.*.ses.receipt.dmarcVerdict.status'
        ];

        return array_fill_keys($verdictFields, ['required', 'string', 'in:' . implode(',', self::VERDICT_STATUSES)]);
    }
}
