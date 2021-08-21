<?php

namespace application\models;

use application\core\Model;


class Auth extends Model {

	public $error;

	public function validate($input, $post){
		$rules = [
			'name' => [
				'pattern' => '#^[а-яА-ЯёЁa-zA-z ]{2,50}$#u',
				'title' => 'Имя указан неверно',
				'message' => 'Можно использовать буквы латинского и кириллистического алфавита (от 2 до 50 символов)',
			],
		];

		foreach ($input as $val) {
			if (!isset($post[$val]) or !preg_match($rules[$val]['pattern'], $post[$val])) {
				$this->title = $rules[$val]['title'];
				$this->message = $rules[$val]['message'];
				return false;
			}
		}
		return true;
	}

	// Name Exists
	public function isNameExist($name){
		$params = ['name' => $name];
		return $this->db->column('SELECT id FROM users WHERE name = :name', $params);
	}



}