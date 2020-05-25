@extends('neutrino::admin.template.header-footer')
@section('title', 'FAQ Settings | ')
@section('content')
<form action="/admin/faq-settings" method="post">
    @csrf
    <div class="container">
        <div class="content">
            <h2>FAQ Settings</h2>

            <div class="form-row">
                <div class="label-col">Enable Search</div>
                <div class="input-col has-checkbox">
                    <label><input id="search" type="checkbox" name="enable_search" value="1" {{ $settings['enable_search']->bool_value? 'checked' : '' }}> <span>Yes</span></label>
                </div>
            </div>

            <div class="form-row">
                <div class="label-col">Show Groups</div>
                <div class="input-col has-checkbox">
                    <label><input id="groups" type="checkbox" name="show_groups" value="1" {{ $settings['show_groups']->bool_value? 'checked' : '' }}> <span>Yes</span></label>
                </div>
            </div>

            <div class="form-row">
                <div class="label-col">Collapsing FAQs List</div>
                <div class="input-col has-checkbox">
                    <label><input id="collap" type="checkbox" name="collapse_faqs" value="1" {{ $settings['collapse_faqs']->bool_value? 'checked' : '' }}> <span>Yes</span></label>
                </div>
                <div class="input-notes">
                    <span class="note">Users can toggle show/hide each FAQ.</span>
                </div>
            </div>

            <div class="form-row">
                <div class="label-col">Helpful Voting</div>
                <div class="input-col has-checkbox">
                    <label><input id="groups" type="checkbox" name="helpful_voting" value="1" {{ $settings['helpful_voting']->bool_value? 'checked' : '' }}> <span>Yes</span></label>
                </div>
                <div class="input-notes">
                    <span class="note">Allow users to vote if a FAQ was helpful or not.</span>
                </div>
            </div>

            <div class="form-row">
                <div class="label-col">Display Style</div>
                <div class="input-col has-checkbox">
                    <label><input type="radio" name="display_style" value="list" {{ $settings['display_style']->string_value === 'list'? 'checked' : '' }}> <span>List</span></label>
                    <label><input type="radio" name="display_style" value="grid" {{ $settings['display_style']->string_value === 'grid'? 'checked' : '' }}> <span>Grid</span></label>
                </div>
                <div class="input-notes">
                    <span class="note">Show FAQs in a list or grid style.</span>
                </div>
            </div>

            <div class="form-row">
                <label class="label-col" for="no-results">No Results Found Message</label>
                <div class="input-col">
                    <textarea class="small-editor" id="no-results" name="no_results_message">{{ html_entity_decode($settings['no_results_message']->text_value) }}</textarea>
                </div>
                <div class="input-notes">
                    <span class="note">Users can toggle show/hide each FAQ.</span>
                </div>
            </div>

        </div>
        <aside class="sidebar">
            <div class="side-fields">
                <button type="submit" class="btn full text-center">Save Settings</button>
            </div>
        </aside>
    </div>
</form>
@endsection

@section('js')
<script>
window.editorStyles = <?php echo json_encode(config('neutrino.editor_styles')) ?>;
window.editorCss = '<?php echo getEditorCss(); ?>';
</script>
@endsection
