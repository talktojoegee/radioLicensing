<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointment_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('org_id')->nullable();
            $table->tinyInteger('avail_by_appt_type')->default(1)->comment('Availability by Appointment Type');
            $table->tinyInteger('avail_by_location')->default(1)->comment('Availability by Location');
            $table->tinyInteger('avail_by_contact_type')->default(1)->comment('Availability by Contact Type');

            $table->string('supported_contact_types')->default(1)->comment('Supported Contact Types');
            $table->tinyInteger('init_phone_call_appt')->default(1)->comment('Initiates Phone Call Appointments 1=Provider will call client,2=Client should call');

            $table->tinyInteger('pre_same_day_appt')->default(1)->comment('Prevent Same Day Appointments. 1=Yes | 0=No');
            $table->integer('appt_buffer')->default(0)->comment('Appointment Buffer');
            $table->tinyInteger('only_allow_appt_spec_intervals')->default(1)->comment('Only Allow Appointments at Specific Intervals 1=Anytime,2=30min interval,3=1hr interval');
            $table->integer('min_time_advance')->default(0)->comment('Minimum Time in Advance - minutes 0=no limit');
            $table->integer('max_time_advance')->default(0)->comment('Maximum Time in Advance');
            $table->time('calendar_start')->nullable()->comment('Calendar Display Default View - Start');
            $table->time('calendar_end')->nullable()->comment('Calendar Display Default View - End');

            $table->tinyInteger('send_init_notice_email')->default(1)->comment('Send Initial Notice Email to Clients - 1=1hrBefore,2=2hrsBefore,3=1dayBefore,4=2daysBefore,5=3daysBefore,6=4daysBefore');
            $table->tinyInteger('client_email_reminder')->default(1)->comment('Client Email Reminders Active - 1=1hrBefore,2=2hrsBefore,3=1dayBefore,4=2daysBefore,5=3daysBefore,6=4daysBefore');
            $table->tinyInteger('client_sms_reminder')->default(1)->comment('Client Text Reminders Active - 1=Yes | 0=No');
            $table->tinyInteger('client_form_reminder')->default(1)->comment('Client Intake Form Reminder Active - 1=Yes | 0=No');

            $table->tinyInteger('client_can_cancel_appt')->default(1)->comment('Clients Can Cancel Appointment - 1=Yes | 0=No');
            $table->tinyInteger('client_can_reschedule_appt')->default(0)->comment('Clients Can Reschedule - 1=Yes | 0=No');
            $table->tinyInteger('require_client_confirm_appt')->default(0)->comment('Require Clients to Confirm your Appointments - 1=Yes | 0=No');
            $table->tinyInteger('auto_confirm_appt')->default(0)->comment('Automatically Confirm Appointments - 1=Yes | 0=No');
            $table->tinyInteger('client_can_cancel_appt_via_txt')->default(0)->comment('Clients Can Confirm or Cancel via Text Message - 1=Yes | 0=No');
            $table->tinyInteger('allow_book_without_credits')->default(1)->comment('Allow Booking Without Credits - 1=Yes | 0=No');
            $table->tinyInteger('restore_credit_when_appt_cancelled')->default(0)->comment('Restore Credit When an Appointment is Cancelled - 1=Yes | 0=No');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointment_settings');
    }
};
