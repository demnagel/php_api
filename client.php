<?php
require_once 'curl.php';


// Пример запроса на вывод всех книг для определенного автора
print_r(runCurl( 'http://somedomain.com/api/books?id=1' , 'get' ));

// Пример запроса на добавление новой книги
//print_r(runCurl( 'http://somedomain.com/api/books?id_author=3&name=Мцыри&id_publisher=2&date_manufacture=1563901181', 'post' ));

// Пример запроса на на изменение автора у книги
//print_r(runCurl( 'http://somedomain.com/api/books?id_author=1&id_book=7', 'put'));

//Пример запроса на удаление автора и всех его книг (каскадное удаление книг реализовано тригером в бд)
//print_r(runCurl( 'http://somedomain.com/api/author?id=1', 'delete'));