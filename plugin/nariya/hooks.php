<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

class G5_NARIYA {

    // Hook 포함 클래스 작성 요령
    // https://github.com/Josantonius/PHP-Hook/blob/master/tests/Example.php
    /**
     * Class instance.
     */

    public static function getInstance() {
        static $instance = null;
        if (null === $instance) {
            $instance = new self();
        }

        return $instance;
    }

    public static function singletonMethod() {
        return self::getInstance();
    }

    public function __construct() {

		$this->add_hooks();
    }

	public function add_hooks() {

		// 공통
		add_event('common_header', array($this, 'common_header'), 10, 5);

		// 글등록
		add_event('write_update_after', array($this, 'write_insert'), 10, 5);

		// 댓글등록
		add_event('comment_update_after', array($this, 'comment_insert'), 10, 5);

		// 확장 플러그인
		if(IS_NA_BBS || IS_NA_XP) {
			// 글삭제
			add_event('bbs_delete', array($this, 'bbs_delete'), 10, 2);

			// 선택삭제
			add_event('bbs_delete_all', array($this, 'bbs_delete_all'), 10, 2);

			// 댓글삭제
			add_event('bbs_delete_comment', array($this, 'bbs_delete'), 10, 2);

			// 새글삭제
			add_event('bbs_new_delete', array($this, 'bbs_new_delete'), 10, 2);

			// 자동등업
			if(IS_NA_XP) {
				add_event('tail_sub', array($this, 'tail_sub'), 10, 0);
			}
		}
	}

	// 공통
	public function common_header() {
		global $config, $board, $nariya;
		global $board_skin_path, $board_skin_url;
		global $member_skin_path, $member_skin_url;
		global $new_skin_path, $new_skin_url;
		global $search_skin_path, $search_skin_url;
		global $connect_skin_path, $connect_skin_url;
		global $faq_skin_path, $faq_skin_url;

		// 모바일 스킨 경로 변경
		if(G5_IS_MOBILE && (!isset($nariya['mobile_skin']) || !$nariya['mobile_skin'])) {
			$board_skin_path    = na_skin_path('board', $board['bo_skin']);
			$board_skin_url     = na_skin_url('board', $board['bo_skin']);
			$member_skin_path   = na_skin_path('member', $config['cf_member_skin']);
			$member_skin_url    = na_skin_url('member', $config['cf_member_skin']);
			$new_skin_path      = na_skin_path('new', $config['cf_new_skin']);
			$new_skin_url       = na_skin_url('new', $config['cf_new_skin']);
			$search_skin_path   = na_skin_path('search', $config['cf_search_skin']);
			$search_skin_url    = na_skin_url('search', $config['cf_search_skin']);
			$connect_skin_path  = na_skin_path('connect', $config['cf_connect_skin']);
			$connect_skin_url   = na_skin_url('connect', $config['cf_connect_skin']);
			$faq_skin_path      = na_skin_path('faq', $config['cf_faq_skin']);
			$faq_skin_url       = na_skin_url('faq', $config['cf_faq_skin']);
		}

		// 로그인 경험치
		if(IS_NA_XP && isset($nariya['xp_login']) && $nariya['xp_login']) {
			global $member;

			if(substr($member['mb_today_login'], 0, 10) != G5_TIME_YMD) {
				na_insert_xp($member['mb_id'], $nariya['xp_login'], G5_TIME_YMD.' 로그인', '@login', $member['mb_id'], G5_TIME_YMD);
	        }
		}

	}   // end function

