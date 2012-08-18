<?php require_once "model.feature.php";

####### ТЕСТОВЫЙ КОНТРОЛЛЕР #######

$m = new Feature();

echo "<pre>";

// выведем все данные из Таблицы `users` в виде ассоциативного массива
print_r( $m->users()->Getdata() );

