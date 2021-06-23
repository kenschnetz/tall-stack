<?php

    namespace App\Http\Controllers;

    use App\Models\Subscriber;

    class SubscriberController extends Controller {
        public function Verify(Subscriber $subscriber) {
            if(! $subscriber->hasVerifiedEmail()) {
                $subscriber->markEmailAsVerified();
            }
            return redirect('/?verified=1');
        }
    }
