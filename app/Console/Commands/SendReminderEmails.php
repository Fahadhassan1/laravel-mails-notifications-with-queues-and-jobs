<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class SendReminderEmails extends Command
{
    protected $signature = 'email:send-reminders';
    protected $description = 'Send daily reminder emails to users';

    public function handle()
    {
        // Your logic here (example)
        $users = User::whereNotNull('email_verified_at')->get();

        foreach ($users as $user) {
            // Mail::to($user->email)->send(new ReminderEmail($user));
            $this->info("Reminder sent to: {$user->email}");
        }

        return Command::SUCCESS;
    }
}

