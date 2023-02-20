<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdmissionsOnlineRequest;



class sendAdmissionsMailJob implements ShouldQueue
{
    protected $admissionInfo;
    protected $mailTo;

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Array $admissionInfo, String $mailTo)
    {
        $this->admissionInfo    = $admissionInfo;
        $this->mailTo           = $mailTo;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $info = $this->admissionInfo;

        Mail::to($this->mailTo)->send(new AdmissionsOnlineRequest($info));
    }
}
