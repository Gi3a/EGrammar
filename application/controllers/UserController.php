<?php

namespace application\controllers;

use application\core\Controller;
use application\lib\Pagination;

use application\models\Main;
use application\models\Auth;


class UserController extends Controller {

	/* --- Profile PATH --- */
	// Profile Action //
	public function userAction(){
		$main = new Main;
		if (!$_SESSION)
			$this->view->redirect('');
		
		
		$status = $this->model->getStatusUser($_SESSION['user']['id']);
		$vars = [
			'progress' => $main->getProgressInfo($status),
			'logs' => $main->getLogs($_SESSION['user']['id']),
			'user' => $this->model->getUserInfo($_SESSION['user']['id'])[0]
		];

		
		$this->view->render('Пользователь | EGrammar', $vars);
	}

	/* --- Auth PATH --- */
	// Join Action //
	public function joinAction() {
		if ($_SESSION)
			$this->view->redirect('main');
		$auth = new Auth;
		if (($_SERVER['REQUEST_METHOD'] == 'POST') && (!empty($_POST))) {
			// Validate post
			if(!$auth->validate(['name'], $_POST))
				$this->view->message('error', $auth->title, $auth->message);
		
			// Exsitence Name
			else if($auth->isNameExist($_POST['name']))
			{
				$this->model->login($_POST['name']);
				$this->view->teleport(
					'success', // Type
					'main', // URL
					'Добро пожаловать ' . $_POST['name'], // Title
					'Ваш результат ' .  $_SESSION['user']['status']// Text
				);
			}
			// Join User Func
			$joinStatus = $this->model->join($_POST);
			// Check if User Func = true
			if (($joinStatus != 0) or (!empty($joinStatus))) {
				$this->model->login($_POST['name']);
				$this->view->teleport(
					'success', // Type
					'main', // URL
					'Регистрация прошла успешна', // Title
					'Вам доступен тест для прохождения' // Text
				);
			} else { $this->view->message('error', 'Произошла ошибка', 'Мы уже работаем над ней'); } 

		}

		$this->view->render('Регистрация | EGrammar');
	}

	/* Exit Action */
	public function exitAction() {
		$this->model->logout();
		$this->view->redirect('');
	}

}