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

    public function __construct($level = Logger::DEBUG, bool $bubble = true, $token = '', $project = '')
    {
        parent::__construct($level, $bubble);
        $this->token = $token;
        $this->project = $project;
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
                'channel' => 'event-sources',
            ]);
    }
}