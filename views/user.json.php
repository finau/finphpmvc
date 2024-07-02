<?php
/** @var array $data */
$data = $data[0];
$output = [
    'id' => $data->getId(),
    'user_name' => $data->getUserName(),
    'email' => $data->getEmail(),
    'password' => $data->getPassword(),
    'birth_date' => $data->getBirthDate(),
    'phone_number' => $data->getPhoneNumber(),
    'url' => $data->getUrl(),
];

echo json_encode($output);


