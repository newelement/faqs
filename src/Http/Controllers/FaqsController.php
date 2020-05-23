<?php
namespace Newelement\Faqs\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FaqsController extends Controller
{
    public function index()
    {
        return view('faqs::faqs.index');
    }

    public function group($slug)
    {
        return view('faqs::faqs.group');
    }

    public function all(Request $request)
    {
        if( $request->ajax() ){
            return response()->json($data);
        } else {
            return view('faqs::admin.dashboard', $data);
        }
    }

    public function search(Request $request)
    {
        if( $request->ajax() ){
            return response()->json($data);
        } else {
            return view('faqs::admin.dashboard', $data);
        }
    }
}
