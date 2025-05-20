<?php

namespace App\Http\Controllers;

use App\Events\HubSpotRegistered;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Models\Products;
use App\Services\ProductService;
use App\Models\Categories;
use App\Notifications\NewProductAdded;


class ProductController extends Controller
{

     protected $productService;
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $user = auth()->user();
        // Get all products
        $products = Products::with('user')
        ->where('user_id', $user->id)
        ->paginate(10);



        // Return the products as a JSON response
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      
        // get all categories
        $categories = Categories::all();
        // Redirect to the products create page
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
      
        // Current user
        $user = auth()->user();
        // Validate the request
        $validated = $request->validated();
        $validated['user_id'] = $user->id;
        $categoryIds = $request->input('categories');
 
        $barCode=$this->productService->generateBarCode($validated);

        // Images Url
        if ($request->hasFile('image_url')) {
            $image = $request->file('image_url');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $validated['image_url'] = $image->storeAs('products', $imageName, 'public');
        } else {
            $validated['image_url'] = null;
        }
        // Create a new product
        $product=Products::create($validated);

         // Attach selected categories to pivot table
        if (!empty($categoryIds)) {
            $product->category()->attach($categoryIds);
        }

          // event(new HubSpotRegistered($user));
        $notificationData = [
            'notification_message' => 'A new product has been added.',
        ];
         $product->user->notify(new NewProductAdded($notificationData));

        // Redirect to the products index page
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find the product by ID
        $product = Products::findOrFail($id);

        // Return the product 
        redirect()->route('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Get all categories
        $categories = Categories::all();
        // Find the product by ID
        $product = Products::with(['category:id,name'])
        ->select('id', 'name', 'description', 'price', 'stock', 'image_url', 'user_id', 'status')
        ->where('id', $id)
        ->firstOrFail();
        
        // Return the edit view with the product data
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreProductRequest $request, string $id)
    {
        // Find the product by ID
        $product = Products::findOrFail($id);

        // Validate the request
        $validated = $request->validated();

        // Update the product
        $product->update($validated);

        // Update the categories
        $categoryIds = $request->input('categories');
        if (!empty($categoryIds)) {
            $product->category()->sync($categoryIds);
        } else {
            $product->category()->detach();
        }
        // Redirect to the products index page
        return redirect()->route('products.index')->with('success', 'Product update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the product by ID
        $product = Products::findOrFail($id);

        // Soft delete the product
        $product->delete();

        // Redirect to the products index page
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
