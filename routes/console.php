<?php

use App\Models\Cart;
use Carbon\Carbon;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('cart:cleanup', function () {
    $thresholdDate = Carbon::now()->subDays(30);

    // Task Schedule to Find and delete carts that haven't been updated in the last 30 days
    $deletedCarts = Cart::where('updated_at', '<', $thresholdDate)->delete();

    // Log how many carts were deleted
    Log::info('Cart cleanup completed. Deleted ' . $deletedCarts . ' old carts.');
})->describe('Clean up stagnant carts older than 30 days');
