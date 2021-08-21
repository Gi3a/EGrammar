<?php

namespace application\models;

use application\core\Model;


class User extends Model {

	public $error;


	// Join Func
	public function join($post) {
		$params = [
			'id' => '0',
			'name' => trim(htmlspecialchars($post['name'])),
			'role' => 'user',
			'result' => NULL,
			'status' => 1,
		];
		$this->db->query('INSERT INTO users VALUES (:id, :name, :role, :result, :status)', $params);
		return $this->db->lastInsertId();
	}
	// Login Func
	public function login($name) {
		$params = [
			'name' => trim(htmlspecialchars($name)),
		];
		$data = $this->db->row('SELECT * FROM users WHERE name = :name', $params);
		$_SESSION['user'] = $data[0];
	}

	public function getStatusUser($id) {
		$params = [
			'id' => trim(htmlspecialchars($id)),
		];
		return $this->db->column('SELECT status FROM users WHERE id = :id', $params);
	}

	public function getResultUser($id) {
		$params = [
			'id' => trim(htmlspecialchars($id)),
		];
		return $this->db->column('SELECT result FROM users WHERE id = :id', $params);
	}

	public function getUserInfo($id)
	{
		$params = [
			'id' => trim(htmlspecialchars($id)),
		];
		return $this->db->row('SELECT * FROM users WHERE id = :id', $params);
	}

	// Exit Func
	public function logout(){
		unset($_SESSION['user']);
	}
}