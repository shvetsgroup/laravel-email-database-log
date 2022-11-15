<?php

namespace ShvetsGroup\LaravelEmailDatabaseLog;

use Carbon\Carbon;
use Symfony\Component\Mime\Email;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Mime\Part\DataPart;
use Illuminate\Mail\Events\MessageSending;

class EmailLogger
{
	/**
	 * Handle the actual logging.
	 *
	 * @param MessageSending $event
	 * @return void
	 */
	public function handle(MessageSending $event): void
	{
		$message = $event->message;

		DB::table('email_log')->insert([
			'date' => Carbon::now()->format('Y-m-d H:i:s'),
			'from' => $this->formatAddressField($message, 'From'),
			'to' => $this->formatAddressField($message, 'To'),
			'cc' => $this->formatAddressField($message, 'Cc'),
			'bcc' => $this->formatAddressField($message, 'Bcc'),
			'subject' => $message->getSubject(),
			'body' => $message->getBody()->bodyToString(),
			'headers' => $message->getHeaders()->toString(),
			'attachments' => $this->saveAttachments($message),
            'message_id' => substr($this->getMessageId($message), 0, 255)
		]);
	}

	/**
	 * Format address strings for sender, to, cc, bcc.
	 *
	 * @param Email $message
	 * @param string $field
	 * @return null|string
	 */
	function formatAddressField(Email $message, string $field): ?string
	{
		$headers = $message->getHeaders();

		$field = $headers->get($field)?->getBodyAsString();
        return $field ? substr($field, 0, 255) : null;
	}

	/**
	 * Collect all attachments and format them as strings.
	 *
	 * @param Email $message
	 * @return string|null
	 */
	protected function saveAttachments(Email $message): ?string
	{
		if (empty($message->getAttachments())) {
			return null;
		}

		return collect($message->getAttachments())
			->map(fn(DataPart $part) => $part->toString())
			->implode("\n\n");
	}

    function getMessageId($message) {
        $header = $message->getHeaders()->get('Message-ID');
        return $header ? $header->getId() : null;
    }
}
