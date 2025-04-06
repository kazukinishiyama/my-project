<!-- detail_threadで実装するもの
スレタイの表示
削除機能（物理＆論理）
コメント機能の追加 -->

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>スレッド詳細画面</title>
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
    </div>
    <!-- スレタイ表示 -->
    <p>タイトル : {{ $threads->name }}</p>
    @if ($threads['user_id'] == Auth::id())
        <!-- 物理削除 -->
        タイトル :
        <a href="{{ route('physical_delete.thread', ['id' => $threads['id']]) }}"> 物理削除</a>
        <!-- 論理削除 -->
        タイトル :
        <a href="{{ route('logical_delete.thread', ['id' => $threads['id']]) }}"> 論理削除</a>
    @endif
    <!-- コメント表示 -->
    <ul>
        @forelse ($comments as $comment)
            <li>
                {{ $comment['content'] }}

                {{-- 自分のコメントだけ削除リンクを表示 --}}
                @if ($comment['user_id'] == Auth::id())
                    <a
                        href="{{ route('physical_delete.comment', ['thread_id' => $threads['id'], 'comment_id' => $comment['id']]) }}">物理削除</a>
                    <a
                        href="{{ route('logical_delete.comment', ['thread_id' => $threads['id'], 'comment_id' => $comment['id']]) }}">論理削除</a>
                @endif
            </li>
        @empty
            <p>まだコメントがないよ</p>
        @endforelse

    </ul>


    <!-- コメント追加 -->
    @auth
        <form action="{{ route('create.comment', ['id' => $threads['id']]) }}" method="post">
            @csrf
            <input type="text" name="content" placeholder="コメントを入力">
            <button type="submit">送信</button>
        </form>
    @else
        <p><a href="{{ route('login') }}">ログイン</a>するとコメントできます！</p>
    @endauth

    <!-- 戻る -->
    <a href="{{ route('create.thread') }}">戻る</a>
</body>

</html>