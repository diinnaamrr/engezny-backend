<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Email;

class OtpEmailService
{
    public function send(string $to, string $subject, string $body): void
    {
        applyBusinessMailConfig();

        $configSource = businessConfig('email_config', 'email_config')?->value ? 'admin_panel' : 'env';
        $mailerName = config('mail.default', 'smtp');
        $smtp = config("mail.mailers.{$mailerName}", []);
        $fromAddress = $this->normalizeCredential(config('mail.from.address', ''));
        $fromName = trim((string)(config('mail.from.name') ?? config('app.name', 'NEMO')));

        $host = $this->normalizeCredential($smtp['host'] ?? '');
        $port = (int)($smtp['port'] ?? 587);
        $username = $this->normalizeCredential($smtp['username'] ?? '');
        $password = $this->normalizeCredential($smtp['password'] ?? '');
        $encryption = strtolower($this->normalizeCredential($smtp['encryption'] ?? ''));

        if ($encryption === '') {
            $encryption = $port === 465 ? 'ssl' : ($port === 587 ? 'tls' : '');
        }

        if ($host === '' || $fromAddress === '') {
            throw new \RuntimeException('Mail is not configured. Set Email Config in admin or MAIL_* in .env.');
        }

        if (in_array(strtolower($host), ['mailhog', 'localhost', '127.0.0.1'], true)) {
            throw new \RuntimeException("Mail host [{$host}] is for local development only. Use a real SMTP server on production.");
        }

        $dsn = $this->buildSmtpDsn($host, $port, $username, $password, $encryption);

        Log::info('OTP email transport', [
            'source' => $configSource,
            'to' => $to,
            'host' => $host,
            'port' => $port,
            'encryption' => $encryption ?: 'none',
            'from' => $fromAddress,
            'has_auth' => $username !== '' && $password !== '',
        ]);

        $transport = Transport::fromDsn($dsn);
        $mailer = new Mailer($transport);

        $email = (new Email())
            ->from(sprintf('%s <%s>', $fromName, $fromAddress))
            ->to($to)
            ->subject($subject)
            ->text($body);

        $mailer->send($email);
    }

    private function buildSmtpDsn(string $host, int $port, string $username, string $password, string $encryption): string
    {
        $auth = '';
        if ($username !== '' && $password !== '') {
            $auth = rawurlencode($username) . ':' . rawurlencode($password) . '@';
        }

        $scheme = ($port === 465 || $encryption === 'ssl') ? 'smtps' : 'smtp';
        $query = [];

        if ($scheme === 'smtp' && $encryption === 'tls') {
            $query[] = 'encryption=tls';
        }

        $queryString = $query ? '?' . implode('&', $query) : '';

        return "{$scheme}://{$auth}{$host}:{$port}{$queryString}";
    }

    private function normalizeCredential(mixed $value): string
    {
        $value = trim((string)$value);

        return in_array(strtolower($value), ['', 'null'], true) ? '' : $value;
    }
}
