@extends('layouts.frontend')
@section('title',(!empty($data->meta_title))?$data->meta_title:$data['title'].' | East Coast Puppies')
@section('seo')
    @include('frontend.seo', [ 'description'=>$data->meta_desc??'', 'schema'=>$data['schema_code']??'', 'seo'=>$data['seo_meta']??[] ])
@endsection
@section('customStyles')
    @if(!empty($data['custom_css']))
    <style>
        {!! $data['custom_css']??'' !!}
    </style>
    @endif
@endsection
@section('content')
    @foreach($components as $key => $value)
        @if(isset($value->meta['eye']) && $value->meta['eye'] == 'on')
            @component("frontend.components.{$value->type}",['meta'=>$value->meta, 'key'=>$key, 'page_id'=>$data['id'], 'parent_id'=>$data['parent_id']]) {{$value->title}} @endcomponent
        @endif
    @endforeach
@endsection