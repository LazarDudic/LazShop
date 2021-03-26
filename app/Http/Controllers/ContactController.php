<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Jobs\SendEmail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    public function showContactForm()
    {
        $reCaptcha = config('app.recaptcha_key');

        return view('contact', compact('reCaptcha'));
    }

    public function sendEmail(ContactFormRequest $request)
    {
        $email = new ContactMail($request->validated());
        $emailJob = (new SendEmail($email))->delay(now()->addSeconds(10));
        dispatch($emailJob);

        return redirect(route('contact.form'))
            ->withSuccess('Your message has been sent successfully. We will get back to you soon!');
    }
}
