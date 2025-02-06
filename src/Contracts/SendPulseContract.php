<?php

namespace IvanSabat\SendPulse\Contracts;

interface SendPulseContract
{
    public static function listAddressBooks(): ?array;
    public static function addEmails(int $bookId, array $emails, array $additionalParams = []): ?array;
    public static function updateEmailVariables(int $bookId, string $email, array $vars): ?array;
}