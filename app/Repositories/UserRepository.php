<?php

namespace App\Repositories;

use App\Exceptions\CustomException;
use App\Models\User;

class UserRepository
{

    public function importUsers($importData)
    {
        try {
            foreach ($importData["usersData"] as $key => $line) {
                $data = str_getcsv($line);
                $num = $key + 1;
                $model = new User();

                $requiredFields = [
                    'first name',
                    'email',
                    'password',
                    'dob',
                    'role'
                ];

                if (isset($data[0]) && $data[0]) {
                    $model->first_name = $data[0];
                } else {
                    throw new CustomException("The {$requiredFields[$data[0]]} of record number $num field is required");
                }

                if (isset($data[1]) && $data[1]) {
                    $model->last_name = $data[1];
                }

                if (isset($data[2]) && $data[2]) {
                    if (!strstr($data[2], '@')) {
                        throw new CustomException("The {$requiredFields[1]} of record number $num is invalid");
                    }
                    $model->email = $data[2];
                } else {
                    throw new CustomException("The {$requiredFields[1]} of record number $num field is required");
                }

                if (isset($data[3]) && $data[3]) {
                    $model->password = $data[3];
                } else {
                    throw new CustomException("The {$requiredFields[2]} of record number $num field is required");
                }

                if (isset($data[4]) && $data[4]) {
                    $model->dob = $data[4];
                } else {
                    throw new CustomException("The {$requiredFields[3]} of record number $num field is required");
                }

                if (isset($data[5]) && $data[5]) {
                    $model->role = $data[5];
                } else {
                    throw new CustomException("The {$requiredFields[4]} of record number $num field is required");
                }

                if (isset($data[6]) && $data[6]) {
                    $model->address = $data[6];
                }
                $model->save();
            }
            return true;
        } catch (\Throwable $th) {
            throw new CustomException($th->getMessage());
        }
    }
}
