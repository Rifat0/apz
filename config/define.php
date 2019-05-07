<?php
	
	// return [
    // 'options' => [
	// 'PASSWORD_BCRYPT_COST', "13",
	// 'PASSWORD_ENCRYPTION', "bcrypt",
	// 'PASSWORD_SHA512_ITERATIONS', 25000,
	// 'PASSWORD_SALT', "UPj8EVJWvP73FZ9Ih0xzUf",
    // ]
	// ];
	
	define('PASSWORD_ENCRYPTION', "bcrypt"); //available values: "sha512", "bcrypt"
	define('PASSWORD_BCRYPT_COST', "13");
	define('PASSWORD_SHA512_ITERATIONS', 25000);
	define('PASSWORD_SALT', "UPj8EVJWvP73FZ9Ih0xzUf"); //22 characters to be appended on first 7 characters that will be generated using PASSWORD_ info above
	define('PASSWORD_RESET_KEY_LIFE', 60);
	define('AGENT_COMMISSION', 20);
