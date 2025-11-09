<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;
use App\Models\Appointment;

class SendWhatsAppReminderJob implements ShouldQueue
{
    use Queueable;

    public $appointment;

    /**
     * Create a new job instance.
     */
    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $message = "Hello {$this->appointment->first_name}, this is a reminder for your treatment in 2 hours at Revola Skin & Hair Clinic.";
        $phone = $this->appointment->mobile;

        Http::get("https://wa.me/{$phone}?text=" . urlencode($message));
    }
}
