<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Exports\OrdersExport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('mine', 'driver', 'vehicle', 'approval_pic_1', 'approval_pic_2', 'rejected_by', 'canceled_by', 'created_by');

        $orders = $orders->latest()->paginate(5);

        return new OrderResource(true, 'List Data Orders', $orders);
    }

    public function approvalList(Request $request)
    {
        $payload = JWTAuth::parseToken()->authenticate();
        $userId = $payload->id;
        $role = $payload->role;

        $orders = Order::with('mine', 'driver', 'vehicle', 'approval_pic_1', 'approval_pic_2', 'rejected_by', 'canceled_by', 'created_by');

        if ($role == 'pic_branch_office') {
            $orders = $orders->where('req_pic_1', $userId)->whereIn('status', ['new', 'approved_pic_1', 'rejected']);
        }

        if ($role == 'pic_head_office') {
            $orders = $orders->where('req_pic_2', $userId)->whereIn('status', ['approved_pic_1', 'approved_pic_2', 'rejected']);
        }

        $orders = $orders->latest()->paginate(10);

        return new OrderResource(true, 'List Data Orders', $orders);
    }

    public function show($id)
    {
        $order = Order::with('mine', 'driver', 'vehicle', 'approval_pic_1', 'approval_pic_2', 'rejected_by', 'canceled_by', 'created_by')->whereId($id)->first();
        if ($order) {
            return new OrderResource(true, 'Detail Data Order!', $order);
        }

        return new OrderResource(false, 'Detail Data Order Tidak Ditemukan!', null);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'driver_id'     => 'required',
            'vehicle_id'    => 'required',
            'mine_id'       => 'required',
            'start_date'    => 'required',
            'req_pic_1'     => 'required',
            'req_pic_2'     => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $payload = JWTAuth::parseToken()->authenticate();
        $userId = $payload->id;

        $order = Order::create([
            'driver_id' => $request->driver_id,
            'vehicle_id' => $request->vehicle_id,
            'mine_id'   => $request->mine_id,
            'start_date' => $request->start_date,
            'return_date' => $request->return_date ? $request->return_date : null,
            'status'    => 'new',
            'created_by' => $userId,
            'req_pic_1' => $request->req_pic_1,
            'req_pic_2' => $request->req_pic_2
        ]);

        if ($order) {
            return new OrderResource(true, 'Data Order Berhasil Disimpan!', $order);
        }

        return new OrderResource(false, 'Data Order Gagal Disimpan!', null);
    }

    public function update(Request $request, Order $order)
    {
        $validator = Validator::make($request->all(), [
            'driver_id'     => 'required',
            "vehicle_id"   => 'required',
            'mine_id'     => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $payload = JWTAuth::parseToken()->authenticate();
        $userId = $payload->id;

        $arrUpdate = [
            'driver_id' => $request->driver_id,
            'vehicle_id' => $request->vehicle_id,
            'mine_id'   => $request->mine_id,
            'start_date' => $request->start_date ? $request->start_date : $order->start_date,
            'return_date' => $request->return_date ? $request->return_date : $order->return_date,
            'req_pic_1' => $request->req_pic_1 ? $request->req_pic_1 : $order->req_pic_1,
            'req_pic_2' => $request->req_pic_2 ? $request->req_pic_2 : $order->req_pic_2,
        ];

        if ($order->status) {
            $availStatus = ['new', 'canceled', 'release', 'done'];
            if (!in_array($request->status, $availStatus)) {
                return new OrderResource(false, 'Data Order Gagal Diupdate, Invalid Status!', null);
            }

            $arrUpdate['status'] = $request->status;

            if ($request->status == 'canceled') {
                $arrUpdate['canceled_by'] = $userId;
                $arrUpdate['canceled_at'] = now();
            } else if ($request->status == 'release') {
                $arrUpdate['release_at'] = now();
            } else if ($request->status == 'done') {
                $arrUpdate['return_at'] = now();
            }
        }

        $order->update($arrUpdate);

        if ($order) {
            return new OrderResource(true, 'Data Order Berhasil Diupdate!', $order);
        }

        return new OrderResource(false, 'Data Order Gagal Diupdate!', null);
    }

    public function approve(Request $request, Order $order)
    {
        $validStatus = ['new', 'approved_pic_1', 'approved_pic_2'];

        if (!in_array($order->status, $validStatus)) {
            return new OrderResource(false, 'Data Order Gagal Diupdate, Invalid Status!', null);
        }

        $payload = JWTAuth::parseToken()->authenticate();
        $userId = $payload->id;
        $role = $payload->role;

        $arrUpdate = [];
        if ($order->status == 'new') {
            if ($role != 'pic_branch_office') {
                return new OrderResource(false, 'Data Order Gagal Diupdate, Invalid Role!', null);
            }
            $arrUpdate = [
                'approval_pic_1' => $userId,
                'status' => 'approved_pic_1',
                'approval_pic_1_at' => now()
            ];
        } else if ($order->status == 'approved_pic_1') {
            if ($role != 'pic_head_office') {
                return new OrderResource(false, 'Data Order Gagal Diupdate, Invalid Role!', null);
            }
            $arrUpdate = [
                'approval_pic_2' => $userId,
                'status' => 'approved_pic_2',
                'approval_pic_2_at' => now()
            ];
        } else {
            return new OrderResource(false, 'Data Order Gagal Diupdate, Invalid Status!', null);
        }

        $order->update($arrUpdate);

        if ($order) {
            return new OrderResource(true, 'Data Order Berhasil Diupdate!', $order);
        }

        return new OrderResource(false, 'Data Order Gagal Diupdate!', null);
    }

    public function reject(Request $request, Order $order)
    {
        $payload = JWTAuth::parseToken()->authenticate();
        $userId = $payload->id;
        $role = $payload->role;

        if ($order->status == 'new' && $role != 'pic_branch_office') {
            return new OrderResource(false, 'Data Order Gagal Diupdate, Invalid Role!', null);
        } else if ($order->status == 'approved_pic_1' && $role != 'pic_head_office') {
            return new OrderResource(false, 'Data Order Gagal Diupdate, Invalid Role!', null);
        } else {
            return new OrderResource(false, 'Data Order Gagal Diupdate, Invalid Status!', null);
        }

        $order->update([
            'status' => 'rejected',
            'rejected_by' => $userId,
            'rejected_at' => now()
        ]);

        if ($order) {
            return new OrderResource(true, 'Data Order Berhasil Diupdate!', $order);
        }

        return new OrderResource(false, 'Data Order Gagal Diupdate!', null);
    }

    public function destroy(Order $order)
    {
        if ($order->delete()) {
            return new OrderResource(true, 'Data Order Berhasil Dihapus!', null);
        }

        return new OrderResource(false, 'Data Order Gagal Dihapus!', null);
    }

    public function exportExcel(Request $request)
    {
        $startDate = $request->start_date ? $request->start_date : now()->format('Y-m-d');
        $endDate = $request->end_date ? $request->end_date : now()->format('Y-m-d');

        return Excel::download(new OrdersExport($startDate, $endDate), 'orders.xlsx');
    }

    public function analytics(Request $request) {
        $startDate = $request->start_date;
        $endDate = $request->end_date;
    
        $orders = Order::select('return_date', DB::raw('COUNT(*) as count'));
        
        if ($startDate) {
            $orders = $orders->where('return_date', '>=', $startDate . " 00:00:00");
        }

        if ($endDate) {
            $orders = $orders->where('return_date', '<=', $endDate . " 23:59:59");
        }
        
        $orders = $orders->where('return_date', '!=', null)->groupBy('return_date')->orderBy('return_date', 'asc')->get();

        return new OrderResource(true, 'Data Order Berhasil Diupdate!', $orders);
    }
}
