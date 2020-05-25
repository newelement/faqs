@extends('neutrino::admin.template.header-footer')
@section('title', 'FAQ Groups | ')
@section('content')
    <div class="container dashboard">
        <div class="content full">
            <div class="title-search">
                <h2>FAQ Groups <a class="headline-btn" href="/admin/faq-group/create" role="button">Create New Group</a></h2>
            </div>

            <div class="responsive-table">
                <table cellpadding="0" cellspacing="0" class="table faq-group-table">
                    <thead>
                        <tr>
                            <th width="20"></th>
                            <th class="text-left">Title</th>
                            <th class="text-left">Description</th>
                            <th width="80">Edit</th>
                            <th width="60"></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach( $groups as $group )
                        <tr>
                            <td class="sort-handle text-center"><i class="fal fa-sort"></i></td>
                            <td class="faq-item" data-id="{{$group->id}}"><a href="/admin/faq-group/{{$group->id}}">{{$group->title}}</a></td>
                            <td>{{ $group->description }}</td>
                            <td class="text-center">
                                <a href="/admin/faq-group/{{$group->id}}">Edit</a>
                            </td>
                            <td>
                                <form action="/admin/faq-group/{{$group->id}}" method="post">
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
