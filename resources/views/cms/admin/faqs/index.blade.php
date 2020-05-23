@extends('neutrino::admin.template.header-footer')
@section('title', 'FAQs | ')
@section('content')
    <div class="container dashboard">
        <div class="content full">
            <div class="title-search">
                <h2>FAQs <a class="headline-btn" href="/admin/faq/create" role="button">Create New FAQ</a></h2>
            </div>

            <div class="responsive-table">
                <table cellpadding="0" cellspacing="0" class="table">
                    <thead>
                        <tr>
                            <th class="text-left">Title</th>
                            <th width="80">Edit</th>
                            <th width="60"></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach( $faqs as $faq )
                        <tr>
                            <td><a href="/admin/faq/{{$faq->id}}">{{$faq->title}}</a></td>
                            <td class="text-center">
                                <a href="/admin/faq/{{$faq->id}}">Edit</a>
                            </td>
                            <td>
                                <form action="/admin/faq/{{$faq->id}}" method="post">
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

            <div class="pagination-links">
                {{ $faqs->appends($_GET)->links() }}
            </div>

        </div>
    </div>
@endsection
