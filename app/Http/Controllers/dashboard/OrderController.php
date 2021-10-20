<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class OrderController extends Controller
{
      public function index()
    {
        if (request()->ajax()) {
            $orders = DB::table('orders')
                ->select([
                    'orders.id', 'orders.email','orders.phone', 'orders.order_status', 'orders.charge_status',
                    DB::raw("DATE_FORMAT(orders.created_at, '%Y-%m-%d') as Date"),
                ])->orderBy('id', 'DESC')->get();

            return  DataTables::of($orders)
                ->addColumn('actions', function ($orders) {
                    return '<button type="button" data-id="' . $orders->id . '" data-toggle="modal" data-target="#DeleteArticleModal" class="btn btn-danger btn-sm " id="getDeleteId">حذف</button>';
                })->editColumn('order_status',function($orders){
                    return "$orders->order_status"== 0 ? 'تم الطلب' : 'الطلب قيد الإجراء';
                })->rawColumns(['actions'])->make(true);
        }
        return view('admin.orders.index');
    }
}