	// 글등록
	public function write_insert($board, $wr_id, $w, $qstr, $redirect_url) {
		global $g5, $member, $boset, $is_admin, $is_direct, $file_upload_msg;

		$wr = array();

		$bo_table = $board['bo_table'];
		$write_table = $g5['write_prefix'] . $bo_table; // 게시판 테이블;
		$is_save = (isset($boset['na_save_image']) && $boset['na_save_image']) ? true : false;

		// 게시판 확장
		if(IS_NA_BBS) {
			global $as_type, $as_extend, $as_down, $as_view, $as_star_score, $as_star_cnt, $as_choice, $as_choice_cnt, $as_tag;

			$wr = get_write($write_table, $wr_id, true);

			// 필드 확장
			$as_extend = (int)$as_extend;

			// 쿼리문
			$set_sql = ", as_extend = '".$as_extend."'
						, as_down = '".(int)$as_down."'
						, as_view = '".(int)$as_view."'
						, as_choice = '".(int)$as_choice."'
						, as_choice_cnt = '".(int)$as_choice_cnt."'";

			// 메인글
			if($is_admin) {
				global $config;

				$set_sql .= ", as_type = '".$as_type."'";

				// 새글DB 업데이트
				if($wr['wr_datetime'] >= date("Y-m-d H:i:s", G5_SERVER_TIME - ($config['cf_new_del'] * 86400))) {
					sql_query(" update {$g5['board_new_table']} set as_type = '{$as_type}' where bo_table = '{$bo_table}' and wr_id = '{$wr_id}' ", false);
				}
			}

			// 태그
			if(isset($boset['na_tag']) && $boset['na_tag']) {
				$as_tag = na_add_tag($as_tag, $bo_table, $wr_id, $wr['mb_id']);
				$set_sql .= ", as_tag = '".addslashes($as_tag)."'";
			}

			// 별점
			if($as_star_score) {
				$set_sql .= ", as_star_score = '".(int)$as_star_score."', as_star_cnt = '".(int)$as_star_cnt."'";
			}

			// 내용
			if($as_extend) {
				// 필드 확장시
				$data = na_unpack($wr['wr_content']);
				$wr_content = $data['wr_content'];

				// 외부 이미지 저장 후 내용 치환
				if($is_save) {
					list($cnt, $wr_content) = na_content_image($wr_content);
					if($cnt) {
						$data['wr_content'] = $wr_content;
						$set_sql .= ", wr_content = '".addslashes(na_pack($data))."'";
					}
				}
			} else {
				$wr_content = $wr['wr_content'];

				// 외부 이미지 저장 후 내용 치환
				if($is_save) {
					list($cnt, $wr_content) = na_content_image($wr_content);
					if($cnt) {
						$set_sql .= ", wr_content = '".addslashes($wr_content)."'";
					}
				}
			}

			// 이미지 추출을 위해 내용 다시 치환
			$wr['wr_content'] = $wr_content;
			
			// 이미지 초기화
			$wr['as_thumb'] = '';
			$seo_img = na_wr_img($bo_table, $wr);

			// 상대경로로 변경
			$seo_img = str_replace(G5_URL, "./", $seo_img);

			// 업데이트
			sql_query(" update {$write_table} set as_thumb = '".addslashes($seo_img)."'".$set_sql." where wr_id = '{$wr_id}' ");

		} else { 

			// 외부 이미지 저장
			if($is_save) {
				if(!isset($wr['wr_content'])) {
					$wr = get_write($write_table, $wr_id, true);
				}
				list($cnt, $wr_content) = na_content_image($wr['wr_content']);
				if($cnt) {
					sql_query(" update {$write_table} set wr_content = '".addslashes($wr_content)."' where wr_id = '{$wr_id}' ");
				}
			}
		}

		// 경험치
		if(IS_NA_XP) {
			if($member['mb_id'] && $w != 'u' && $boset['xp_write']) {
				$xp_txt = ($w) ? '글답변' : '글쓰기';
				na_insert_xp($member['mb_id'], $boset['xp_write'], "{$board['bo_subject']} {$wr_id} {$xp_txt}", $bo_table, $wr_id, '쓰기');
			}
		}

		// 목록으로 이동
		if($w == '' && $is_direct) {
			if($file_upload_msg) {
				alert($file_upload_msg, short_url_clean(G5_HTTP_BBS_URL.'/board.php?bo_table='.$bo_table));
			} else {
				goto_url(short_url_clean(G5_HTTP_BBS_URL.'/board.php?bo_table='.$bo_table));
			}
		}

	}   // end function

