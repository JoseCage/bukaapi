<?php

namespace Buka\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Buka\Teacher;

class TeacherCreated extends Mailable
{
    use Queueable, SerializesModels;

    protected $teacher;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Teacher $teacher)
    {
        $this->teacher = $teacher;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mails.teacher_created')
                ->with([
                    'url' => env('APP_URL'),
                    'teacherName' => $this->teacher->first_name .' '. $this->teacher->last_name,
                    'teacherEmail' => $this->teacher->email
                ]);
    }
}
