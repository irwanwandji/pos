<?php

namespace App\Jobs;

use App\Mail\PromotionMail;
use App\Models\Promotion;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class PromotionMailCreatedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $promotion;
    protected $mailTo;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Promotion $promotion, $mailTo)
    {
        $this->promotion = $promotion;
        $this->mailTo = $mailTo;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->mailTo)->send(new PromotionMail($this->promotion));
    }
}
