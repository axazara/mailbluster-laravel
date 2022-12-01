# Lead
To learn more about the API, visit [MailBluster API - Leads](https://app.mailbluster.com/api-doc/leads)

## Create a lead
`createLead` method is used to create a lead in MailBluster.

```php
MailBluster::createLead(string $email, bool $subscribed = true, array $options = []
```

- `$email`- Email address of the lead
- `$subscribed` - Lead is subscribed to receive email or not, defaults value is `true`
- `$options` - Array of additional options to pass to the API

>Available options are :
>- `firstName` - First name of the lead
>- `lastName` - Last name of the lead
>- `timezone` - Phone number of the lead
>- `ipAddress` - IP address of the lead
>- `tags` - Array of tags to add to the lead
>- `fields` - Array of custom fields to add to the lead
>- `doubleOptIn` - Send double opt-in email to the lead, defaults value is `false`
>- `overrideExisting` - Override existing lead if already exists, defaults value is `false`
>To learn more about the API, visit [MailBluster API - Create lead](https://app.mailbluster.com/api-doc/leads)
 
If request is successful, it returns object with lead details, otherwise it return `null` and you can get the error message by calling `getLastError()` method.



## Read a lead
'readLead' method is used to read a lead from MailBluster.

```php
MailBluster::readLead(string $email)
```
**$email** - Email address of the lead
If request is successful, it returns object with lead details, otherwise it return `null` and you can get the error message by calling `getLastError()` method.


## Update a lead
`updateLead` method is used to update a lead in MailBluster.

```php
MailBluster::updateLead(string $email, array $options = [])
```
- `$email` - Email address of the lead
- `$options` - Array of additional options to pass to the API

>Available options are :
>- `firstName` - First name of the lead
>- `lastName` - Last name of the lead
>- `timezone` - Phone number of the lead
>- `ipAddress` - IP address of the lead
>- `tags` - Array of tags to add to the lead
>- `fields` - Array of custom fields to add to the lead
>- `doubleOptIn` - Send double opt-in email to the lead, defaults value is `false`
>- `overrideExisting` - Override existing lead if already exists, defaults value is `false`
>To learn more about the API, visit [MailBluster API - Create lead](https://app.mailbluster.com/api-doc/leads)

If request is successful, it returns object with lead details, otherwise it return `null` and you can get the error message by calling `getLastError()` method.

## Delete a lead
`deleteLead` method is used to delete a lead from MailBluster.

```php
MailBluster::deleteLead(string $email)
```

- `$email` - Email address of the lead

If request is successful, it returns `true`, otherwise it return `false` and you can get the error message by calling `getLastError()` method.

## Example of usage

```php
use Axazara\MailblusterLaravel\Facades\MailBluster;

$lead = MailBluster::createLead('jack@example.com', true, [
    'firstName' => 'Jack',
    'lastName' => 'Smith',
    'timezone' => 'America/New_York',
    ]
);

if ($lead) {
    // Lead created successfully
    $lead->id; // Unique ID of the lead in MailBluster
    $lead->email; // Email address of the lead
    $lead->firstName; // First name of the lead
    $lead->lastName; // Last name of the lead
    $lead->timezone; // Timezone of the lead
    $lead->ipAddress; // IP address of the lead
    $lead->tags; // Array of tags of the lead
    
} else {
    $error = MailBluster::getLastError();
}
```

## Credits
- [Axa Zara](https://axazara.com)
- [Elias Elimah](https://gitlab.com/EliasElimah)

## Copyright
[MailBluster](https://mailbluster.com) is not affiliated with [Axa Zara](https://axazara.com).
All rights reserved.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
