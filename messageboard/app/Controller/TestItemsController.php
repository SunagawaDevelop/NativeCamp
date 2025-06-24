<?php
class TestItemsController extends AppController {
    public $uses = array('TestItem');

    public function index() {
        $data = $this->TestItem->find('all');
        $this->set('items', $data);
    }
}

