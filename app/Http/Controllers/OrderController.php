<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\DetailOrder;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with(['customer', 'user'])
            ->when(Auth::user()->role === 'employee', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->latest()
            ->paginate(10);

        return view('order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $products = Product::where('stock', '>', 0)->get();
        $customer = null;

        if ($request->phone) {
            $customer = Customer::where('phone_number', $request->phone)->first();
        }

        return view('order.create', compact('products', 'customer'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $products = $request->product_id;
        $qty = $request->qty;

        $total = 0;

        // ================= HITUNG TOTAL =================
        foreach ($products as $productId) {
            $product = Product::find($productId);
            $subTotal = $product->price * $qty[$productId];
            $total += $subTotal;
        }

        // ================= CUSTOMER =================
        $customer = null;
        $isMember = false;
        $isNewMember = false;

        if ($request->phone) {
            $customer = Customer::where('phone_number', $request->phone)->first();

            if ($customer) {
                $isMember = true;
            } else {
                // MEMBER BARU
                $customer = Customer::create([
                    'name' => $request->name,
                    'phone_number' => $request->phone,
                    'total_poin' => 0
                ]);

                $isMember = true;
                $isNewMember = true;
            }
        }

        // ================= POIN =================
        $pointsUsed = 0;

        if ($isMember && !$isNewMember) {
            // hanya member lama bisa pakai poin
            $pointsUsed = $request->points_used ?? 0;

            // validasi poin
            if ($pointsUsed > $customer->total_poin) {
                $pointsUsed = $customer->total_poin;
            }
        }

        // potong total pakai poin
        $totalAfterDiscount = $total - $pointsUsed;

        // ================= PEMBAYARAN =================
        $totalPay = $request->total_pay;
        $totalReturn = $totalPay - $totalAfterDiscount;

        // ================= POIN DIDAPAT =================
        $pointsEarned = 0;

        if ($isMember) {
            // 1% dari total (misal)
            $pointsEarned = floor($totalAfterDiscount * 0.01);
        }

        // ================= SIMPAN ORDER =================
        $order = Order::create([
            'user_id' => Auth::id(),
            'customer_id' => $customer?->id,
            'sale_date' => now(),
            'total_price' => $totalAfterDiscount,
            'total_pay' => $totalPay,
            'total_return' => $totalReturn,
            'points_earned' => $pointsEarned,
            'points_used' => $pointsUsed,
        ]);

        // ================= DETAIL ORDER =================
        foreach ($products as $productId) {
            $product = Product::find($productId);
            $subTotal = $product->price * $qty[$productId];

            DetailOrder::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'amount' => $qty[$productId],
                'sub_total' => $subTotal
            ]);

            // kurangi stok
            $product->decrement('stock', $qty[$productId]);
        }

        // ================= UPDATE POIN =================
        if ($isMember) {
            $customer->total_poin += $pointsEarned;
            $customer->total_poin -= $pointsUsed;
            $customer->save();
        }

        return redirect()->route('order.index')->with('success', 'Transaksi berhasil');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
