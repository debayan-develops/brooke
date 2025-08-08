<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContentManagementController extends Controller {

    /**
     * Handle the incoming request.
     */

    public function contentCategory(Request $request)
    {
        return view('admin.contentCategory')->with([
            'title' => 'Content Category',
            // You can pass additional data here if needed
        ]);
    }

    public function contents(Request $request)
    {
        return view('admin.contents')->with([
            'title' => 'Contents',
            // You can pass additional data here if needed
        ]);
    }

}
