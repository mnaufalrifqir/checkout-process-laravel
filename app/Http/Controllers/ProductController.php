<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function getAllCities()
    {
        $response = Http::withHeaders([
            'key' => env('RAJAONGKIR_API_KEY')
        ])->get('https://api.rajaongkir.com/starter/city');

        $cities = $response->json()['rajaongkir']['results'];

        return $cities;
    }

    public function getProduct()
    {
        return new Product('Laptop', 50000, 'A laptop computer', 'product.jpg');
    }

    public function index()
    {
        $product = $this->getProduct();
        $cities = $this->getAllCities();
        $costs = [];

        return view('products.index', compact('product', 'cities', 'costs'));
    }

    public function checkCost(Request $request)
    {
        $cities = $this->getAllCities();
        $product = $this->getProduct();

        $responseCost = Http::withHeaders([
            'key' => env('RAJAONGKIR_API_KEY')
        ])->post('https://api.rajaongkir.com/starter/cost', [
            'origin' => $request->origin,
            'destination' => $request->destination,
            'weight' => $request->weight,
            'courier' => $request->courier
        ]);

        $resultCost = $responseCost->json()['rajaongkir'];

        return view('products.index', compact('resultCost', 'cities', 'product'));
    }
}