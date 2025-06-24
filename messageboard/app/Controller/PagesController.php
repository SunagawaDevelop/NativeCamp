<?php
App::uses('AppController', 'Controller');

class PagesController extends AppController {

	public $uses = [];

	public function display() {
		$path = func_get_args();

		if (empty($path) || in_array('..', $path, true) || in_array('.', $path, true)) {
			throw new NotFoundException();
		}

		$page = $path[0] ?? null;
		$subpage = $path[1] ?? null;
		$title_for_layout = !empty(end($path)) ? Inflector::humanize(end($path)) : null;

		$this->set(compact('page', 'subpage', 'title_for_layout'));

		try {
			$this->render(implode('/', $path));
		} catch (MissingViewException $e) {
			if (Configure::read('debug')) {
				throw $e;
			}
			throw new NotFoundException();
		}
	}
}
