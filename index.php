<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//echo $_GET['request'];
include 'lib/bones.php';

get('/', function($app) {
  $app->set('message', 'Welcome Back');
  $app->render('home');
});
get('/signup', function($app) {
  
  $app->render('signup');
});

get('/say/:message', function($app){
    $app->set('message', $app->request('message'));
    $app->render('home');
});

post('/signup', function($app){
    
// $user = new stdClass;
// $user->type = 'user';
 
 $user = new User();   
 $user->name = $app->form('name');
 $user->email = $app->form('email');
// echo json_encode($user);
// $curl = curl_init();
// //curl options
// $options = array(
//    CURLOPT_URL              => 'localhost:5984/verge',
//    CURLOPT_POSTFIELDS       => json_encode($user),
//    CURLOPT_HTTPHEADER       => array ("Content-Type:application/json"),
//    CURLOPT_CUSTOMREQUEST    => 'POST',
//    CURLOPT_RETURNTRANSFER   => true,
//    CURLOPT_ENCODING         => "utf-8",
//    CURLOPT_HEADER           => false,
//    CURLOPT_FOLLOWLOCATION   => true,
//    CURLOPT_AUTOREFERER      => true
//  );
//  curl_setopt_array($curl, $options);
// curl_exec($curl);
// curl_close($curl); 
    $app->couch->post($user->to_json());
    $app->set('message', 'Thanks for Signing Up' . $app->form('name') . '!');
    $app->render('home');
});