<form action="{{ route('users.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="name">ユーザーネーム:</label>
    <input type="text" name="name" value="{{ old('name', $user->name) }}" required>

    <button type="submit">更新</button>
</form>