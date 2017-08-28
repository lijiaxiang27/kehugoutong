<?php
/**
 * 配置文件
 */
return array(
    'DEBUG'     => true,
	'APP_ID'    => 'wxa4e83dee16b8b736',
	'SECRET'    => '0e034cd45643b651cc3ada88cb44f765',
	'TOKEN'     => 'aotuedu',
	'LOG' => [
		'level' => 'debug',
		'file'  => './tmp/easywechat.log',
	],
	'OAUTH' => [
		'scopes'   => ['snsapi_userinfo'],
		'callback' => '/index.php?g=admin&m=public&a=cb',
	],
);