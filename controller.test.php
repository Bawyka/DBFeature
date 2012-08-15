<?php require_once "model.feature.php";

####### ТЕСТОВЫЙ КОНТРОЛЛЕР #######

$m = new Feature();

echo "<pre>";
// выведем данные из таблицы "voting" в виде ассоциативного массива
print_r($m->GetData("voting"));