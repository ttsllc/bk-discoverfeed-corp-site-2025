<?php

/**
 * ユーザー用ユニークIDを保存するクッキー名
 */
if ( ! defined( 'TCD_REVIEW_VOTE_UNIQUE_ID_COOKIE_NAME' ) ) {
	define( 'TCD_REVIEW_VOTE_UNIQUE_ID_COOKIE_NAME', 'tcd_rvuid' );
}

/**
 * レビュー投票対象の投稿タイプを配列を返す
 */
function get_review_vote_post_types() {
	return (array) apply_filters( 'get_review_vote_post_types', array( 'product' ) );
}

/**
 * レビュー投票テーブル作成
 */
function create_table_review_votes() {
	global $wpdb;

	// テーブル名
	$tablename = $wpdb->prefix . 'tcd_review_votes';

	// テーブルあり
	if ( $wpdb->get_var( "show tables like '{$tablename}'" ) == $tablename ) {
		return true;
	}

	// テーブルが存在しなければテーブル作成
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE `{$tablename}` (
		`id` bigint unsigned NOT NULL AUTO_INCREMENT,
		`unique_id` varchar(255) NOT NULL DEFAULT '',
		`post_id` bigint unsigned NOT NULL DEFAULT '0',
		`review_id` varchar(255) NOT NULL DEFAULT '',
		`value` varchar(255) NOT NULL DEFAULT '',
		`datetime_gmt` datetime DEFAULT NULL,
		PRIMARY KEY (`id`),
		KEY `unique_id` (`unique_id`),
		KEY `post_id` (`post_id`),
		KEY `review_id` (`review_id`),
		KEY `value` (`value`)
	) {$charset_collate} ;";

	dbDelta( $sql );

	if ( $wpdb->get_var( "show tables like '{$tablename}' ") == $tablename ) {
		return true;
	}

	return false;
}
add_action( 'after_switch_theme', 'create_table_review_votes' );

// 管理画面で?create_table_review_votes=1をつけてテーブル作成
function create_table_review_votes_admin_notice() {
	if ( empty( $_GET['create_table_review_votes'] ) ) return;
	if ( ! create_table_review_votes() ) return;

	global $wpdb;

	// テーブル名
	$tablename = $wpdb->prefix . 'tcd_review_votes';

	// テーブルあり
	if ( $wpdb->get_var( "show tables like '{$tablename}'" ) == $tablename ) return;

	// テーブル作成
	if ( ! create_table_review_votes() ) return;

	echo '<div class="notice notice-success"><p>"' . $tablename . '" table created.</p></div>';
}
add_action( 'admin_notices', 'create_table_review_votes_admin_notice' );

/**
 * ユニークID生成
 */
function review_vote_generate_unique_id( $setcookie = true ) {
	global $wpdb;

	// テーブル名
	$tablename = $wpdb->prefix . 'tcd_review_votes';

	$sql = "SELECT id FROM {$tablename} WHERE unique_id = %s LIMIT 1";

	// DBに存在しないユニークID生成
	do {
		// 0-9a-zA-Z
		$unique_id = wp_generate_password( 32, false, false );
	} while ( $wpdb->get_var( $wpdb->prepare( $sql, $unique_id ) ) );

	if ( $setcookie ) {
		setcookie( TCD_REVIEW_VOTE_UNIQUE_ID_COOKIE_NAME, $unique_id, current_time( 'timestamp', true ) + YEAR_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN, is_ssl() );
	}

	return $unique_id;
}

/**
 * ajaxでのレビュー投票追加
 */
