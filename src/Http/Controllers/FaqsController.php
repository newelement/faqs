<?php
namespace Newelement\Faqs\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Newelement\Faqs\Models\Faq;
use Newelement\Faqs\Models\FaqGroup;
use Newelement\Faqs\Models\FaqSetting;
use Newelement\Faqs\Models\FaqSearchStat;
use Newelement\Neutrino\Models\Page;
use Newelement\Neutrino\Models\ObjectMedia;

class FaqsController extends Controller
{
    public function index()
    {
        $data = Page::where('slug', 'faqs-landing-page')->first();
        $data->title = config('faqs.landing_page_title', 'FAQs');
        $settings = FaqSetting::all();

        $set = [];
        foreach( $settings as $setting ){
            $set[$setting->setting_name] = $setting;
        }

        if( $set['show_groups']->bool_value ){
            $data->faq_groups = FaqGroup::orderBy('sort')->orderBy('title')->get();
        } else {
            $data->faqs = Faq::orderBy('sort')->orderBy('title')->get();
        }

        return view('faqs::index', ['data' => $data, 'settings' => $set]);
    }

    public function group($slug)
    {
        return view('faqs::group');
    }

    public function all(Request $request)
    {
        $settings = FaqSetting::all();

        if( $request->ajax() ){
            return response()->json($data);
        } else {
            return view('faqs::admin.dashboard', $data);
        }
    }

    public function search(Request $request)
    {
        $s = $request->s;

        if( strlen($s) < 3 ){
            return redirect(config('faqs.faqs_slug'));
        }

        $settings = FaqSetting::all();
        $set = [];
        foreach( $settings as $setting ){
            $set[$setting->setting_name] = $setting;
        }

        $data = Page::where('slug', 'faqs-landing-page')->first();
        $data->title = config('faqs.landing_page_title', 'FAQs');

        $count = 0;

        if( $set['show_groups']->bool_value ){
            $data->faq_groups = FaqGroup::search($s)->with('faqs')->get();
            $count = $data->faq_groups->count();
        } else {
            $data->faqs = Faq::search($s)->get();
            $count = $data->faqs->count();
        }

        $stat = new FaqSearchStat;
        $stat->query = $s;
        $stat->result_count = $count;
        $stat->save();

        if( $request->ajax() ){
            return response()->json(['data' => $data, 'settings' => $set]);
        } else {
            return view('faqs::index', ['data' => $data, 'settings' => $set]);
        }
    }
}
