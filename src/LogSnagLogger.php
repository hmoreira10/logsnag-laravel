<?php

namespace LogSnag\Logger;

use Monolog\Logger;

class LogSnagLogger
{
    public function __invoke(array $config)
    {
        return new Logger('logsnag', [
            new LogSnagHandler(
                Logger::toMonologLevel($config['level'] ?? 'debug'),
                true,
                $config['token'] ?? '',
                $config['project'] ?? ''
            )
        ]);
    }
}