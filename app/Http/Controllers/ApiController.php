<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

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

    public function show($id)
    {
        // Trả về thông tin của một item với id cụ thể
        return response()->json(['message' => 'API show method', 'id' => $id]);
    }

    public function store(Request $request)
    {
        // Xử lý lưu thông tin từ request vào cơ sở dữ liệu
        return response()->json(['message' => 'API store method', 'data' => $request->all()]);
    }

    public function update(Request $request, $id)
    {
        // Xử lý cập nhật thông tin của item với id cụ thể
        return response()->json(['message' => 'API update method', 'id' => $id, 'data' => $request->all()]);
    }

    public function destroy($id)
    {
        // Xử lý xóa item với id cụ thể
        return response()->json(['message' => 'API destroy method', 'id' => $id]);
    }
}
