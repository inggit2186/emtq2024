<?php

namespace App\Http\Controllers;

use Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use NotificationChannels\Telegram\TelegramUpdates;
use NotificationChannels\Telegram\TelegramMessage;
use Illuminate\Notifications\Notification;

class TelegramBotController extends Controller
{
    public function updatedActivity()
    {
        // Response is an array of updates.
		$updates = TelegramUpdates::create()
			// (Optional). Get's the latest update. NOTE: All previous updates will be forgotten using this method.
			// ->latest()
			
			// (Optional). Limit to 2 updates (By default, updates starting with the earliest unconfirmed update are returned).
			->limit(2)
			
			// (Optional). Add more params to the request.
			->options([
				'timeout' => 0,
			])
			->get();

		if($updates['ok']) {
			// Chat ID
			$chatId = $updates['result'][0]['message']['chat']['id'];
		}
    }
	
	public function sendnotif()
    {

        return TelegramMessage::create()
            // Optional recipient user id.
            ->to($notifiable->telegram_user_id)
            // Markdown supported.
            ->content("Hello there!\nYour invoice has been *PAID*")

            // (Optional) Blade template for the content.
            // ->view('notification', ['url' => $url])

            // (Optional) Inline Buttons
            ->button('View Invoice', $url)
            ->button('Download Invoice', $url)
            // (Optional) Inline Button with callback. You can handle callback in your bot instance
            ->buttonWithCallback('Confirm', 'confirm_invoice ' . $this->invoice->id);
    }
}
