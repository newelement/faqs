<?php
namespace Newelement\Faqs\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Newelement\Faqs\Models\Faq;
use Newelement\Faqs\Models\FaqGroup;
use Newelement\Faqs\Models\FaqSetting;
use Newelement\Faqs\Models\FaqSearchStat;

class AdminController extends Controller
{

    public function index()
    {
        $faqs = Faq::sortable(['sort', 'title'])->get();

        return view('faqs::admin.faqs.index', ['faqs' => $faqs]);
    }

    public function indexGroup()
    {
        $groups = FaqGroup::orderBy('sort', 'asc')->orderBy('title', 'asc')->get();

        return view('faqs::admin.groups.index', ['groups' => $groups]);
    }

    public function show()
    {
        $groups = FaqGroup::orderBy('sort', 'asc')->orderBy('title', 'asc')->get();
        return view('faqs::admin.faqs.create', ['groups' => $groups]);
    }

    public function get(Faq $faq)
    {
        $groups = FaqGroup::orderBy('sort', 'asc')->orderBy('title', 'asc')->get();
        return view('faqs::admin.faqs.edit', ['faq' => $faq, 'groups' => $groups]);
    }

    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:400'
        ]);

        $faq = new Faq;
        $faq->title = $request->title;
        $faq->slug = toSlug($request->title, 'faqs');
        $faq->answer = htmlentities($request->answer);
        $faq->keywords = $request->keywords;
        $faq->faq_group_id = $request->faq_groups_id;
        $faq->save();

        return redirect('/admin/faqs/'.$faq->id)->with('success', 'FAQ created.');
    }

    public function update(Request $request, Faq $faq)
    {

        $validatedData = $request->validate([
            'title' => 'required|max:400'
        ]);

        $faq->title = $request->title;
        $faq->slug = $request->slug !== $faq->slug? toSlug( $request->title, 'faqs' ) : $faq->slug ;
        $faq->answer = htmlentities($request->answer);
        $faq->keywords = $request->keywords;
        $faq->faq_group_id = $request->faq_groups_id;
        $faq->save();

        return redirect()->back()->with('success', 'FAQ updated.');
    }

    public function delete(Faq $faq)
    {
        $faq->delete();
        return redirect()->back()->with('success', 'FAQ deleted.');
    }


    public function showGroup()
    {
        return view('faqs::admin.groups.create');
    }

    public function getGroup($id)
    {
        $group = FaqGroup::findOrFail($id);
        return view('faqs::admin.groups.edit', ['group' => $group]);
    }

    public function createGroup(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:400'
        ]);

        $group = new FaqGroup;
        $group->title = $request->title;
        $group->slug = toSlug($request->title, 'faq_groups');
        $group->description = $request->description;
        $group->save();

        return redirect('/admin/faq-group/'.$group->id)->with('success', 'FAQ Group created.');
    }

    public function updateGroup(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:400'
        ]);

        $group = FaqGroup::findOrFail($id);

        $group->title = $request->title;
        $group->slug = $request->slug !== $group->slug? toSlug( $request->title, 'faq_groups' ) : $group->slug ;
        $group->description = $request->description;
        $group->save();

        return redirect()->back()->with('success', 'FAQ Group updated.');
    }

    public function deleteGroup($id)
    {
        $group = FaqGroup::findOrFail($id);
        $group->delete();

        return redirect()->back()->with('success', 'FAQ Group deleted.');
    }

    public function getSettings(Request $request)
    {
        $settings = FaqSetting::all();

        $set = [];
        foreach( $settings as $setting ){
            $set[$setting->setting_name] = $setting;
        }

        return view('faqs::admin.settings.index', ['settings' => $set]);
    }

    public function updateSettings(Request $request)
    {

        $enableSearch = $request->boolean('enable_search');
        $collapseFaqs = $request->boolean('collapse_faqs');
        $showGroups = $request->boolean('show_groups');
        $helpfulVoting = $request->boolean('helpful_voting');
        $displayStyle = $request->display_style;

        FaqSetting::where([
            'setting_name' => 'enable_search'
        ])->update([
            'bool_value' => $enableSearch
        ]);

        FaqSetting::where([
            'setting_name' => 'collapse_faqs'
        ])->update([
            'bool_value' => $collapseFaqs
        ]);

        FaqSetting::where([
            'setting_name' => 'show_groups'
        ])->update([
            'bool_value' => $showGroups
        ]);

        FaqSetting::where([
            'setting_name' => 'helpful_voting'
        ])->update([
            'bool_value' => $helpfulVoting
        ]);

        FaqSetting::where([
            'setting_name' => 'display_style'
        ])->update([
            'string_value' => $displayStyle
        ]);

        return redirect()->back()->with('success', 'Settings updated.');
    }

    public function updateSort(Request $request)
    {
        $items = $request->items;

        foreach( $items as $key => $item ){
            Faq::where('id', $item)->update([
                'sort' => $key
            ]);
        }

        return response()->json(['success' => true]);
    }

    public function updateSortGroup(Request $request)
    {
        $items = $request->items;

        foreach( $items as $key => $item ){
            FaqGroup::where('id', $item)->update([
                'sort' => $key
            ]);
        }
        return response()->json(['success' => true]);
    }

    public function getStats()
    {
        $stats = FaqSearchStat::sortable(['result_count' => 'asc', 'created_at' => 'asc'])->paginate(30);
        return view('faqs::admin.stats.index', ['stats' => $stats]);
    }
}
