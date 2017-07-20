<?php

$msg_box = ""; // в этой переменной будем хранить сообщения формы
$errors = array(); // контейнер для ошибок
// проверяем корректность полей
if($_POST['name'] == "")    $errors[] = "Поле 'Ваше имя' не заполнено!";
if($_POST['phone'] == "")    $errors[] = "Поле 'Ваш телефон' не заполнено!";
// если форма без ошибок
if(empty($errors)){
// собираем данные из формы
$message  = "Написал(а): $name\n телефон: $phone\n форма:$form";
send_mail($message); // отправим письмо
// выведем сообщение об успехе
$msg_box = "Сообщение успешно отправлено!";
}else{
// если были ошибки, то выводим их
$msg_box = "";
foreach($errors as $one_error){
$msg_box .= "$one_error";
}
}
// делаем ответ на клиентскую часть в формате JSON
echo json_encode(array(
'result' => $msg_box
));
// функция отправки письма
function send_mail($message){
// почта, на которую придет письмо
$mail_to = "dartin1@mail.ru";
// тема письма
$subject = "Письмо с обратной связи";
// заголовок письма
$headers= "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=utf-8\r\n"; // кодировка письма
$headers .= "From: Тестовое письмо <no-reply@test.com>\r\n"; // от кого письмо
// отправляем письмо
mail($mail_to, $subject, $message, $headers);
}

?>
