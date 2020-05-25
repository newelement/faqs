@extends('neutrino::admin.template.header-footer')
@section('title', 'Edit FAQ | ')
@section('content')
<form action="/admin/faqs/{{$faq->id}}" method="post">
    @csrf
    @method('put')
    <div class="container">
        <div class="content">
            <h2>Edit FAQ</h2>

            <div class="form-row">
                <label class="label-col" for="name">Topic</label>
                <div class="input-col">
                    <input id="title" type="text" name="title" value="{{ old('title', $faq->title) }}" required>
                    <input type="hidden" name="slug" value="{{$faq->slug}}">
                </div>
            </div>

            <div class="form-row">
                <label class="label-col align-top full-width" for="answer">Answer</label>
                <div class="input-col full-width">
                    <textarea class="editor" id="answer" name="answer">{!! old('answer', html_entity_decode($faq->answer) ) !!}</textarea>
                </div>
            </div>

            <div class="form-row">
                <label class="label-col" for="group">Group</label>
                <div class="input-col">
                    <div class="select-wrapper">
                        <select id="group" name="faq_groups_id">
                            <option value="">Choose ...</option>
                            @foreach( $groups as $group )
                            <option value="{{$group->id}}" {{ $group->id === $faq->faq_groups_id? 'selected="selected"' : '' }}>{{$group->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <label class="label-col" for="keywords">Keywords</label>
                <div class="input-col">
                    <input id="keywords" type="text" name="keywords" value="{{ old('keywords', $faq->keywords) }}">
                </div>
                <div class="input-notes">
                    <span class="note">Keywords will help search results.</span>
                </div>
            </div>

        </div>
        <aside class="sidebar">
            <div class="side-fields">
                <button type="submit" class="btn full text-center">Save FAQ</button>
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
