<?php

namespace Tots\EmailTSend\Transports;

use Symfony\Component\Mailer\SentMessage;
use Symfony\Component\Mailer\Transport\AbstractTransport;
use Symfony\Component\Mime\MessageConverter;
use Tots\Email\Services\TotsEmailService;
use Tots\EmailTSend\Services\TotsSendService;

class TotsSendTransport extends AbstractTransport
{
    public function __construct(
        protected TotsEmailService $client,
    ) {
        parent::__construct();
    }

    protected function doSend(SentMessage $message): void
    {
        $email = MessageConverter::toEmail($message->getOriginalMessage());

        $this->client->sendRaw($email->getTo()[0]->getAddress(), $email->getSubject(), $email->getHtmlBody(), [], $email->getTextBody());
    }

    /**
     * Get the string representation of the transport.
     */
    public function __toString(): string
    {
        return 'tots_send';
    }
}
