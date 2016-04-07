<?php
ini_set('display_errors', 1);

$to = '1who.amiam.you1@gmail.com';
$title = '件名';
$message = '本文';
$header = 'From: you.nagamine.yn@gmail.com' . "\r\n";
$header .= 'Return-Path: you.nagamine.yn@gmail.com';

if (mb_send_mail($to, $title, $message,$header)) {
echo '送信成功';
} else {
echo '送信失敗';
}
?>