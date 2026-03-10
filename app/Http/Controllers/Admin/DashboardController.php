<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\Sale;
use App\Models\Cart;
use App\Models\Earning;

use Carbon\Carbon;
use Session;

class DashboardController extends Controller
{
    public function dashboard(){
        // $products = Product::take(20)->get();
        $products = Product::all();


        $latest_orders = Order::orderBy('id', 'desc')->take(7)->get();
        $orders = Order::all();
        // $products = Product::all();
        // $jan_sale = Sale::where();

        $latest_products = Product::orderBy('id', 'desc')->take(10)->get();

        $carts = Cart::all();
        $users = User::where('role', 'customer')->get();
        
        // sales by payment_status 'paid'
        $sales = Order::where('payment_status', 'paid')->get();

        // Prepare last 12 months data
        $months_array = [];
        $sales_data = [];
        for ($i = 5; $i >= 0; $i--) { // Let's show last 6 months for a cleaner chart
            $date = Carbon::today()->startOfMonth()->subMonths($i);
            $months_array[] = $date->format('M Y');
            $sales_data[] = 0;
        }

        $sales_total = 0;

        foreach ($sales as $sale) {
            $sales_total += $sale->total; // Add to overall total
            $saleMonth = Carbon::parse($sale->created_at)->startOfMonth();
            
            // Check if it falls in our 6-month window
            for ($i = 0; $i < 6; $i++) {
                $date = Carbon::today()->startOfMonth()->subMonths(5 - $i);
                if ($saleMonth->isSameMonth($date)) {
                    $sales_data[$i] += $sale->total;
                    break;
                }
            }
        }

        return view('Admin.dashboard',[
            'latest_orders'=> $latest_orders,
            'latest_products'=> $latest_products, 
            'products'=> $products,
            'sales'=> $sales, 
            'orders'=> $orders,
            'users'=> $users, 
            'months'=> $months_array,
            'sales_data' => $sales_data,
            'sales_total'=> $sales_total
        ]);
    }

    private function getSaleTotal($sales){
        $dis = 0;
        for ($i=0; $i < count($sales); $i++) { 
            $total = $sales[$i]->total;
            $discount = 0;
            $dis = $dis + ($total - $discount);
        }

        return $dis;
    }
}
