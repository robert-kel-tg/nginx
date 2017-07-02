<?php

namespace MyApp\Application\Command;

use Jlinn\Mandrill\Mandrill;
use Jlinn\Mandrill\Struct\Message;
use Jlinn\Mandrill\Struct\Recipient;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class SendTestEmailCommand
 * @package MyApp\Application\Command
 */
class SendTestEmailCommand extends Command
{
    /**
     * @var Mandrill
     */
    private $mailClient;

    /**
     * SendTestEmailCommand constructor.
     * @param Mandrill $mailClient
     */
    public function __construct(Mandrill $mailClient)
    {
        $this->mailClient = $mailClient;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('app:send-email')

            // the short description shown while running "php bin/console list"
            ->setDescription('Sends a test email.')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command to send a test email...')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // To send email
        $message = new Message();
        $message->text = 'One more email from Mandrill';
        $message->subject = 'Mandrill API Test';
        $message->from_email = 'aus12112@kelrobert.net';
        $message->from_name = 'Mandrill API';
        $message->track_opens = true;

        $recipient = new Recipient();
        $recipient->email = 'kel.robert@gmail.com';
        $recipient->name = 'Robert';
        $recipient->addMergeVar('NAME', $recipient->name);

        $message->addRecipient($recipient);

        $response = $this->mailClient->messages()->send($message);

        // Check from $response that email was sent

        // To check send email details
//        $response = $this->mailClient->messages()->info('565e301f864048b6834719a8f2a5c680');

        // outputs a message without adding a "\n" at the end of the line
        $output->write('Email was sent.');
    }
}