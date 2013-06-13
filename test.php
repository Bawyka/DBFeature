<?php include("dbfeature.php");

####### ТЕСТ #######

/* Пример таблицы users */
$query = "CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";


$dbf = new DBFeature();

// Создадим таблицу `users`
if ($dbf->Query($query))
{
	echo "Была создана таблица `users`!<br />";

	// Если таблица `users` пуста, добавим туда запись
	if ($dbf->users()->isEmpty())
	{
		$user = array('login'=>'Alex',
					  'email'=>'alex@email.com',
					  'password'=>'');
					  
		if ($lstid = $dbf->users()->PutData($user))
		{
			echo "Пользователь `Alex` был успешно внесен в таблицу! <br />";
		}
	}

	// Проверим существует ли наш пользователь
	if ($dbf->users()->ExistsRow('login','Alex'))
	{
		echo "Есть такой пользователь! Установим ему пароль!";
		
		// Обновление данных
		$dbf->users()->UpdOne('password','123','login','Alex');
	}

	// Выведем данные о пользователе 
	if ($data = $dbf->users()->GetRec('login','Alex'))
	{
		echo "<pre>";
		print_r( $data );
		echo "</pre>";
	}

	// Удалим нашего пользователя
	if ($dbf->users()->DelOne('login','Alex'))
	{
		echo "Пользователь `Alex` удален! <br />";
	}
}