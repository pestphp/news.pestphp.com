<?php

declare(strict_types=1);

namespace App\Actions\Newsletters;

use App\Actions\Models\LoadPosts\LoadPublishedPosts;
use App\Contracts\Actions\Newsletters\CreatesNewsletter;
use Spatie\Mailcoach\Domain\Audience\Models\EmailList;
use Spatie\Mailcoach\Domain\Campaign\Models\Campaign;

final class CreateNewsletter implements CreatesNewsletter
{
    public function __construct(
        private EmailList $emailList,
        private string $fromEmail,
    ) {
    }

    public function handle(): ?Campaign
    {
        $postsFromLastWeek = (new LoadPublishedPosts())->handle()->where('publish_date', '>', now()->subWeek())->get();

        if ($postsFromLastWeek->isEmpty()) {
            return null;
        }

        $campaign = Campaign::query()->create([
            'from_email' => $this->fromEmail,
            'subject' => 'Pest Newsletter',
            'html' => view('newsletter.content', ['posts' => $postsFromLastWeek])->render(),
            'email_list_id' => $this->emailList->getKey(),
        ]);

        return $campaign;
    }
}
