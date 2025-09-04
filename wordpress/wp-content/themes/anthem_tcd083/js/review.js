jQuery(function($){

	/**
	 * レビューページャー
	 */
	var render_reviews_pager = function ($pager, current_page, max_page) {
		var pagerhtml = ''

		if (current_page > 1) {
			pagerhtml += '<li><a class="prev page-numbers" href="javascript:void(0);"><span>&laquo;</span></a></li>';
		}

		for (var i=1; i<=max_page; i++) {
			if (current_page == i) {
				pagerhtml += '<li><span aria-current="page" class="page-numbers current">' + i + '</span></li>';
			} else {
				pagerhtml += '<li><a class="page-numbers" href="javascript:void(0);" data-page="' + i + '">' + i + '</a></li>';
			}
		}

		if (current_page < max_page) {
			pagerhtml += '<li><a class="next page-numbers" href="javascript:void(0);"><span>&raquo;</span></a></li>';
		}

		if (pagerhtml) {
			pagerhtml = '<ul class="page-numbers">' + pagerhtml + '</ul>';
		}

		$pager.html(pagerhtml);
	};
	$('.product_content.cb_product_review .item_list').each(function(){
		var $item_list = $(this);
		var max_page = $item_list.data('max-page');
		if (max_page <= 1) return;

		var current_page = $item_list.data('current-page') - 0;
		var $items = $item_list.find('.item');

		// アイテム表示・非表示
		$items.filter('.review-page-'+current_page).show();
		$items.not('.review-page-'+current_page).hide();

		var $pager = $('<div class="page_navi clearfix"></div>');
		$item_list.after($pager);

		// ページャー生成
		render_reviews_pager($pager, current_page, max_page);

		// ページャーリンク処理
		$pager.on('click', 'a', function(){
			var $this = $(this);
			var move_page;
			if ($this.hasClass('prev')) {
				move_page = current_page - 1;
			} else if ($this.hasClass('next')) {
				move_page = current_page + 1;
			} else {
				move_page = $this.data('page') - 0;
			}
			if (move_page >= 1 && move_page <= max_page) {
				current_page = move_page;

				// アイテム表示・非表示
				$items.filter('.review-page-'+current_page).show();
				$items.not('.review-page-'+current_page).hide();

				// ページャー再生成
				render_reviews_pager($pager, current_page, max_page);
			}

			return false;
		});
	});

	/**
	 * クッキー有効チェック
	 */
	var checkCookieEnabled = function() {
		if (navigator.cookieEnabled) {
			document.cookie = 'tcd_enabled_cookie=1';
			if (document.cookie) {
				if (document.cookie.indexOf('tcd_enabled_cookie=1') > -1) {
					return true;
				}
			}
		}
		return false;
	}();

	/**
	 * レビュー投票ボタンクリック
	 */
	$('.item_list .item .vote_buttons a.vote_button').on('click', function(){
		var $this = $(this);
		if ($this.hasClass('is-ajaxing') || $this.hasClass('active')) return false;

		if (!checkCookieEnabled) {
			alert(TCD_REVIEW.require_enable_cookies);
			return false;
		}

		var $item_list = $this.closest('.item_list');
		var post_id = $item_list.data('post-id');
		var result_text = $item_list.data('vote-result-text');
		var review_id = $this.data('review-id');
		var vote = $this.data('vote');
		if (!post_id || !review_id || !vote) return false;

		$this.addClass('is-ajaxing')

		$.ajax({
			url: TCD_REVIEW.ajax_url,
			type: 'POST',
			data: {
				action: 'add_review_vote',
				post_id: post_id,
				review_id: review_id,
				value: vote,
				result_text: result_text
			},
			success: function(data, textStatus, XMLHttpRequest) {
				$this.removeClass('is-ajaxing');
				if (data.result == 'added') {
					$this.closest('.vote_buttons').find('a.vote_button.active').removeClass('active');
					$this.addClass('active');
					if (data.result_text) {
						$this.closest('.item').find('.vote_result').text(data.result_text).show();
					}
				} else if (data.message) {
					alert(data.message);
				} else {
					alert(TCD_REVIEW.ajax_error_message);
				}
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
				$this.removeClass('is-ajaxing');
				alert(TCD_REVIEW.ajax_error_message);
			}
		});

		return false;
	});

});