function ajax_add_review_vote() {
	global $dp_options;

	$json = array(
		'result' => false
	);

	if ( ! isset( $_POST['post_id'], $_POST['review_id'], $_POST['value'] ) ) {
		$json['message'] = __( 'Invalid request.', 'tcd-w' );
	} elseif ( empty( $_POST['post_id'] ) || empty( $_POST['review_id'] ) || ! in_array( $_POST['value'], array( 'yes', 'no' ) ) ) {
		$json['message'] = __( 'Invalid request.', 'tcd-w' );
	} else {
		$post_id = (int) $_POST['post_id'];
		$review_id = $_POST['review_id'];
		$value = $_POST['value'];

		if ( isset( $_COOKIE[TCD_REVIEW_VOTE_UNIQUE_ID_COOKIE_NAME] ) ) {
			$unique_id = $_COOKIE[TCD_REVIEW_VOTE_UNIQUE_ID_COOKIE_NAME];
		} else {
			$unique_id = review_vote_generate_unique_id( true );
		}

		if ( 0 < $post_id ) {
			$target_post = get_post( $post_id );
		}
		if ( empty( $target_post->post_status ) ) {
			$json['message'] = __( 'Invalid request.', 'tcd-w' );
		} elseif ( 'publish' !== $target_post->post_status ) {
			$json['message'] = sprintf( __( 'Disable review vote in %s.', 'tcd-w' ), __( 'Not publish article', 'tcd-w' ) );
		} elseif ( ! in_array( $target_post->post_type, get_review_vote_post_types(), true ) ) {
			$json['message'] = sprintf( __( 'Disable review vote in %s.', 'tcd-w' ), $target_post->post_type );
		} elseif ( ! $unique_id ) {
			$json['message'] = __( 'Empty unique id.', 'tcd-w' );
		} else {

			// 変更もadd_review_vote
			$result = add_review_vote( $post_id, $review_id, $value, $unique_id );
			if ( $result ) {
				$json['result'] = 'added';

				if ( ! empty( $_POST['result_text'] ) ) {
					$votes = get_meta_review_vote_results( $post_id, $review_id );
					if ( $votes ) {
						$json['result_text'] = sprintf( $_POST['result_text'], $votes['yes'], $votes['yes'] + $votes['no'] );
					}
				}

			// エラー
			} else {
				$json['message'] = 'Add review vote error: ' . __( 'Failed to save the database.', 'tcd-w' );
			}
		}
	}

	// JSON出力
	wp_send_json( $json );
	exit;
}
add_action( 'wp_ajax_add_review_vote', 'ajax_add_review_vote' );
add_action( 'wp_ajax_nopriv_add_review_vote', 'ajax_add_review_vote' );

/**
 * レビュー投票追加・変更
 */
function add_review_vote( $post_id, $review_id, $value, $unique_id = null ) {
	if ( ! $unique_id ) {
		if ( isset( $_COOKIE[TCD_REVIEW_VOTE_UNIQUE_ID_COOKIE_NAME] ) ) {
			$unique_id = $_COOKIE[TCD_REVIEW_VOTE_UNIQUE_ID_COOKIE_NAME];
		} else {
			$unique_id = review_vote_generate_unique_id( true );
		}
	}
	if ( ! $unique_id ) {
		return null;
	}

	$post_id = (int) $post_id;
	if ( 0 >= $post_id ) {
		return null;
	}

	$target_post = get_post( $post_id );
	if ( empty( $target_post->post_status ) || 'publish' !== $target_post->post_status || ! in_array( $target_post->post_type, get_review_vote_post_types(), true ) ) {
		return null;
	}

	global $wpdb;

	// テーブル名
	$tablename = $wpdb->prefix . 'tcd_review_votes';

	// レビュー投票済みの場合更新
	if ( is_review_voted( $post_id, $review_id, null, $unique_id ) ) {
		$ret = $wpdb->update(
			$tablename,
			array(
				'value' => $value,
				'datetime_gmt' => current_time( 'mysql', true )
			),
			array(
				'unique_id' => $unique_id,
				'post_id' => $post_id,
				'review_id' => $review_id
			),
			array(
				'%s',
				'%s'
			),
			array(
				'%s',
				'%d',
				'%s'
			)
		);

	// レビュー投票レコード追加
	} else {
		$ret = $wpdb->insert(
			$tablename,
			array(
				'unique_id' => $unique_id,
				'post_id' => $post_id,
				'review_id' => $review_id,
				'value' => $value,
				'datetime_gmt' => current_time( 'mysql', true )
			),
			array(
				'%s',
				'%d',
				'%s',
				'%s',
				'%s'
			)
		);
	}

	// レビュー投票集計メタ更新
	update_meta_review_vote_results( $post_id, $review_id );

	return $ret;
}

/**
 * レビュー投票削除 （未使用）
 */
