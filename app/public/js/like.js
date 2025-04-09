// 修正がいるもの
// 1."product_id"
// 2."like_product"
// 3.url: '/like_product'

// 4.'toggle_wish'


$(function () {
    $('.toggle_wish').on('click', function () {
        const thread_id = $(this).attr("thread_id");
        const like_thread = $(this).attr("like_thread");
        const click_button = $(this);
        console.log('🧩 thread_id:', thread_id);
        console.log('💗 like_thread:', like_thread);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/like_thread', // Laravel側のルートに合わせる
            type: 'POST',
            data: { 'thread_id': thread_id, 'like_thread': like_thread },
        })
            .done(function (data) {
                if (data.liked) {
                    click_button.attr("like_thread", "1");
                    click_button.children().attr("class", "fas fa-heart");
                    click_button.addClass("liked");
                } else {
                    click_button.attr("like_thread", "0");
                    click_button.children().attr("class", "far fa-heart");
                    click_button.removeClass("liked");
                }
            })
            .fail(function (data) {
                alert('いいね処理失敗');
                alert(JSON.stringify(data));
            });
    });
});
