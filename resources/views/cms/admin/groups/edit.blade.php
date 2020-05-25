@extends('neutrino::admin.template.header-footer')
@section('title', 'Edit FAQ Group | ')
@section('content')
<form action="/admin/faq-group/{{$group->id}}" method="post">
    @csrf
    @method('put')
    <div class="container">
        <div class="content">
            <h2>Edit FAQ Group</h2>

            <div class="form-row">
                <label class="label-col" for="name">Title</label>
                <div class="input-col">
                    <input id="title" type="text" name="title" value="{{ old('title', $group->title) }}" required>
                </div>
            </div>

            <div class="form-row">
                <label class="label-col align-top full-width" for="desc">Description</label>
                <div class="input-col full-width">
                    <textarea  id="desc" name="description">{{ old('description', $group->description) }}</textarea>
                </div>
            </div>

        </div>
        <aside class="sidebar">
            <div class="side-fields">
                <button type="submit" class="btn full text-center">Save FAQ Group</button>
            </div>
        </aside>
    </div>
</form>
@endsection
