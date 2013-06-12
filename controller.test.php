<?php require_once "model.feature.php";

####### ТЕСТОВЫЙ КОНТРОЛЛЕР #######

/* Пример таблицы users */
$query = "CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";


$ft = new Feature();

// Создадим таблицу `users`
if ($ft->Query($query))
{
	echo "Была создана таблица `users`!<br />";

	// Если таблица `users` пуста, добавим туда запись
	if ($ft->users()->isEmpty())
	{
		$user = array('login'=>'Alex',
					  'email'=>'alex@email.com',
					  'password'=>'');
					  
		if ($lstid = $ft->users()->PutData($user))
		{
			echo "Пользователь `Alex` был успешно внесен в таблицу! <br />";
		}
	}

	// Проверим существует ли наш пользователь
	if ($ft->users()->ExistsRow('login','Alex'))
	{
		echo "Есть такой пользователь! Установим ему пароль!";
		
		// Обновление данных
		$ft->users()->UpdOne('password','123','login','Alex');
	}

	// Выведем данные о пользователе 
	if ($data = $ft->users()->GetRec('login','Alex'))
	{
		echo "<pre>";
		print_r( $data );
		echo "</pre>";
	}

	// Удалим нашего пользователя
	if ($ft->users()->DelOne('login','Alex'))
	{
		echo "Пользователь `Alex` удален! <br />";
	}
}