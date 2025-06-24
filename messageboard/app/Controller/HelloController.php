<?php
class HelloController extends AppController {
    public function index() {
        $this->set('message', 'Hello World!');
    }
}
