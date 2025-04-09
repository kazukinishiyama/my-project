<!-- detail_threadで実装するもの
スレタイの表示
削除機能（物理＆論理）
コメント機能の追加 -->

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>スレッド詳細画面</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Font Awesome 追加！ -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .toggle_wish i {
            color: #ccc;
            font-size: 24px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .toggle_wish.liked i {
            color: #e25555;
            transform: scale(1.2);
        }

        .toggle_wish i:active {
            transform: scale(1.3);
            opacity: 0.8;
        }
    </style>

</head>


<body>

    @if($errors->any())
        <div class='alert alert-danger'>
            <ul>
                @foreach($errors->all() as $message)
                    <li>
                        {{ $message }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- <p>like_thread: {{ $threads->isLikedBy(Auth::user()) ? 1 : 0 }}</p>
    <p>thread_id: {{ $threads->id }}</p> -->

    <!-- スレタイ表示 -->
    <p>タイトル : {{ $threads->name }}</p>
    <!--  いいねボタン -->

    @if (auth()->user())
        @if ($threads->isLikedBy(auth()->user()))
            <a class="toggle_wish liked" thread_id="{{ $threads->id }}" like_thread="1">
                <i class="fas fa-heart"></i>
            </a>
        @else
            <a class="toggle_wish" thread_id="{{ $threads->id }}" like_thread="0">
                <i class="far fa-heart"></i>
            </a>
        @endif
    @endif


    @if ($threads['user_id'] == Auth::id())
        <!-- 物理削除 -->
        タイトル :
        <a href="{{ route('physical_delete.thread', ['thread' => $threads['id']]) }}"> 物理削除</a>
        <!-- 論理削除 -->
        タイトル :
        <a href="{{ route('logical_delete.thread', ['thread' => $threads['id']]) }}"> 論理削除</a>
    @endif
    <!-- コメント表示 -->
    <ul>
        @forelse ($comments as $comment)
            <li>
                {{ $comment['content'] }}

                @if ($comment->image_path)
                    <img src="{{ asset('storage/' . $comment->image_path) }}" alt="投稿画像" style="max-width: 300px;">
                @endif

                {{-- 自分のコメントだけ削除リンクを表示 --}}
                @if ($comment['user_id'] == Auth::id())
                    <a
                        href="{{ route('physical_delete.comment', ['thread' => $threads['id'], 'comment' => $comment['id']]) }}">物理削除</a>
                    <a
                        href="{{ route('logical_delete.comment', ['thread' => $threads['id'], 'comment' => $comment['id']]) }}">論理削除</a>
                @endif
            </li>
        @empty
            <p>まだコメントがないよ</p>
        @endforelse
    </ul>


    <!-- コメント追加 -->
    <form action="{{ route('create.comment', ['thread' => $threads['id']]) }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="text" name="content" placeholder="コメントを入力">
        <input type="file" name="image">
        <button type="submit">送信</button>
    </form>

    <!-- 戻る -->
    <a href="{{ route('create.thread') }}">戻る</a>
    <script src="{{ asset('js/like.js') }}"></script>
</body>

</html>