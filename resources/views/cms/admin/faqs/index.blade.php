@extends('neutrino::admin.template.header-footer')
@section('title', 'FAQs | ')
@section('content')
    <div class="container dashboard">
        <div class="content full">
            <div class="title-search">
                <h2>FAQs <a class="headline-btn" href="/admin/faqs/create" role="button">Create New FAQ</a></h2>
            </div>

            <div class="responsive-table">
                <table cellpadding="0" cellspacing="0" class="table faqs-table">
                    <thead>
                        <tr>
                            <th width="20"></th>
                            <th class="text-left">@sortablelink('title', 'Title')</th>
                            <th>@sortablelink('faq_groups_id', 'Group')</th>
                            <th width="120">@sortablelink('helpful', 'Helpful')</th>
                            <th width="130">@sortablelink('not_helpful', 'Not Helpful')</th>
                            <th width="80">@sortablelink('sort', 'Sort')</th>
                            <th width="80">Edit</th>
                            <th width="60"></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach( $faqs as $faq )
                        <tr>
                            <td class="sort-handle text-center"><i class="fal fa-sort"></i></td>
                            <td class="faq-item" data-id="{{$faq->id}}"><a href="/admin/faqs/{{$faq->id}}">{{$faq->title}}</a></td>
                            <td class="text-center">@if($faq->faq_group_id)<a href="/admin/faq-group/{{$faq->faq_group_id}}">{{ $faq->group->title }}</a>@endif</td>
                            <td class="text-center">{{ $faq->helpful }}</td>
                            <td class="text-center">{{ $faq->not_helpful }}</td>
                            <td class="text-center faq-sort">{{ $faq->sort }}</td>
                            <td class="text-center">
                                <a href="/admin/faqs/{{$faq->id}}">Edit</a>
                            </td>
                            <td>
                                <form action="/admin/faqs/{{$faq->id}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="delete-btn">&times;</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
