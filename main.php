<?php
include 'User.php';
include 'Comment.php';

use nspace\Comment;

//1
echo "exe 1<br>";
$user1 = new User("12345670", "user1", "abc@gmail.com", "123123123");
$user2 = new User("12345678999", "user2", "abc@gmail.com", "12345");
$user3 = new User("00000000", "user3", "ksknfkwenkfnwke", "943839829");

$time = new DateTime('now');

sleep(2);
$user4 = new User("sjfwef832", "user4", "abc@gmail.com", "12345678");
$user5 = new User("12345678", "user5", "abs@gmail.com", "123123123");
$user6 = new User("01010011", "user6", "abs@gmail.com", "123123123");

// 2
echo "exe 2<br>";
$arrayComments = array(
    new Comment($user1, "message 1"),
    new Comment($user2, "message 2"),
    new Comment($user3, "message 3"),
    new Comment($user4, "message 4"),
    new Comment($user5, "message 5"),
    new Comment($user5, "message 6"));

for ($i = 0; $i < count($arrayComments); $i++) {
    if ($arrayComments[$i]->isAfterDateTime($time)) {
        echo "{$arrayComments[$i]->getMessage()}<br>";
    }
}

