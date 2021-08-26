<?php
$errors = array();
$success = '';

if ( isset($_POST['add']) ) {
   $errors['name'] = !empty($_POST['name']) ? '' : 'Заполните имя';
   $errors['email'] = '';
   if ( empty($_POST['email']) ) {
      $errors['email'] = 'Заполните Email';
      } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      $errors['email'] = 'E-mail адрес указан неверно.';
   }
   $errors['description'] = !empty($_POST['description']) ? '' : 'Заполните описание задачи';
   
   if ( empty($errors['name']) && empty($errors['email']) && empty($errors['description']) ) {
      $tasks->add( $_POST['name'], $_POST['email'], htmlspecialchars($_POST['description']) );
      if (isHtml($_POST['description']) ) {
         } else {
         $success = 'Вы успешно добавили новую задачу';
      }
   }
}