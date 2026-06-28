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

        $mailerName = config('mail.default', 'smtp');
        $smtp = config("mail.mailers.{$mailerName}", []);
        $fromAddress = trim((string)config('mail.from.address', ''));
        $fromName = trim((string)(config('mail.from.name') ?? config('app.name', 'NEMO')));

        $host = trim((string)($smtp['host'] ?? ''));
        $port = (int)($smtp['port'] ?? 587);
        $username = trim((string)($smtp['username'] ?? ''));
        $password = (string)($smtp['password'] ?? '');
        $encryption = strtolower(trim((string)($smtp['encryption'] ?? '')));

        if ($encryption === '' || $encryption === 'null') {
            $encryption = $port === 465 ? 'ssl' : ($port === 587 ? 'tls' : '');
        }

        if ($host === '' || $fromAddress === '') {
            throw new \RuntimeException('Mail is not configured. Set Email Config in admin or MAIL_* in .env.');
        }

        if (in_array(strtolower($host), ['mailhog', 'localhost', '127.0.0.1'], true) && app()->environment('production')) {
            throw new \RuntimeException("Mail host [{$host}] is a development server. Update Email Config or .env on production.");
        }

        $dsn = $this->buildSmtpDsn($host, $port, $username, $password, $encryption);

        Log::info('OTP email transport', [
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

        $query = [];
        if ($encryption !== '') {
            $query[] = 'encryption=' . rawurlencode($encryption);
        }

        $queryString = $query ? '?' . implode('&', $query) : '';

        return "smtp://{$auth}{$host}:{$port}{$queryString}";
    }
}
