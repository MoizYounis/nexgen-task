<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\UserContract;
use App\Exceptions\CustomException;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function __construct(private UserContract $userContract) {}
    public function import(UserRequest $request)
    {
        try {
            DB::beginTransaction();
            $importUsers = $this->userContract->import($request->prepareRequest());
            if ($importUsers) {
                DB::commit();
                dd("imported");
            }
        } catch (CustomException $th) {
            DB::rollBack();
            dd($th->getMessage());
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
    }
}
