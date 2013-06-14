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
	echo "Была создана таблица `users`..<br />";

	// Если таблица `users` пуста, добавим туда запись
	if ($dbf->users(1)->isEmpty())
	{
		$user = array('login'=>'Alex',
					  'email'=>'alex@email.com',
					  'password'=>'');
					  
		if ($lstid = $dbf->users()->PutData($user))
		{
			echo "Пользователь `Alex` был успешно внесен в таблицу.. <br />";
		}
	}
		
	// Объект. Загрузим пользователя как Oбъект методом ->Load()
	if (isset($lstid))
	{
		$user_object = $dbf->users(array('id'=>$lstid))->Load();
		// Выведем Его Email
		echo $user_object->email.'..<br />';
	}

	// Проверим существует ли наш пользователь
	if ($dbf->users()->ExistsRow('login','Alex'))
	{
		echo "Есть такой пользователь...<br />Установим ему пароль.. <br />";
				
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
		echo "Пользователь `Alex` удален.. <br />";
	}
	
	echo "----------- Связи -----------<br />";
	
	/* Создадим таблицу `posts`
	CREATE TABLE IF NOT EXISTS `posts` (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `post` varchar(255) NOT NULL,
	  `users_id` int(11) NOT NULL,
	  PRIMARY KEY (`id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

	INSERT INTO `posts` (`id`, `post`, `users_id`) VALUES
	(1, 'My Post 1', 1),
	(2, 'My Post 2', 1),
	(3, 'My Post 3', 1);
	*/
	
	// # ОДИН КО МНОГИМ # has_many
	$posts = $dbf->users(array('id'=>1,'has_many'=>'posts'))->GetData();
	
	echo "<B>Один ко Многим:</B> <br />Выведем все посты Юзера с id = 1 <br />";
	echo "<pre>";
	print_r($posts);
	echo "</pre>";
	
	
	// # ОДИН К ОДНОМУ # has_one
	$post_user = $dbf->posts(array('id'=>2,'has_one'=>'users'))->GetOne();
}