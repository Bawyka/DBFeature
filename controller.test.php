<?php require_once "model.feature.php";

####### ТЕСТОВЫЙ КОНТРОЛЛЕР #######

$m = new Feature();

echo "<pre>";
	

    if (is_object($m->users()) && ($data = $m->users()->GetData())) {
        print_r( $data );
    } else {
    echo 'таблицы `users` не существует, введите правильно имя таблицы';
}