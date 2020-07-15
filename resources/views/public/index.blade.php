@extends('neutrino::layouts.header-footer')
@section('title', $data->title.' | ')

@section('meta_keywords', $data->keywords)
@section('meta_description', $data->meta_description)
@section('og')
<meta property="og:title" content="{{ $data->title }}" />
<meta property="og:description" content="{{ $data->meta_description }}" />
@if( isset($data->social_image_1) && strlen($data->social_image_1) )
@php
$socialImages = getImageSizes($data->social_image_1);
@endphp
<meta property="og:image" content="{{ env('APP_URL') }}{{ $socialImages['original'] }}"/>
@endif
@endsection

@section('content')

<main class="main pt-4 pb-4">
    <div class="container pt-2">
        <h2 class="mb-4">{{ config('faqs.landing_page_title') }}</h2>

        {!! getContent($data->content) !!}

        @if( $settings['enable_search']->bool_value )
        <div class="faqs-search-section">
            <form action="/faqs/search" method="get">
                @if(request('s'))
                <span class="faq-result-count">Results: {{ $count }} found</span>
                @endif
                <input type="text" name="s" class="form-control" value="{{request('s')}}" placeholder="Search">
                <button type="submit" class="btn btn-secondary">Search FAQs</button>
            </form>
        </div>
        @endif

        <div class="faqs-section {{ $settings['display_style']->string_value }} {{ $settings['collapse_faqs']->bool_value? 'faq-collapse' : 'no-faq-collapse' }}">

            @php
            $fullCount = $count;
            @endphp

            @if( $fullCount === 0 )
            {!! html_entity_decode($settings['no_results_message']->text_value) !!}
            @endif

            <ul class="faqs-list {{ $settings['show_groups']->bool_value? 'groups-list' : 'faq-list' }}">
                @if( $settings['show_groups']->bool_value && !strlen(request('s')) )
                @foreach($data->faq_groups as $groupKey => $group)
                <li>
                    <input class="faq-input" id="faq-group-{{$groupKey}}" type="checkbox">
                    <label class="faq-group-topic faq-label" for="faq-group-{{$groupKey}}">
                        {{ $group->title }}
                        @if($group->description)<span class="faq-group-description">{{$group->description}}</span> @endif
                    </label>
                    @if( $group->faqs )
                    <ul class="faq-faqs">
                        @foreach( $group->faqs as $key => $faq )
                        <li>
                            <input class="faq-input" id="faq-{{$groupKey}}-{{$key}}" type="checkbox">
                            <label class="faq-topic faq-label" for="faq-{{$groupKey}}-{{$key}}">{{ $faq->title }}</label>
                            <div class="faq-answer">
                                {!! html_entity_decode($faq->answer) !!}
                                @if($settings['helpful_voting']->bool_value)
                                <p class="faq-helpful">
                                    Was this helpful? &nbsp; <a href="#" class="faq-vote" data-vote="y" data-id="{{$faq->id}}" role="button" rel="nofollow">Yes</a> &nbsp; | &nbsp; <a href="#" class="faq-vote" data-vote="n" data-id="{{$faq->id}}" role="button" rel="nofollow">No</a>
                                </p>
                                @endif
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </li>
                @endforeach
                @else
                @foreach( $data->faqs as $key => $faq )
                <li>
                    <input class="faq-input" id="faq-{{$key}}" type="checkbox">
                    <label class="faq-topic faq-label" for="faq-{{$key}}">{{ $faq->title }}</label>
                    <div class="faq-answer">
                        {!! html_entity_decode($faq->answer) !!}
                        @if($settings['helpful_voting']->bool_value)
                        <p class="faq-helpful">
                            Was this helpful? &nbsp; <a href="#">Yes</a> &nbsp; | &nbsp; <a href="#">No</a>
                        </p>
                        @endif
                    </div>
                </li>
                @endforeach
                @endif
            </ul>
        </div>

    </div>
</main>

@endsection

