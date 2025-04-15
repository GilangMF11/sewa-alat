<?php

namespace App\Controllers\Cart;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Carts\CartModel;
use App\Models\Carts\CartItemModel;
use App\Models\Rentals\RentalModel;
use App\Models\Rentals\RentalItemModel;

class CartController extends BaseController
{
    protected $cartModel;
    protected $cartItemModel;
    protected $rentalModel;
    protected $rentalItemModel;

    public function __construct()
    {
        $this->cartModel = new CartModel();
        $this->cartItemModel = new CartItemModel();
        $this->rentalModel = new RentalModel();
        $this->rentalItemModel = new RentalItemModel();
    }

    public function index()
    {
        $userId = session()->get('user_id');

        $cartItems = $this->cartModel->getCartWithItems($userId);
        return view('Users/cart/v_user_cart', ['cartItems' => $cartItems]);
    }

    public function store()
    {
        $userId = session()->get('user_id');
        $itemId = $this->request->getPost('item_id');
        $quantity = (int) $this->request->getPost('quantity');

        // Cari atau buat cart aktif untuk user ini
        $cart = $this->cartModel
                    ->where('user_id', $userId)
                    ->where('status', '1')
                    ->first();

        if (!$cart) {
            // Jika belum ada cart, buat baru
            $cartId = $this->cartModel->insert([
                'user_id' => $userId,
                'status' => '1'
            ]);
        } else {
            $cartId = $cart['id']; // fix: array access, bukan object
        }

        // Cek apakah item sudah ada di dalam cart
        $existingItem = $this->cartItemModel
                            ->where('cart_id', $cartId)
                            ->where('item_id', $itemId)
                            ->first();

        if ($existingItem) {
            // Jika item sudah ada, update quantity
            $newQuantity = $existingItem['quantity'] + $quantity;

            $this->cartItemModel->update($existingItem['id'], [
                'quantity' => $newQuantity
            ]);
        } else {
            // Jika item belum ada, insert baru
            $this->cartItemModel->insert([
                'cart_id' => $cartId,
                'item_id' => $itemId,
                'quantity' => $quantity,
                'price' => $this->getItemPrice($itemId)
            ]);
        }

        return redirect()->to('user/cart')->with('success', 'Item berhasil ditambahkan ke keranjang.');
    }


    // Fungsi ambil harga item
    protected function getItemPrice($itemId)
    {
        $itemModel = new \App\Models\Items\ItemModel();
        $item = $itemModel->find($itemId);
        return $item ? $item['price'] : 0;
    }

    public function destroy($id) {
        $this->cartItemModel->delete($id);
        return redirect()->to('user/cart')->with('success', 'Item berhasil dihapus dari keranjang.');
    }

}