function remove_review_vote( $post_id, $review_id, $value = null, $unique_id = null ) {
	if ( ! $unique_id && isset( $_COOKIE[TCD_REVIEW_VOTE_UNIQUE_ID_COOKIE_NAME] ) ) {
		$unique_id = $_COOKIE[TCD_REVIEW_VOTE_UNIQUE_ID_COOKIE_NAME];
	}
	if ( ! $unique_id ) {
		return null;
	}

	$post_id = (int) $post_id;
	if ( 0 >= $post_id ) {
		return null;
	}

	$target_post = get_post( $post_id );
	if ( empty( $target_post->post_status ) || 'publish' !== $target_post->post_status || ! in_array( $target_post->post_type, get_review_vote_post_types(), true ) ) {
		return null;
	}

	// レビュー投票していない場合
	if ( false === is_review_voted( $post_id, $review_id, null, $unique_id ) ) {
		return 0;
	}

	global $wpdb;

	// テーブル名
	$tablename = $wpdb->prefix . 'tcd_review_votes';

	// レビュー投票レコード削除
	 $ret = $wpdb->delete(
		$tablename,
		array(
			'unique_id' => $unique_id,
			'post_id' => $post_id,
			'review_id' => $review_id
		),
		array(
			'%s',
			'%d',
			'%s'
		)
	);

	return $ret;
}

/**
 * レビュー投票済みなら値を取得
 */
function get_review_voted( $post_id = null, $review_id = null, $unique_id = null ) {
	return is_review_voted( $post_id, $review_id, null, $unique_id );
}

/**
 * レビュー投票済みかを判別 $value未指定時は投票済み値を取得
 */
function is_review_voted( $post_id = null, $review_id = null, $value = null, $unique_id = null ) {
	if ( ! $unique_id && isset( $_COOKIE[TCD_REVIEW_VOTE_UNIQUE_ID_COOKIE_NAME] ) ) {
		$unique_id = $_COOKIE[TCD_REVIEW_VOTE_UNIQUE_ID_COOKIE_NAME];
	}
	if ( ! $unique_id || ! $review_id ) {
		return null;
	}

	if ( null === $post_id ) {
		$post_id = get_the_ID();
	}
	$post_id = (int) $post_id;
	if ( 0 >= $post_id ) {
		return null;
	}

	$target_post = get_post( $post_id );
	if ( empty( $target_post->post_status ) || 'publish' !== $target_post->post_status ) {
		return null;
	}

	global $wpdb;

	// テーブル名
	$tablename = $wpdb->prefix . 'tcd_review_votes';

	if ( $value ) {
		$sql = "SELECT id FROM {$tablename} WHERE post_id = %d AND review_id = %s AND unique_id = %s AND value = %s";
		$prepare = array( $post_id, $review_id, $unique_id, $value );

		if ( $wpdb->get_var( $wpdb->prepare( $sql, $prepare ) ) ) {
			return true;
		} else {
			return false;
		}

	} else {
		$sql = "SELECT value FROM {$tablename} WHERE post_id = %d AND review_id = %s AND unique_id = %s";
		$prepare = array( $post_id, $review_id, $unique_id );

		return $wpdb->get_var( $wpdb->prepare( $sql, $prepare ) );
	}
}

/**
 * レビュー毎のレビュー投票集計メタ取得
 */
function get_meta_review_vote_results( $post_id = null, $review_id = null ) {
	if ( ! $review_id ) {
		return null;
	}

	if ( null === $post_id ) {
		$post_id = get_the_ID();
	}
	$post_id = (int) $post_id;
	if ( 0 >= $post_id ) {
		return null;
	}

	$meta = get_post_meta( $post_id, 'review_votes', true );

	if ( isset( $meta[ $review_id ] ) ) {
		return $meta[ $review_id ];
	}

	return array( 'yes' => 0, 'no' => 0 );
}

/**
 * レビュー毎のレビュー投票集計更新
 */
