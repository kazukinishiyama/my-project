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
    <div class="my-navbar-control">
        @if(Auth::check())
            <span class="my-navbar-item">{{ Auth::user()->name}}</span>
            /
            <!-- <a href="#" id="lougout" class="my-navbar-item">ログアウト</a> -->
            <form href="#" id="logout-from" action="{{ route('logout')}}" method="POST" style="display: nome;">
                @csrf
                <input type="submit" value="ログアウト"></input>
            </form>

        @else
            <a class="my-navbar-item" href="{{ route('login')}}">ログイン</a>
            /
            <a class="my-navbar-item" href="{{ route('register')}}">会員登録</a>
        @endif
    </div>
</head>


<body>
    <!-- スレッド作成フォーム -->
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
    <form action="{{ route('create.thread') }}" method="POST">
        @csrf
        新規作成　：
        <input type="text" name="name" placeholder="スレッドタイトルを入力">
        <button type="submit">作成</button>
    </form>

    <!-- 検索フォーム -->

    <!-- スレッド一覧 -->

    <ul>
        <p>タイトル一覧</p>
        @foreach ($threads as $thread)
            <li>
                <a href="{{ route('thread.detail', ['thread' => $thread['id']]) }}">{{ $thread['name'] }}</a>
            </li>
        @endforeach
    </ul>


    <!-- ユーザー情報 -->
    <a href="user.php">ユーザー情報</a>
</body>

</html>