<?php
	session_start();
	$win = "true";
	$name = $_POST['name'];
	$tel = $_POST['tel'];	
	mail( "sidorov-vv3@mail.ru", "Заказ обратного звонка с сайта honey-present.", "Потенциальный клиент ".$name." просит перезвонить Вас на номер " . $tel );
	mail( "vasilyev-r@mail.ru", "Заказ обратного звонка с сайта honey-present.", "Потенциальный клиент ".$name." просит перезвонить Вас на номер " . $tel );
	$_SESSION['win'] = 1;
	$_SESSION['recaptcha'] = '<p class="text-light">Спасибо, что Вы обратились именно к нам. Мы свяжемся с Вами в ближайшее время.</p>';
	header("Location: ".$_SERVER['HTTP_REFERER']);
?>