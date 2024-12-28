<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use App\Models\Product;

class userController extends Controller
{
    public function logined(Request $request)
    {
        if ($request->email == "admin@example.com") {
            return redirect()->route('dash'); // Redirect to the dashboard if admin
        } else {
            // Find the user by email
            $user = User::where('email', $request->email)->first(); // Use first() to get a single user
    
            // Check if the user exists and whether they are approved
            if ($user && $user->is_approved) {
                // Redirect to product creation page if the user is approved
                return redirect()->route('product.create');
            } else {
                // If the user is not found or not approved, redirect back with an error
                return redirect()->back()->with('error', 'Your account is not approved or does not exist.');
            }

    }
}
    public function save(Request $request)
    {
        // Assuming the request data is stored in $request
        $validatedData = $request->validate([
            'name' =>'required',
            'email' =>'required',
            'password' => 'required',
        ]);

        // Save the user to the database
        User::create($validatedData);

        return redirect()->route('login')->with('success', 'User registered successfully');
    }
    public function data()
    {
        // Fetch all users from the database
        $users = User::all();
        $product=Product::all();
        return view('dashboard', ['users' => $users, 'product' => $product]);
    }
    public function approveUser(User $user)
    {
        $user->is_approved = true; // Set user as approved
        $user->save();
        return redirect()->back()->with('success', 'User approved successfully!');
    }
    public function approveProduct(Product $product)
    {
        $product->is_approved = true; // Set product as approved
        $product->save();
        return redirect()->back()->with('success', 'Product approved successfully!');
    }
    public function create()
    {
        return view('add-product'); // Show the add product form
    }

    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Save the product
        Product::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Product added successfully!');
    }
}
