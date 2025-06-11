<?php

App::uses('AppModel', 'Model');

class Conversation extends AppModel {
    public $belongsTo = 'Message';
}