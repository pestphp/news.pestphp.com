<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Mailcoach\Domain\Audience\Models\EmailList;

final class MailingListSeeder extends Seeder
{
    public function run(): void
    {
        EmailList::create(['name' => 'Pest Newsletter']);
    }
}