	// 댓글등록
	public function comment_insert($board, $wr_id, $w, $qstr, $redirect_url) {
		global $g5, $member, $comment_id, $boset;

		// 게시판 테이블
		$bo_table = $board['bo_table'];
		$write_table = $g5['write_prefix'] . $bo_table;

		// 쿼리문
		$set_sql = '';

		// 럭키포인트
		$is_lucky = 0;
		if($member['mb_id'] && $comment_id && $w === 'c') {

			// 댓글 럭키 포인트
			$lucky_point = (int)$boset['na_lucky_point'];
			$lucky_dice = (int)$boset['na_lucky_dice'];

			if($lucky_point > 0 && $lucky_dice > 0) {
				// 주사위 굴림
				$dice1 = rand(1, $lucky_dice);
				$dice2 = rand(1, $lucky_dice);
				if($dice1 == $dice2) {
					// 럭키포인트는 게시물당 1번만 당첨
					$sql = " select count(*) as cnt 
									from {$g5['point_table']} 
									where mb_id = '{$member['mb_id']}' 
										and po_rel_table = '$bo_table'
										and po_rel_id = '$wr_id'
										and po_rel_action = '@lucky' ";
					$row = sql_fetch($sql, false);

					// 당첨내역이 없을 경우 포인트 등록
					if(!$row['cnt']) {
						$point = rand(1, $lucky_point);
						$po_content = $board['bo_subject'].' '.$wr_id.' 럭키포인트 당첨!';

						insert_point($member['mb_id'], $point, $po_content, $bo_table, $wr_id, '@lucky');

						$set_sql .= "wr_10 = '".$point."'";
					}
				}
			}
		} 

		// 게시판 플러그인
		if(IS_NA_BBS) {
			global $as_star_score, $as_star_cnt;

			// 별점
			if($as_star_score) {
				if($set_sql)
					$set_sql .= ", ";

				$set_sql .= "as_star_score = '".(int)$as_star_score."', as_star_cnt = '".(int)$as_star_cnt."'";
			}
		}

		// 업데이트
		if($set_sql) {
		    sql_query(" update $write_table set $set_sql where wr_id = '$comment_id' ");
		}

		// 경험치
		if(IS_NA_XP) {
			if($member['mb_id'] && $w != 'cu' && $boset['xp_comment']) {
				na_insert_xp($member['mb_id'], $boset['xp_comment'], "{$board['bo_subject']} {$wr_id}-{$comment_id} 댓글쓰기", $bo_table, $comment_id, '댓글');
			}
		}

	} // end function

	// 새글삭제
	public function bbs_new_delete($chk_bn_id, $save_bo_table){

		if(is_array($chk_bn_id)){
			for($i=0;$i<count($chk_bn_id);$i++){
				
				$k = $chk_bn_id[$i];

				$bo_table = isset($_POST['bo_table'][$k]) ? preg_replace('/[^a-z0-9_]/i', '', $_POST['bo_table'][$k]) : '';
				$wr_id    = isset($_POST['wr_id'][$k]) ? preg_replace('/[^a-z0-9_]/i', '', $_POST['wr_id'][$k]) : 0;

				if($wr_id && $bo_table){
					na_delete($bo_table, $wr_id); // 태그, 신고 등 삭제
				}
			}
		}

	} // end function

	// 선택삭제
	public function bbs_delete_all($tmp_array, $board){

		foreach($tmp_array as $wr_id){
			na_delete($board['bo_table'], $wr_id); // 태그, 신고 등 삭제
		}

	} // end function

	// 글삭제	
	public function bbs_delete($write_id, $board){

		if(is_array($write_id)){
			$delete_id = $write_id['wr_id'];
		} else {
			$delete_id = $write_id;
		}

		$this->bbs_delete_all( array($delete_id), $board );

	} // end function

	// 레벨&등업 메시지
	public function tail_sub(){
		global $g5, $member;

		if($member['mb_id']) {
			switch($member['as_msg']) { //Message
				case '1'	: $msg = '레벨업! '.$member['as_level'].'레벨이 되었습니다.';	break;
				case '2'	: $msg = '레벨다운! '.$member['as_level'].'레벨이 되었습니다.'; break;
				case '3'	: $msg = '등업! '.$member['mb_level'].'등급이 되었습니다.'; break;
				case '4'	: $msg = '등급다운! '.$member['mb_level'].'등급이 되었습니다.'; break;
				default		: $msg = ''; break;
			}

			if($msg) {
				// 회원정보 업데이트
				sql_query(" update {$g5['member_table']} set as_msg = '0' where mb_id = '{$member['mb_id']}' ", false);

				// 메시지
				echo "<script> alert('".$msg."');</script>";
			}
		}
	} // end function
}

$GLOBALS['g5_nariya'] = G5_NARIYA::getInstance();

?>