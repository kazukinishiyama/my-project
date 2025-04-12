<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>スレッド詳細画面</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- CSRF Token -->
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

        img.comment-image {
            max-width: 100%;
            height: auto;
            border-radius: 0.5rem;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container mt-5">

        {{-- エラーメッセージ --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- スレッド表示 -->
        <div class="card mb-4">
            <div class="card-body d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">タイトル：{{ $threads->name }}</h4>

                <!-- いいねボタン -->
                @auth
                    @if ($threads->isLikedBy(auth()->user()))
                        <a class="toggle_wish liked btn btn-outline-danger d-flex align-items-center gap-1 px-2 py-1"
                            thread_id="{{ $threads->id }}" like_thread="1">
                            <i class="fas fa-heart"></i>
                            <span class="like-count">{{ $threads->likes->count() }}</span>
                        </a>
                    @else
                        <a class="toggle_wish btn btn-outline-secondary d-flex align-items-center gap-1 px-2 py-1"
                            thread_id="{{ $threads->id }}" like_thread="0">
                            <i class="far fa-heart"></i>
                            <span class="like-count">{{ $threads->likes->count() }}</span>
                        </a>
                    @endif
                @endauth
            </div>

            <!-- 削除ボタン -->
            @if (Auth::check() && ($threads->user_id === Auth::id() || Auth::user()->isAdmin()))
                <div class="card-footer">
                    @if (Auth::user()->isAdmin())
                        <a href="{{ route('physical_delete.thread', ['thread' => $threads->id]) }}"
                            class="btn btn-danger btn-sm">物理削除</a>
                    @endif
                    <a href="{{ route('logical_delete.thread', ['thread' => $threads->id]) }}"
                        class="btn btn-outline-danger btn-sm">論理削除</a>
                </div>
            @endif
        </div>

        <!-- コメント一覧 -->
        <div class="card mb-4">
            <div class="card-header">コメント一覧</div>
            <ul class="list-group list-group-flush">
                @forelse ($comments as $comment)
                    <li class="list-group-item">
                        <p class="mb-1">{{ $comment->content }}</p>

                        @if ($comment->image_path)
                            <img src="{{ asset('storage/' . $comment->image_path) }}" alt="投稿画像" class="comment-image mb-2">
                        @endif

                        {{-- コメント削除権限：投稿者または管理者 --}}
                        @if (Auth::check() && ($comment->user_id === Auth::id() || Auth::user()->isAdmin()))
                            <div>
                                @if (Auth::user()->isAdmin())
                                    <a href="{{ route('physical_delete.comment', ['thread' => $threads->id, 'comment' => $comment->id]) }}"
                                        class="btn btn-sm btn-danger">物理削除</a>
                                @endif
                                <a href="{{ route('logical_delete.comment', ['thread' => $threads->id, 'comment' => $comment->id]) }}"
                                    class="btn btn-sm btn-outline-danger">論理削除</a>
                            </div>
                        @endif
                    </li>
                @empty
                    <li class="list-group-item text-muted">まだコメントがないよ</li>
                @endforelse
            </ul>
        </div>

        <!-- コメント投稿 -->
        <div class="card mb-4">
            <div class="card-header">コメント投稿</div>
            <div class="card-body">
                <form action="{{ route('create.comment', ['thread' => $threads->id]) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <input type="text" name="content" class="form-control" placeholder="コメントを入力">
                    </div>
                    <div class="mb-3">
                        <input type="file" name="image" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">送信</button>
                </form>
            </div>
        </div>

        <a href="{{ route('create.thread') }}" class="btn btn-secondary">戻る</a>
    </div>

    <!-- JS（いいね機能） -->
    <script src="{{ asset('js/like.js') }}"></script>
    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>