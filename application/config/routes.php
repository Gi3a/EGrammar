<?php

return [
/* ------------------------------------ */
	/* =================== Main Controller =================== */
	// Main page
	'' => [
		'controller' => 'user',
		'action' => 'join',
	],
	'main' => [
		'controller' => 'main',
		'action' => 'main',
	],
	'check' => [
		'controller' => 'main',
		'action' => 'check',
	],
	'logs' => [
		'controller' => 'main',
		'action' => 'logs',
	],
	'reset' => [
		'controller' => 'main',
		'action' => 'reset',
	],


	/* =================== User Controller =================== */

	'id/{id:\d+}' => [
		'controller' => 'user',
		'action' => 'user',
	],

	// Exit session
	'exit' => [
		'controller' => 'user',
		'action' => 'exit',
	],
];