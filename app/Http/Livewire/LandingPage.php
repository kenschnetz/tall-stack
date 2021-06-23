<?php

    namespace App\Http\Livewire;

    use App\Models\Subscriber as SubscriberModel;
    use Illuminate\Auth\Notifications\VerifyEmail;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\URL;
    use Livewire\Component;

    class LandingPage extends Component {
        public $email;
        public $showSubscribe = false;
        public $showSuccess = false;

        protected $rules = ['email' => 'required|email:filter|unique:subscribers,email'];

        public function Subscribe() {
            $this->validate();
            DB::transaction(function() {
                $subscriber = SubscriberModel::create([
                    'email' => $this->email,
                ]);
                $notification = new VerifyEmail();
                $notification->createUrlUsing(function($notifiable) {
                    return URL::temporarySignedRoute(
                        'subscribers.verify',
                        now()->addMinutes(30),
                        [
                            'subscriber' => $notifiable->getKey(),
                        ]
                    );
                });
                $subscriber->notify($notification);
                $this->reset('email');
                $this->showSubscribe = false;
                $this->showSuccess = true;
            }, $deadlockRetries = 5);
        }

        public function Mount(Request $request) {
            if($request->has('verified') && $request->verified == 1) {
                $this->showSuccess = true;
            }
        }

        public function Render() {
            return view('livewire.landing-page');
        }
    }
