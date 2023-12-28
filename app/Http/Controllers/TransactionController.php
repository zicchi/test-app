<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TransactionController extends Controller
{
    public function index(Request $request){
        $year = $request->input('tahun',"");
        if ($year != "") {
            $menu_request = Http::get('https://tes-web.landa.id/intermediate/menu');
            $transaction_request =  Http::get('https://tes-web.landa.id/intermediate/transaksi?tahun='.$year);

            $menus = json_decode($menu_request->body(),true);
            $transactions = json_decode($transaction_request->body(),true);



            $foods = array_filter($menus,function($item){
                return $item['kategori'] == 'makanan';
            });

            $drinks = array_filter($menus,function($item){
                return $item['kategori'] == 'minuman';
            });

            $totalMonthly = array_fill(1,12,null);
            $monthlyTransaction = [];
            foreach ($transactions as $transaction) {
                $menu = $transaction['menu'];
                $month = date('n',strtotime($transaction['tanggal']));

                if (!isset($monthlyTransaction[$menu])) {
                    $monthlyTransaction[$menu] = array_fill(1,12,null);
                }

                $monthlyTransaction[$menu][$month] += $transaction['total'];
                $totalMonthly[$month] += $transaction['total'];

            }

        }else{
                $menus = [];
                $foods = [];
                $drinks = [];
                $monthlyTransaction = [];
                $totalMonthly = [];
        }
        return view('pages.main',[
            'year' => $year,
            'menus' => $menus,
            'foods' => $foods,
            'drinks' => $drinks,
            'monthlyTransaction' => $monthlyTransaction,
            'totalMonthly' => $totalMonthly,
        ]);
    }
}
