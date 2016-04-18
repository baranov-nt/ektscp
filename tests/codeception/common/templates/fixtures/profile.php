<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 18.04.2016
 * Time: 15:49
 */
$security = Yii::$app->getSecurity();

return [
    'username' => $faker->userName,
    'email' => $faker->email,
    'auth_key' => $security->generateRandomString(),
    'password_hash' => $security->generatePasswordHash('password_' . $index),
    'password_reset_token' => $security->generateRandomString() . '_' . time(),
    'created_at' => time(),
    'updated_at' => time(),
];