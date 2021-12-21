<?php

declare(strict_types=1);

use App\Contracts\Actions\Newsletters\SendsNewsletter;
use App\Jobs\SendNewsletter;
use Spatie\Mailcoach\Database\Factories\CampaignFactory;

it('sends the newsletter', function () {
    $campaign = CampaignFactory::new()->create();

    $this->expectToUseAction(SendsNewsletter::class)
        ->withArgs(fn ($givenCampaign) => $givenCampaign->is($campaign));

    SendNewsletter::dispatchSync($campaign);
});
