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
        $result =  $query->paginate(2);
        return response()->json(['message' => 'success', 'data' => $result]);
    }

    public function update(Request $request, $id)
    {
        return response()->json(['message' => 'API update method', 'id' => $id, 'data' => $request->all()]);
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
}
