<?php

namespace LogSnag\Logger;

use Illuminate\Support\Facades\Http;
use Monolog\Logger;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\LogRecord;

class LogSnagHandler extends AbstractProcessingHandler
{
    protected $token;
    protected $project;

    protected $channel;

    public function __construct($level = Logger::DEBUG, bool $bubble = true, $token = '', $project = '', $channel = '')
    {
        parent::__construct($level, $bubble);
        $this->token = $token;
        $this->project = $project;
        $this->channel = $channel;
    }

    protected function write(LogRecord $record): void
    {
        $context = $record->context;
        Http::withToken($this->token)
            ->post('https://api.logsnag.com/v1/log', [
                'project' => $this->project,
                'event' => $record->message,
                'icon' => '📘',
                'notify' => $context['notify'] ?? false,
                'channel' => $this->channel,
            ]);
    }
}