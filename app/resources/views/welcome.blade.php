<!-- <a href="{{ route('thread.create') }}">スタート</a><!DOCTYPE html> -->
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>スタートページ</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome（アイコン用） -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(to right, #c2e9fb, #a1c4fd); /* グラデーション背景 */
        }

        .start-button {
            font-size: 1.5rem;
            padding: 1rem 2rem;
            border-radius: 50px;
        }

        .start-button i {
            margin-right: 10px;
        }
    </style>
</head>
<body>

    <div class="d-flex justify-content-center align-items-center vh-100">
        <a href="{{ route('thread.create') }}" class="btn btn-primary start-button shadow">
            <i class="fas fa-comments"></i> スレッド掲示板をはじめる
        </a>
    </div>

    <!-- Bootstrap JS（オプション） -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
