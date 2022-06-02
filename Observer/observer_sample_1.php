<?php

namespace DesignPatterns\ABC;

interface Subscriber{
    function update();
}

class User implements Subscriber
{
    private $name;
    private $channel;

    public function __construct($name) {
        $this->channel = new Channel();
        $this->name = $name;
    }

    public function update() {
        echo 'Hey ' . $this->name .', New Video added --> '. $this->channel->title;
    }
}

class Channel {
    private $sublist = [];
    public $title = '';

    public function subscribe(User $subscriber) {
        array_push($this->sublist, $subscriber);
    }

    public function unsubscribe(User $subscriber) {
        //unset($this->sublist, $subscriber);
    }

    public function notify() {
        foreach ($this->sublist as $sub) {
            $sub->update();
        }
    }

    public function upload($title) {
        $this->title = $title;
        $this->notify();
    }
}

function init() {
    $channel = new Channel();
    $user = new User('Ruwanthi');
    $channel->subscribe($user);

    $channel->upload('Thanos');
    echo "\n\n";
}

init();