function update_meta_review_vote_results( $post_id = null, $review_id = null ) {
	if ( ! $review_id ) {
		return null;
	}

	if ( null === $post_id ) {
		$post_id = get_the_ID();
	}
	$post_id = (int) $post_id;
	if ( 0 >= $post_id ) {
		return null;
	}

	$meta = get_post_meta( $post_id, 'review_votes', true );
	if ( ! $meta || ! array( $meta ) ) {
		$meta = array();
	}

	global $wpdb;

	// テーブル名
	$tablename = $wpdb->prefix . 'tcd_review_votes';

	$sql = "SELECT value, COUNT(id) AS `count` FROM {$tablename} WHERE post_id = %d AND review_id = %s AND value != '' GROUP BY value" ;
	$prepare = array( $post_id, $review_id );

	$results = $wpdb->get_results( $wpdb->prepare( $sql, $prepare ) );

	$meta[ $review_id ]['yes'] = 0;
	$meta[ $review_id ]['no'] = 0;

	if ( $results ) {
		foreach( $results as $result ) {
			if ( in_array( $result->value, array( 'yes', 'no' ), true ) ) {
				$meta[ $review_id ][ $result->value ] = intval( $result->count );
			}
		}
	}

	return update_post_meta( $post_id, 'review_votes', $meta );
}

/**
 * コンテンツビルダーのレビューコンテンツからレビュー配列を取得
 */
function get_reviews_from_cb_content( $cb_content, $post_id = null ) {
	if ( empty( $cb_content['item_list'] ) || ! is_array( $cb_content['item_list'] ) ) {
		return false;
	}

	if ( null === $post_id ) {
		$post_id = get_the_ID();
	}

	$reviews = array();
	$sort_values = array();
	$sort_values2 = array();

	$use_review_vote = ! empty( $cb_content['use_review_vote'] );

	$sortby = false;
	if ( empty( $cb_content['list_sort'] ) ) {

	} elseif ( 'date_desc' === $cb_content['list_sort'] ) {
		$sortby = 'date_desc';
	} elseif ( 'date_asc' === $cb_content['list_sort'] ) {
		$sortby = 'date_asc';
	} elseif ( 'vote' === $cb_content['list_sort'] && $use_review_vote ) {
		$sortby = 'vote';
	}

	foreach ( $cb_content['item_list'] as $key => $value ) {
		$value['original_key'] = $key;

		if ( ! isset( $value['unique_id'] ) ) {
			$value['unique_id'] = '';
		}

		if ( ! isset( $value['date'] ) ) {
			$value['date'] = '';
		}
		if ( $value['date'] ) {
			$value['date'] = date( 'Y.m.d', strtotime( $value['date'] ) );
		}

		if ( ! isset( $value['rating'] ) ) {
			$value['rating'] = '';
		}
		if ( $value['rating'] && 5 < $value['rating'] ) {
			$value['rating'] = 5;
		}

		$value['vote_yes'] = 0;
		$value['vote_no'] = 0;
		$value['vote_count'] = 0;

		if ( $use_review_vote && $value['unique_id'] ) {
			$votes = get_meta_review_vote_results( $post_id, $value['unique_id'] );
			if ( $votes ) {
				$value['vote_yes'] = $votes['yes'];
				$value['vote_no'] = $votes['no'];
				$value['vote_count'] = $votes['yes'] + $votes['no'];
			}
		}

		// ソート用
		if ( $sortby ) {
			if ( 'vote' === $sortby && $use_review_vote ) {
				if ( $value['vote_count'] ) {
					$value['sort_value'] = sprintf( '%08d%06d', $value['vote_yes'], floor( $value['vote_yes'] / $value['vote_count'] * 10000 ) );
				} else {
					$value['sort_value'] = sprintf( '%08d%06d', 0, 0 );
				}
			} elseif ( $value['date'] ) {
				$value['sort_value'] = $value['date'];
			} else {
				$value['sort_value'] = '0000.00.00';
			}
			$sort_values[] = $value['sort_value'];
			$sort_values2[] = $key;
		}

		$reviews[] = $value;
	}

	// ソート実行 同一日付もあるため元の並び順で$sort_values2を使用
	if ( $sortby ) {
		if ( 'date_asc' === $sortby ) {
			array_multisort( $sort_values, SORT_ASC, $sort_values2, SORT_ASC, $reviews );
		} else {
			array_multisort( $sort_values, SORT_DESC, $sort_values2, SORT_DESC, $reviews );
		}
	}

	return $reviews;
}

