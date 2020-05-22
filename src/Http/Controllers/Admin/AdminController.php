<?php
namespace Newelement\Faqs\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Newelement\Faqs\Http\Models\Faq;
use Newelement\Faqs\Http\Models\FaqGroup;
use Newelement\Faqs\Http\Models\FaqSetting;

class IndexController extends Controller
{

    public function index()
    {
        /*
        if( $request->ajax() ){
            return response()->json($data);
        } else {
            return view('faqs::admin.dashboard', $data);
        }
        */
    }

    public function indexGroup()
    {
        /*
        if( $request->ajax() ){
            return response()->json($data);
        } else {
            return view('faqs::admin.dashboard', $data);
        }
        */
    }

    public function show()
    {

    }

    public function get(Faq $faq)
    {

    }

    public function create()
    {

    }

    public function update(Request $request, Faq $faq)
    {

    }

    public function delete(Faq $faq)
    {

    }


    public function showGroup()
    {

    }

    public function getGroup(FaqGroup $group)
    {

    }

    public function createGroup()
    {

    }

    public function updateGroup(Request $request, FaqGroup $group)
    {

    }

    public function deleteGroup(FaqGroup $group)
    {

    }

    public function updateSettings(Request $request)
    {

    }
}
