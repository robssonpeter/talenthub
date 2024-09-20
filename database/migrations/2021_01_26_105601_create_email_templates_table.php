<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\EmailTemplate;

class CreateEmailTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable("email_templates"))
            Schema::create('email_templates', function (Blueprint $table) {
                $table->id();
                $table->integer('company_id', false)->nullable();
                $table->string('name');
                $table->string('type');
                $table->text('content');
                $table->integer('created_by', false)->nullable();
                $table->timestamps();
            });
            $samples = [
                [
                    'name' => 'Sample Interview Schedule Email',
                    'content' =>   '<p>Dear [first_name],</p>
                                    <p>Thank you for applying to <strong>[company_name]</strong>.</p>
                                    <p>Your application for the <strong>[job_title]</strong> position stood out to us and we would like to invite you for an interview to get to know you a bit better.</p>
                                    <p>You are required to show up for the interview on <strong>[interview_date]</strong> at <strong>[interview_time]</strong>.</p>
                                    <p>Venue: <strong>[interview_venue]</strong></p>
                                    <p>Looking forward to hearing from you,</p>
                                    <p>Kind regards</p>
                                    <p><strong>[company_name]</strong></p>',
                    'type'  => 'interview_schedule'
                ],
                [
                    'name' => 'Sample Application Rejection Email',
                    'content' =>   '<p>Dear <strong>[first_name]</strong>,</p>
                                    <p>Thank you for taking the time to consider <strong>[company_name]</strong>. We have reviewed your application and we regret to inform you that we are not able to advance you to the next round for the [job_title] position at this time.</p>
                                    <p>We encourage you to apply again in the future, if you find an open role at our company that suits you.</p>
                                    <p>Thank you again for applying to <strong>[company_name]</strong> and we wish you all the best in your job search.</p>
                                    <p>Kind Regards,</p>',
                    'type'  => 'application_rejection'
                ]
            ];
            foreach($samples as $sample){
                EmailTemplate::create($sample);
            }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('email_templates');
    }
}
