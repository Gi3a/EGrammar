<?php

namespace application\controllers;

use application\core\Controller;
use application\lib\Pagination;

use application\models\Main;
use application\models\User;

class MainController extends Controller {

	
	public function mainAction() {
		$user = new User;
		if (!$_SESSION)
			$this->view->redirect('');
		


		$status = $user->getStatusUser($_SESSION['user']['id']);
		$progress = $this->model->getProgressInfo($status);
		if ($progress > 100)
			$this->view->redirect('logs');
		$test = $this->model->getTestInfo($status);
		$words = explode(" ", $test[0]['text_en']);

		
		$vars = [
			'progress' => $progress,
			'description' => $test[0]['text_ru'],
			'words' => $this->model->shuffleTestWords($words),
		];

		$this->view->render('English Grammar - проверить знание грамматики английского языка', $vars);
	}

	public function logsAction()
	{
		$user = new User;
		if (!$_SESSION)
			$this->view->redirect('');
		
		
		$status = $user->getStatusUser($_SESSION['user']['id']);
		$vars = [
			'progress' => $this->model->getProgressInfo($status),
			'logs' => $this->model->getLogs($_SESSION['user']['id']),
		];

		
		$this->view->render('Результаты | EGrammar', $vars);
	}

	public function resetAction()
	{
		$this->model->resetUset($_SESSION['user']['id']);
		$this->view->redirect('');
	}


	public function checkAction()
	{
		$user = new User;
		if (($_SERVER['REQUEST_METHOD'] == 'POST') && (!empty($_POST))) {
			
			
			$props = explode(" ", $_POST['props']);
			$status = $user->getStatusUser($_SESSION['user']['id']);
			$result = $user->getResultUser($_SESSION['user']['id']);
			$test = $this->model->getTestInfo($status);
			$words = explode(" ", $test[0]['text_en']);


			$correct;
			$j = 0;
			$l = 0;
			$un = 0;
			$corr_count = 0;
			$str = '';
			$str_clear = '';
			for ($i = 0; $i <= count($words); $i++)
			{
				if (!empty($props[$i]))
				{
					
					if ($props[$i] == $words[$j])
					{
						$correct[$l] = 1;
						$l++;
						$j++;
						$corr_count++;
						$str = $str."<span class='swal_green'>".$props[$i]." </span>";
					}
					else {
						$correct[$l] = 0;
						$l++;
						$j++;
						$str = $str."<span class='swal_red'>".$props[$i]." </span>";
					}
					$str_clear = $str_clear ." ". $props[$i];
					$un++;
				}
			}

			
			$text = 'Вы набрали ['.$str_clear.'] , правильный вариант ['.implode(" ", $words).']';

			if ($un != count($words))
				$this->view->message('error', 'Выберите все элементы из нижнего блока!', '');
			else if ($corr_count == count($words))
			{
				
				$this->model->setTestResult($_SESSION['user']['id'], 1, $str);
				$this->view->teleport(
					'success', // Type
					'main', // URL
					'Все правильно', // Title
					'' // Text
				);
			}
			else
			{
				$this->model->setTestResult($_SESSION['user']['id'], 0, $str);
				$this->view->teleport(
					'error', // Type
					'main', // URL
					'Допущены ошибки', // Title
					$text // Text
				);
			}

		}
	}


}