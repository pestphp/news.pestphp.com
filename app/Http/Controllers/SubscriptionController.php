<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\Actions\Subscriptions\CreatesSubscription;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class SubscriptionController extends Controller
{
    public function subscribe(Request $request, CreatesSubscription $createsSubscription): RedirectResponse
    {
        $createsSubscription->handle($request->only(['email', 'first_name', 'last_name']));

        return redirect(route('home'))->with(self::FLASH_MESSAGE, 'Thank you for subscribing!');
    }
}
