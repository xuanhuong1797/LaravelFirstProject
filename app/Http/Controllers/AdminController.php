<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use App\Product;
use App\Category;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:view admin']);
    }
    public function index()
    {
        return view('layouts.admin');
    }
    public function viewCategory()
    {
        return view('admins.category');
    }
    public function viewUser()
    {
        $users = User::all();
        return view('admins.user', compact(['users']));
    }
    public function viewProduct()
    {
        $products = Product::all();
        return view('admins.product', compact(['products']));
    }
    public function viewRole()
    {
        $roles = Role::all();
        return view('admins.role', compact(['roles']));
    }
}
