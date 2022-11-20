<?php

namespace AxaZara\MailBluster\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \AxaZara\MailBluster\MailBluster createLead(string $email, bool $subscribed = true, array $fields = [])
 * @method static \AxaZara\MailBluster\MailBluster readLead(string $email)
 * @method static \AxaZara\MailBluster\MailBluster updateLead(string $email, array $fields = [])
 * @method static \AxaZara\MailBluster\MailBluster deleteLead(string $email)
 * @method static \AxaZara\MailBluster\MailBluster createField(string $label, string $tag)
 * @method static \AxaZara\MailBluster\MailBluster getFields()
 * @method static \AxaZara\MailBluster\MailBluster updateField(string $id, string $label, string $tag)
 * @method static \AxaZara\MailBluster\MailBluster deleteField(string $id)
 * @method static \AxaZara\MailBluster\MailBluster createProduct(string $id, string $name)
 * @method static \AxaZara\MailBluster\MailBluster getProducts()
 * @method static \AxaZara\MailBluster\MailBluster getProduct(string $id)
 * @method static \AxaZara\MailBluster\MailBluster updateProduct(string $id, string $name)
 * @method static \AxaZara\MailBluster\MailBluster deleteProduct(string $id)
 * @method static \AxaZara\MailBluster\MailBluster getLastError()
 */
class MailBluster extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'mailbluster';
    }
}
