<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Stok;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DataController extends Controller
{
    public function index() {
        
    }

    public function income()
    {
        $transaksi = Transaksi::get();
    
        $total_income = $transaksi->sum('total_harga');
    
        return response()->json([
            'income' => $total_income,
        ]);
    }

    public function countMenu() {
        $today = Carbon::today();
        $soldMenu = Transaksi::where('tanggal', $today)->count();

       return response()->json([
        'sold_menu' => $soldMenu,
       ]);
    }

    public function totalMenu() {
        $menus = Menu::count();

        return response()->json([
            'total_menu' => $menus,
        ]);
    }

    public function mostMenu() {
        $orderedMenu = DetailTransaksi::select('menu_id', DB::raw('SUM(quantity) as total_orders'))
            ->groupBy('menu_id')
            ->orderByDesc('total_orders')
            ->limit(5)
            ->get();
    
            $menus = [];

            foreach ($orderedMenu as $orderMenu) {
                $menu = $orderMenu->menu;
                $menus[] = [
                    'menu_id' => $menu->id,
                    'menu_name' => $menu->nama_menu,
                    'total_orders' => $orderMenu->total_orders,
                ];
            }
    
        return response()->json([
            'order_menu' => $menus
        ]);
    }    

    public function mostPopularMenu()
{
    $mostPopularMenu = DetailTransaksi::select('menu_id', DB::raw('SUM(quantity) as total_orders'))
        ->groupBy('menu_id')
        ->orderByDesc('total_orders')
        ->first();

    if (!$mostPopularMenu) {
        return response()->json([
            'message' => 'Tidak ada data menu yang terjual.'
        ], 404);
    }

    $menu = Menu::find($mostPopularMenu->menu_id);

    return response()->json([
        'popular_menu' => [
            'menu_id' => $menu->id,
            'menu_name' => $menu->nama_menu,
            'total_orders' => $mostPopularMenu->total_orders,
        ]
    ]);
    }

    public function lowStock() {
        $low = Stok::join('menu', 'stok.menu_id', '=', 'menu.id')
            ->orderBy('stok.jumlah')
            ->limit(3)
            ->get();

        $low = $low->filter(function($stok){
            return $stok->jumlah <= 10;
        });

        $lowStok = $low->map(function($stok){
            return [
                'menu_id' => $stok->menu_id,
                'menu' => [
                   'name' => $stok->nama_menu,
                   'image' => $stok->image
                ],
                'stock' => $stok->jumlah,
            ];
        });

        return response()->json([
            'low_stock' => $lowStok
        ]);
    }

    public function dailyIncome() {
        $dates = [];
        $totalSales = [];
    
        // Generate date range for the last 7 days
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i)->toDateString();
            $dates[] = $date;
        }

        foreach ($dates as $date) {
            $total = Transaksi::whereDate('tanggal', $date)->sum('total_harga');
            $totalSales[] = [
                'date' => $date,
                'penjualan' => $total,
            ];
        }
    
        return response()->json([
            'daily_income' => $totalSales
        ]);
    }

    public function filterByDate(Request $request)
{
    // Validasi input tanggal awal dan akhir
    $request->validate([
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
    ]);

    // Ambil tanggal awal dan akhir dari request
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    // Memanggil semua fungsi yang telah dibuat
    $income = $this->income($startDate, $endDate);
    $countMenu = $this->countMenu($startDate, $endDate);
    $totalMenu = $this->totalMenu();
    $mostMenu = $this->mostMenu();
    $mostPopularMenu = $this->mostPopularMenu();
    $lowStock = $this->lowStock();
    $dailyIncome = $this->dailyIncome($startDate, $endDate);

    // Mengembalikan response JSON dengan data yang telah diambil
    return response()->json([
        'income' => $income,
        'count_menu' => $countMenu,
        'total_menu' => $totalMenu,
        'most_menu' => $mostMenu,
        'most_popular_menu' => $mostPopularMenu,
        'low_stock' => $lowStock,
        'daily_income' => $dailyIncome,
    ]);
}
}
