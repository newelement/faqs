@extends('neutrino::admin.template.header-footer')
@section('title', 'FAQs Search Stats | ')
@section('content')
    <div class="container dashboard">
        <div class="content full">
            <div class="title-search">
                <h2>FAQs Search Stats</h2>
            </div>

            <div class="responsive-table">
                <table cellpadding="0" cellspacing="0" class="table">
                    <thead>
                        <tr>
                            <th class="text-left">@sortablelink('query', 'Query')</th>
                            <th width="150">@sortablelink('result_count', 'Result Count')</th>
                            <th width="185">@sortablelink('created_at', 'Created On')</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach( $stats as $stat )
                        <tr>
                            <td>{{$stat->query}}</td>
                            <td class="text-center">{{ $stat->result_count }}</td>
                            <td class="text-center">{{ $stat->created_at->timezone( config('neutrino.timezone') )->format('m-j-y g:i a') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
