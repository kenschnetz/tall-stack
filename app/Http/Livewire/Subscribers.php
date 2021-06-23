<?php

    namespace App\Http\Livewire;

    use App\Models\Subscriber as SubscriberModel;
    use Livewire\Component;

    class Subscribers extends Component {

        public $search;

        protected $queryString = [
            'search' => ['except' => '']
        ];

        public function Delete(SubscriberModel $subscriber) {
            $subscriber->delete();
        }

        public function Render() {
            $subscribers = SubscriberModel::where('email', 'like', "%{$this->search}%")->get();

            return view('livewire.subscribers')->with([
                'subscribers' => $subscribers,
            ]);
        }
    }
