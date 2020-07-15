<?php
namespace Newelement\Faqs\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Newelement\Faqs\Models\Faq;
use Newelement\Faqs\Models\FaqGroup;
use Newelement\Faqs\Models\FaqSetting;
use Newelement\Faqs\Models\FaqSearchStat;
use Newelement\Faqs\Models\FaqVote;
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

$count = 0;

if( $set['show_groups']->bool_value ){
$data->faq_groups = FaqGroup::orderBy('sort')->orderBy('title')->get();
$count = $data->faq_groups->count();
} else {
$data->faqs = Faq::orderBy('sort')->orderBy('title')->get();
$count = $data->faqs->count();
}

return view('faqs::index', ['data' => $data, 'settings' => $set, 'count' => $count]);
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

$data->faq_groups = collect();

$data->faqs = Faq::search($s)->get();
$count = $data->faqs->count();

$stat = new FaqSearchStat;
$stat->query = $s;
$stat->result_count = $count;
$stat->save();

if( $request->ajax() ){
return response()->json(['data' => $data, 'settings' => $set, 'count' => $count]);
} else {
return view('faqs::index', ['data' => $data, 'settings' => $set, 'count' => $count]);
}
}

public function vote(Request $request)
{
$ipAddress = $_SERVER['REMOTE_ADDR'];
$faqId = (int) $request->id;
$helpful = $request->vote;

$faq = Faq::findOrFail($faqId);

$voteExists = FaqVote::where(['faq_id' => $faqId, 'ip_address' => $ipAddress])->exists();

if( !$voteExists ){
$vote = new FaqVote;
if( $helpful === 'y' ){
$faq->helpful = $faq->helpful+1;
$vote->helpful = 1;
$vote->not_helpful = 0;
} elseif ($helpful === 'n') {
$vote->helpful = 0;
$vote->not_helpful = 1;
$faq->not_helpful = $faq->not_helpful+1;
}
$vote->ip_address = $ipAddress;
$vote->faq_id = $faqId;
$vote->save();
$faq->save();
}

if( $voteExists ){
$vote = FaqVote::where(['faq_id' => $faqId, 'ip_address' => $ipAddress])->first();

if( $helpful === 'y' && !$vote->helpful ){
$faq->helpful = $faq->helpful+1;
$vote->helpful = 1;
$vote->not_helpful = 0;
$faq->not_helpful = $faq->helpful-1;
} elseif ($helpful === 'n' && $vote->helpful) {
$vote->helpful = 0;
$vote->not_helpful = 1;
$faq->helpful = $faq->helpful-1;
$faq->not_helpful = $faq->not_helpful+1;
}
$vote->save();
$faq->save();
}

return response()->json(['voted' => true]);
}
}
