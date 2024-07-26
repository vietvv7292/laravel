<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Address;
use App\Models\Category;
use App\Models\Models;
use App\Models\Producer;
use App\Models\Status;
use App\Models\User;

class ApiController extends Controller
{
    public function list()
    {
        $query = Product::with(['category' => function ($query) {
                $query->select('id', 'name');
            }])
        ->with(['address' => function ($query) {
            $query->select('id', 'name');
        }])
        ->with(['models' => function ($query) {
            $query->select('id', 'name');
        }])
        ->with(['producer' => function ($query) {
            $query->select('id', 'name');
        }])
        ->with(['status' => function ($query) {
            $query->select('id', 'name');
        }])
        ->with(['user' => function ($query) {
            $query->select('id', 'username');
        }])
        
        ->orderBy('id', 'desc');
        $result =  $query->paginate(20);
        return response()->json(['message' => 'success', 'data' => $result]);
    }

    public function option_list()
    {
        $data = [
            'category' => Category::select('id', 'name')->orderBy('id')->get(),
            'address' => Address::select('id', 'name')->orderBy('id')->get(),
            'models' => Models::select('id', 'name')->orderBy('id')->get(),
            'producer' => Producer::select('id', 'name')->orderBy('id')->get(),
            'status' => Status::select('id', 'name')->orderBy('id')->get(),
            'user' => User::select('id', 'username')->orderBy('id')->get(),
        ];
        return response()->json(['message' => 'success', 'data' => $data]);
    }

    public function option_edit($id)
    {
        // get param type post
        $type = request('type');
        $value = request('value');
        // update data address by id
        if ($type == 'address') {
            // update address by id and value
            $data = Address::where('id', $id)->update(['name' => $value]);
        }
        // update data category by id
        if ($type == 'category') {
            $data = Category::where('id', $id)->update(['name' => $value]);
        }
        // update data models by id
        if ($type == 'models') {
            $data = Models::where('id', $id)->update(['name' => $value]);
        }
        // update data producer by id
        if ($type == 'producer') {
            $data = Producer::where('id', $id)->update(['name' => $value]);
        }
        // update data status by id
        if ($type == 'status') {
            $data = Status::where('id', $id)->update(['name' => $value]);
        }
        // update data user by id
        if ($type == 'user') {
            $data = User::where('id', $id)->update(['username' => $value]);
        }
        return response()->json(['message' => 'success']);
    }
    public function option_add()
    {
        // get param type post  
        $type = request('type');
        $value = request('value');
        // add data address by id
        if ($type == 'address') {
            $data = Address::create(['name' => $value]);
        }
        // add data category by id
        if ($type == 'category') {
            $data = Category::create(['name' => $value]);
        }
        // add data models by id
        if ($type == 'models') {
            $data = Models::create(['name' => $value]);
        }
        // add data producer by id
        if ($type == 'producer') {
            $data = Producer::create(['name' => $value]);
        }
        // add data status by id
        if ($type == 'status') {
            $data = Status::create(['name' => $value]);
        }
        // add data user by id
        if ($type == 'user') {
            $data = User::create(['username' => $value]);
        }
        return response()->json(['message' => 'success']);
    }

    public function detail($id)
    { 
        // get data product by id
        $data = Product::with(['category' => function ($query) {
                $query->select('id', 'name');
        }])
        ->with(['address' => function ($query) {
            $query->select('id', 'name');
        }])
        ->with(['models' => function ($query) {
            $query->select('id', 'name');
        }])
        ->with(['producer' => function ($query) {
            $query->select('id', 'name');
        }])
        ->with(['status' => function ($query) {
            $query->select('id', 'name');
        }])
        ->with(['user' => function ($query) {
            $query->select('id', 'username');
        }])->where('id', $id)->first();
        // decode des to array
        $data->des = json_decode($data->des, true);
        return response()->json(['message' => 'success', 'data' => $data]);

    }

    public function update($id)
    {  
        // update qr code by id if type = qr_code
        if (request('type') == 'qrcode') {
            $data = Product::where('id', $id)->update(['qr_code' => request('value')]);
        }
        // update status by id if type = status_id
        if (request('type') == 'status') {
            $data = Product::where('id', $id)->update(['status_id' => request('value')]);
        }
        // update des by id if type = des
        if (request('type') == 'des') {
            // get des in database table product by id
            $des = Product::where('id', $id)->first()->des; 
            // encode des to json
            $des = json_decode($des, true);
            // add new des to array
            $des[] = [request('key') => request('value')];
            // update des in database table product by id
            $data = Product::where('id', $id)->update(['des' => json_encode($des)]);
        }
        return response()->json(['message' => 'success']);
    }
}
