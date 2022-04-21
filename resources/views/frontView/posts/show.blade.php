<?php
/**
 * @var \App\Models\Post $post
 */
$title = '投稿詳細';
?>
@extends('frontView.layouts.base')

@section('content')
    <div class="card-header">{{ $title }}</div>
    <div class="card-body">
        <h2>{{ $post->title }}</h2>
        <time>{{ $post->published_at->format('Y年m月d日') }}</time>
        {{-- nl2brは改行コードe()はエスケープを避ける --}}
        <div>{!! nl2br(e($post->body)) !!}</div>
        {!! link_to_route('home', '一覧へ戻る', null, ['class' => 'btn btn-secondary']) !!}
    </div>
@endsection
