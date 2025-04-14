<!-- スレッドPHPで実装するもの
・スレッドの作成機能
→スレッドタイトルの作成
・各スレッドへのリンク
・検索機能
・ユーザー情報へのリンク -->
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>スレッド作成画面</title>
    <!-- Bootstrap CDN追加 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <!-- ナビバー -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm px-4 py-2">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">スレッド掲示板</a>
            <div class="d-flex">
                @if(Auth::check())
                    <span class="navbar-text me-3">{{ Auth::user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-secondary btn-sm">ログアウト</button>
                    </form>
                    <a href="{{ route('users.edit', auth()->id()) }}" class="btn btn-outline-info btn-sm ms-2">ユーザーネーム編集</a>
                @else
                    <a class="btn btn-outline-primary btn-sm me-2" href="{{ route('login') }}">ログイン</a>
                    <a class="btn btn-primary btn-sm" href="{{ route('register') }}">会員登録</a>
                @endif
            </div>
        </div>
    </nav>

    <div class="container mt-4">

        <!-- バリデーションエラー表示 -->
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- 並び替え + スレッド作成フォームを横並び -->
        <div class="row g-3 mb-4">
            <!-- 並び替えフォーム -->
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-body">
                        <form method="GET" action="{{ route('thread.create') }}">
                            <label class="form-label">並び替え</label>
                            <select name="sort" class="form-select mb-2">
                                <option value="">-- 並び替えmenu --</option>
                                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>新しい順</option>
                                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>古い順</option>
                                <option value="likes" {{ request('sort') == 'likes' ? 'selected' : '' }}>いいね順</option>
                            </select>

                            <div class="form-check mb-1">
                                <input class="form-check-input" type="checkbox" name="liked_only" value="1" {{ request('liked_only') ? 'checked' : '' }}>
                                <label class="form-check-label">いいね済みのみ</label>
                            </div>

                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="own_only" value="1" {{ request('own_only') ? 'checked' : '' }}>
                                <label class="form-check-label">自分の投稿のみ</label>
                            </div>

                            <button type="submit" class="btn btn-outline-primary w-100">絞り込み</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- スレッド作成フォーム -->
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-body d-flex align-items-end">
                        <form action="{{ route('create.thread') }}" method="POST" class="w-100 d-flex gap-2">
                            @csrf
                            <input type="text" name="name" class="form-control" placeholder="新規スレッドタイトルを作成">
                            <button type="submit" class="btn btn-success">作成</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- スレッド一覧 -->
        <div class="card">
            <div class="card-header">
                スレッド一覧
            </div>

            <!-- ★ スクロール対応：高さ400px、縦スクロール可 -->
            <ul class="list-group list-group-flush" style="max-height: 400px; overflow-y: auto;">
                @forelse ($threads as $thread)
                    @if (!$thread['del_flg'] || (Auth::check() && Auth::user()->isAdmin()))
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="{{ route('thread.detail', ['thread' => $thread['id']]) }}"
                                class="text-truncate d-inline-block" style="max-width: 80%;">
                                {{ $thread['name'] }}
                            </a>
                            @if ($thread['del_flg'])
                                <span class="badge bg-secondary">削除済</span>
                            @endif
                        </li>
                    @endif
                @empty
                    <li class="list-group-item text-muted">まだスレッドがありません。</li>
                @endforelse
            </ul>
        </div>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>