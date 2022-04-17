
<?php
/**
 * @var Illuminate\Pagination\LengthAwarePaginator|\App\Models\Post[] $posts
 */
$title = '投稿一覧';
?>
 @extends('front.layouts.base'){{--front\layouts\base.blade.phpをここに表示 --}}
 
@section('content') {{-- @extendsで継承したファイル内の@yieldの部分に@section~@endsectionの部分を埋め込む --}}
<div class="card-header">{{ $title }}</div>
<div class="card-body">
    @if($posts->count() <= 0)
        <p>表示する投稿はありません。</p>
    @else
        <table class="table">
            @foreach($posts as $post)
                <tr>
                    <td>{{ $post->published_format }}</td>
                    {{-- link_to_route(ルート,リンクにしたい文字列,URLに付加したいパラメータ) --}}
                    <td>{!! link_to_route('front.posts.show', $post->title, $post) !!}</td>
                </tr>
            @endforeach
        </table>
        <div class="d-flex justify-content-center">
            {{ $posts->links() }}
        </div>
    @endif
</div>
@endsection

