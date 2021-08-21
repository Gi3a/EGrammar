<?php

namespace application\models;

use application\core\Model;


class Main extends Model {

	public $error;


	public function getTestInfo($id)
	{
		$params = [
			'id' => trim(htmlspecialchars($id)),
		];
		return $this->db->row('SELECT * FROM tests WHERE id = :id', $params);	
	}

	public function getProgressInfo($status)
	{
		$count = $this->db->column('SELECT COUNT(id) FROM tests');
		return $status/$count * 100;
	}
	

	public function shuffleTestWords(&$array) {
        $keys = array_keys($array);
        shuffle($keys);
        foreach($keys as $key) {
            $new[$key] = $array[$key];
        }
        $array = $new;
        return $array;
    }

	public function getUserInfo($id)
	{
		$params = [
			'id' => trim(htmlspecialchars($id)),
		];
		return $this->db->row('SELECT status, result FROM users WHERE id = :id', $params);	
	}

	public function setTestResult($user_id, $correct, $str)
	{
		$user = $this->getUserInfo($user_id)[0];

		$level = $user['status'];
		$result = $user['result'] + $correct;
		$status = $user['status'] + 1;
		
		$text = $this->getTestInfo($user['status'])[0];


		$params = [
			'id' => '0',
			'test_id' => intval($level),
			'text_en' => $text['text_en'],
			'text_ru' => $text['text_ru'],
			'correct' => $str,
			'user_id' => intval($user_id),
		];
		$this->db->query('INSERT INTO tests_logs VALUES (:id, :test_id, :text_en, :text_ru, :correct, :user_id)', $params);
		$props = [
			'status' => $status,
			'result' => $result,
			'user_id' => $user_id,
		];
		$this->db->query('UPDATE users SET status = :status, result = :result WHERE id = :user_id', $props);
	}

	public function getLogs($user_id)
	{
		$params = [
			'user_id' => $user_id,
		];
		return $this->db->row('SELECT * FROM tests_logs WHERE user_id = :user_id', $params);	
	}

	public function resetUset($user_id)
	{
		$props = [
			'id' => $user_id,
			'result' => 0,
			'status' => 1
		];
		$this->db->query('UPDATE users SET result = :result, status = :status WHERE id = :id', $props);
		$params = [
			'user_id' => $user_id,
		];
		$this->db->column('DELETE FROM tests_logs WHERE user_id = :user_id', $params);
	}
	
}