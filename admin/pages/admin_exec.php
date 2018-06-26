<?php
	include_once "../../config.php";

	switch ($_REQUEST['exec'])
	{
		
		case "login_admin" :
			$admin_id	= $_REQUEST['admin_id'];
			$admin_pw	= $_REQUEST['admin_pw'];
			$admin_query		= "SELECT * FROM ".$_gl['admin_info_table']." WHERE admin_id='".$admin_id."'";
			$admin_result		= mysqli_query($my_db, $admin_query);
			$admin_data		= mysqli_fetch_array($admin_result);
			// 암호 검증
			if (validate_password($admin_pw,$admin_data['admin_pw']))
			{
				$update_query		= "UPDATE ".$_gl['admin_info_table']." SET admin_lastdate='".date("Y-m-d H:i:s")."' WHERE admin_id='".$admin_data['admin_id']."'";
				$update_result		= mysqli_query($my_db, $update_query);
				// 관리자 아이디, 이름 세션 생성
				$_SESSION['ss_admin_id']			= $admin_data['admin_id'];
				$_SESSION['ss_admin_name']		= $admin_data['admin_name'];
				$flag	= "Y";
			}else{
				$flag	= "N";
			}
			echo $flag;
		break;

		case "join_admin" :
			$admin_id			= $_REQUEST['admin_id'];
			$admin_pw			= $_REQUEST['admin_pw'];
			$admin_name		= $_REQUEST['admin_name'];
			$admin_pw = create_hash($admin_pw);
			$dupli_query		= "SELECT * FROM ".$_gl['admin_info_table']." WHERE admin_id='".$admin_id."'";
			$dupli_result		= mysqli_query($my_db, $dupli_query);
			$dupli_num		= mysqli_fetch_array($dupli_result);
			if ($dupli_num > 0)
			{
				$flag	= "D";
			}else{
				$admin_query		= "INSERT INTO ".$_gl['admin_info_table']."(admin_id,admin_pw,admin_name,admin_regdate) values('".$admin_id."','".$admin_pw."','".$admin_name."','".date('Y-m-d H:i:s')."')";
				$admin_result		= mysqli_query($my_db, $admin_query);
				if ($admin_result > 0)
					$flag	= "Y";
				else
					$flag	= "N";
			}
			echo $flag;
		break;

		case "change_stock_goodscode" :
			$goods_code	= $_REQUEST['goods_code'];

			$goods_query		= "SELECT * FROM ".$_gl['goods_info_table']." WHERE goods_code='".$goods_code."'";
			$goods_result		= mysqli_query($my_db, $goods_query);
			$goods_data			= mysqli_fetch_array($goods_result);

			$return_data			= $goods_data['goods_name']."||".$goods_data['goods_stock']."||".$goods_data['supply_price']."||".$goods_data['goods_sales_cnt']."||".$goods_data['sales_price'];
			echo $return_data;
		break;
		case "show_select_goodscode" :
			$goods_query		= "SELECT * FROM ".$_gl['goods_info_table']."";
			$goods_result		= mysqli_query($my_db, $goods_query);
			$innerHTML	= "<option value=''>선택하세요</option>";
			while ($goods_data	= mysqli_fetch_array($goods_result))
			{
				$innerHTML	.= "<option value='".$goods_data['goods_code']."'>".$goods_data['goods_code']."</option>";
			}
			echo $innerHTML;
		break;

		case "show_select_grade" :
			$grade_query		= "SELECT * FROM ".$_gl['grade_info_table']."";
			$grade_result		= mysqli_query($my_db, $grade_query);
			$innerHTML	= "<option value=''>선택하세요</option>";
			while ($grade_data	= mysqli_fetch_array($grade_result))
			{
				$innerHTML	.= "<option value='".$grade_data['grade_name']."'>".$grade_data['grade_name']."</option>";
			}
			echo $innerHTML;
		break;

		case "show_select_brand" :
			$store_query		= "SELECT * FROM ".$_gl['purchasing_info_table']." WHERE 1 ORDER BY idx ASC";
			$store_result		= mysqli_query($my_db, $store_query);
			$innerHTML	= "<option value=''>선택하세요</option>";
			while ($store_data	= mysqli_fetch_array($store_result))
			{
				$innerHTML	.= "<option value='".$store_data['purchasing_name']."'>".$store_data['purchasing_name']."</option>";
			}
			echo $innerHTML;
		break;

		case "show_select_sales_store" :
			$store_query		= "SELECT * FROM ".$_gl['sales_store_info_table']." WHERE 1 ORDER BY idx ASC";
			$store_result		= mysqli_query($my_db, $store_query);
			$innerHTML	= "<option value=''>선택하세요</option>";
			while ($store_data	= mysqli_fetch_array($store_result))
			{
				$innerHTML	.= "<option value='".$store_data['idx']."'>".$store_data['sales_store_name']."</option>";
			}
			echo $innerHTML;
		break;

		case "show_select_cate1" :
			$cate1_query		= "SELECT * FROM ".$_gl['category_info_table']." WHERE cate_2=0 AND cate_3=0";
			$cate1_result		= mysqli_query($my_db, $cate1_query);
			$innerHTML	= "<option value=''>선택하세요</option>";
			while ($cate1_data	= mysqli_fetch_array($cate1_result))
			{
				$innerHTML	.= "<option value='".$cate1_data['cate_1']."'>".$cate1_data['cate_name']."</option>";
			}
			echo $innerHTML;
		break;

		case "show_select_cate2" :
			$cate_1		= $_REQUEST['cate_1'];
			$cate2_query		= "SELECT * FROM ".$_gl['category_info_table']." WHERE cate_1='".$cate_1."' AND cate_2<>0 AND cate_3=0";
			$cate2_result		= mysqli_query($my_db, $cate2_query);
			$innerHTML	= "<option value=''>선택하세요</option>";
			while ($cate2_data	= mysqli_fetch_array($cate2_result))
			{
				$innerHTML	.= "<option value='".$cate2_data['cate_2']."'>".$cate2_data['cate_name']."</option>";
			}
			echo $innerHTML;
		break;

		case "show_select_cate3" :
			$cate_1		= $_REQUEST['cate_1'];
			$cate_2		= $_REQUEST['cate_2'];
			$cate3_query		= "SELECT * FROM ".$_gl['category_info_table']." WHERE cate_1='".$cate_1."' AND cate_2='".$cate_2."' AND cate_3<>0";
			$cate3_result		= mysqli_query($my_db, $cate3_query);
			$innerHTML	= "<option value=''>선택하세요</option>";
			while ($cate3_data	= mysqli_fetch_array($cate3_result))
			{
				$innerHTML	.= "<option value='".$cate3_data['cate_3']."'>".$cate3_data['cate_name']."</option>";
			}
			echo $innerHTML;
		break;

		case "show_select_banner_type" :
			$banner_query		= "SELECT * FROM ".$_gl['banner_config_info_table']."";
			$banner_result		= mysqli_query($my_db, $banner_query);
			$innerHTML	= "<option value=''>선택하세요</option>";
			while ($banner_data	= mysqli_fetch_array($banner_result))
			{
				$innerHTML	.= "<option value='".$banner_data['banner_type']."'>".$banner_data['banner_type']."</option>";
			}
			echo $innerHTML;
		break;

		case "insert_cate_info" :
			$cate_name			= $_REQUEST['cate_name']; 
			$cate_1				= $_REQUEST['cate_1'];
			$cate_2				= $_REQUEST['cate_2'];
			$cate_3				= $_REQUEST['cate_3'];
			$cate_pcYN			= $_REQUEST['cate_pcYN'];
			$cate_mobileYN		= $_REQUEST['cate_mobileYN'];
			$cate_accessYN		= $_REQUEST['cate_accessYN'];
			$access_specific	= $_REQUEST['access_specific'];
			if ($cate_accessYN == "SPECIFIC")
				$accessYN	= $access_specific;
			else
				$accessYN	= $cate_accessYN;
			if ($cate_1 == "")
			{
				$care1_query		= "SELECT * FROM ".$_gl['category_info_table']." WHERE cate_1 <> 0 and cate_2 = 0 and cate_3 = 0";
				$care1_result		= mysqli_query($my_db, $care1_query);
				$cate1_num			= @mysqli_num_rows($care1_result);
				$cate_1				= $cate1_num + 1;
			}else{
				if ($cate_2 == "")
				{
					$cate2_query		= "SELECT * FROM ".$_gl['category_info_table']." WHERE cate_1='".$cate_1."' AND cate_2 <> 0 and cate_3 = 0";
					$cate2_result		= mysqli_query($my_db, $cate2_query);
					$cate2_num			= @mysqli_num_rows($cate2_result);
					$cate_2				= $cate2_num + 1;
				}else{
					if ($cate_3 == "")
					{
						$cate3_query		= "SELECT * FROM ".$_gl['category_info_table']." WHERE cate_1='".$cate_1."' AND cate_2='".$cate_2."' AND cate_3 <> 0";
						$cate3_result		= mysqli_query($my_db, $cate3_query);
						$cate3_num			= @mysqli_num_rows($cate3_result);
						$cate_3				= $cate3_num + 1;
					}
				}
			}
			$cate_query		= "INSERT INTO ".$_gl['category_info_table']."(cate_1, cate_2, cate_3, cate_name, cate_pcYN, cate_mobileYN, cate_accessYN, cate_date) values('".$cate_1."','".$cate_2."','".$cate_3."','".$cate_name."','".$cate_pcYN."','".$cate_mobileYN."','".$accessYN."','".date("Y-m-d H:i:s")."')";
			$cate_result		= mysqli_query($my_db, $cate_query);
			if ($cate_result)
				$flag	= "Y";
			else
				$flag	= "N";

			$flag 	= $flag."||".$cate_1."||".$cate_2."||".$cate_3; 
			echo $flag;
		break;

		case "insert_event_info" :
			$event_title			= $_REQUEST['event_title'];
			$event_startdate	= $_REQUEST['event_startdate'];
			$event_enddate		= $_REQUEST['event_enddate'];
			$event_contents	= $_REQUEST['event_contents'];

			if ($event_startdate < date("Y-m-d"))
			{
				$flag	= "SN";	// 이벤트 시작일이 현재 날짜보다 작을경우
			}
			else if ($event_enddate < $event_startdate)
			{
				$flag	= "EN";	// 이벤트 종료일이 시작일보다 작을경우
			}else{
				$event_query		= "INSERT INTO ".$_gl['event_info_table']."(event_title, event_startdate, event_enddate, event_contents, event_regdate) values('".$event_title."','".$event_startdate."','".$event_enddate."','".$event_contents."','".date("Y-m-d H:i:s")."')";
				$event_result		= mysqli_query($my_db, $event_query);
				$id_num				= mysqli_insert_id($my_db);

				if ($event_result)
					$flag	= $id_num;
				else
					$flag	= "N";
			}
			echo $flag;
		break;

		case "update_event_info" :
			$idx					= $_REQUEST['idx'];
			$event_title			= $_REQUEST['event_title'];
			$event_startdate	= $_REQUEST['event_startdate'];
			$event_enddate		= $_REQUEST['event_enddate'];
			$event_contents	= $_REQUEST['event_contents'];

			if ($event_startdate < date("Y-m-d"))
			{
				$flag	= "SN";	// 이벤트 시작일이 현재 날짜보다 작을경우
			}
			else if ($event_enddate < $event_startdate)
			{
				$flag	= "EN";	// 이벤트 종료일이 시작일보다 작을경우
			}else{
				$event_query		= "UPDATE ".$_gl['event_info_table']." SET event_title='".$event_title."', event_startdate='".$event_startdate."', event_enddate='".$event_enddate."', event_contents='".$event_contents."', event_latedate='".date("Y-m-d H:i:s")."' WHERE idx='".$idx."'";
				$event_result		= mysqli_query($my_db, $event_query);

				if ($event_result)
					$flag	= "Y";
				else
					$flag	= "N";
			}
			echo $flag;
		break;

		case "insert_post_info" :
			$post_title			= $_REQUEST['post_title'];
			$post_subtitle		= $_REQUEST['post_subtitle'];
			$post_contents		= $_REQUEST['post_contents'];

			$post_query		= "INSERT INTO ".$_gl['post_info_table']."(post_title, post_subtitle, post_contents, post_regdate) values('".$post_title."','".$post_subtitle."','".$post_contents."','".date("Y-m-d H:i:s")."')";
			$post_result		= mysqli_query($my_db, $post_query);
			$id_num			= mysqli_insert_id($my_db);

			if ($post_result)
				$flag	= $id_num;
			else
				$flag	= "N";

			echo $flag;
		break;

		case "update_post_info" :
			$idx					= $_REQUEST['idx'];
			$post_title			= $_REQUEST['post_title'];
			$post_contents		= $_REQUEST['post_contents'];

			$post_query		= "UPDATE ".$_gl['post_info_table']." SET post_title='".$post_title."', post_contents='".$post_contents."', post_latedate='".date("Y-m-d H:i:s")."' WHERE idx='".$idx."'";
			$post_result		= mysqli_query($my_db, $post_query);

			if ($post_result)
				$flag	= "Y";
			else
				$flag	= "N";

			echo $flag;
		break;

		case "update_cate_info" :
			$idx						= $_REQUEST['idx']; 
			$cate_name			= $_REQUEST['cate_name']; 
			$cate_1					= $_REQUEST['cate_1'];
			$cate_2					= $_REQUEST['cate_2'];
			$cate_3					= $_REQUEST['cate_3'];
			$cate_pcYN				= $_REQUEST['cate_pcYN'];
			$cate_mobileYN		= $_REQUEST['cate_mobileYN'];
			$cate_accessYN		= $_REQUEST['cate_accessYN'];
			$access_specific		= $_REQUEST['access_specific'];
			if ($cate_accessYN == "SPECIFIC")
				$accessYN	= $access_specific;
			else
				$accessYN	= $cate_accessYN;
			if ($cate_1 == "")
			{
				$care1_query		= "SELECT * FROM ".$_gl['category_info_table']." WHERE cate_1 <> 0 and cate_2 = 0 and cate_3 = 0";
				$care1_result		= mysqli_query($my_db, $care1_query);
				$cate1_num		= @mysqli_num_rows($care1_result);
				$cate_1				= $cate1_num + 1;
			}else{
				if ($cate_2 == "")
				{
					$cate2_query		= "SELECT * FROM ".$_gl['category_info_table']." WHERE cate_1='".$cate_1."' AND cate_2 <> 0 and cate_3 = 0";
					$cate2_result		= mysqli_query($my_db, $cate2_query);
					$cate2_num		= @mysqli_num_rows($cate2_result);
					$cate_2				= $cate2_num + 1;
				}else{
					if ($cate_3 == "")
					{
						$cate3_query		= "SELECT * FROM ".$_gl['category_info_table']." WHERE cate_1='".$cate_1."' AND cate_2='".$cate_2."' AND cate_3 <> 0";
						$cate3_result		= mysqli_query($my_db, $cate3_query);
						$cate3_num		= @mysqli_num_rows($cate3_result);
						$cate_3				= $cate3_num + 1;
					}
				}
			}
			$cate_query		= "UPDATE ".$_gl['category_info_table']." SET cate_1='".$cate_1."', cate_2='".$cate_2."', cate_3='".$cate_3."', cate_name='".$cate_name."', cate_pcYN='".$cate_pcYN."', cate_mobileYN='".$cate_mobileYN."', cate_accessYN='".$accessYN."' WHERE idx='".$idx."'";
			$cate_result		= mysqli_query($my_db, $cate_query);
			if ($cate_result)
				$flag	= "Y";
			else
				$flag	= "N";
			echo $flag;
		break;

		case "insert_goods_info" :
			$showYN						= $_REQUEST['showYN'];
			$salesYN						= $_REQUEST['salesYN'];
			$cate_1						= $_REQUEST['cate_1'];
			$cate_2						= $_REQUEST['cate_2'];
			$cate_3						= $_REQUEST['cate_3'];
			$related_goods				= $_REQUEST['related_goods'];
			$sales_store					= $_REQUEST['sales_store'];
			$goods_name				= $_REQUEST['goods_name'];
			$goods_eng_name			= $_REQUEST['goods_eng_name'];
			$goods_model				= $_REQUEST['goods_model'];
			$goods_brand				= $_REQUEST['goods_brand'];
			$goods_status				= $_REQUEST['goods_status'];
			$goods_small_desc			= $_REQUEST['goods_small_desc'];
			$goods_middle_desc		= $_REQUEST['goods_middle_desc'];
			$goods_big_desc			= $_REQUEST['goods_big_desc'];
			$m_goods_big_descYN	= $_REQUEST['m_goods_big_descYN'];
			$m_goods_big_desc		= $_REQUEST['m_goods_big_desc'];
			$supply_price				= $_REQUEST['supply_price'];
			$sales_price					= $_REQUEST['sales_price'];
			$saved_priceYN				= $_REQUEST['saved_priceYN'];
			$saved_price					= $_REQUEST['saved_price'];
			$discount_price				= $_REQUEST['discount_price'];
			$goods_optionYN			= $_REQUEST['goods_optionYN'];
			$goods_option_txt			= $_REQUEST['goods_option_txt'];
			$goods_stock				= $_REQUEST['goods_stock'];
			$goods_code				= create_goodscode();

			$goods_query		= "INSERT INTO ".$_gl['goods_info_table']."(showYN,salesYN,cate_1,cate_2,cate_3,related_goods,sales_store,goods_name,goods_eng_name,goods_code,goods_model,goods_brand,goods_status,goods_small_desc,goods_middle_desc,goods_big_desc,m_goods_big_descYN,m_goods_big_desc,supply_price,sales_price,discount_price,saved_priceYN,saved_price,goods_optionYN,goods_option_txt,goods_stock,goods_regdate) values('".$showYN."','".$salesYN."','".$cate_1."','".$cate_2."','".$cate_3."','".$related_goods."','".$sales_store."','".$goods_name."','".$goods_eng_name."','".$goods_code."','".$goods_model."','".$goods_brand."','".$goods_status."','".$goods_small_desc."','".$goods_middle_desc."','".$goods_big_desc."','".$m_goods_big_descYN."','".$m_goods_big_desc."','".$supply_price."','".$sales_price."','".$discount_price."','".$saved_priceYN."','".$saved_price."','".$goods_optionYN."','".$goods_option_txt."','".$goods_stock."','".date("Y-m-d H:i:s")."')";
			$goods_result		= mysqli_query($my_db, $goods_query);
			if ($goods_result)
				$flag	= "Y||".$goods_code;
			else
				$flag	= "N||".$goods_code;
			echo $flag;
		break;

		case "update_goods_info" :
			$showYN						= $_REQUEST['showYN'];
			$salesYN						= $_REQUEST['salesYN'];
			$cate_1						= $_REQUEST['cate_1'];
			$cate_2						= $_REQUEST['cate_2'];
			$cate_3						= $_REQUEST['cate_3'];
			$related_goods				= $_REQUEST['related_goods'];
			$sales_store					= $_REQUEST['sales_store'];
			$goods_name				= $_REQUEST['goods_name'];
			$goods_eng_name			= $_REQUEST['goods_eng_name'];
			$goods_model				= $_REQUEST['goods_model'];
			$goods_brand				= $_REQUEST['goods_brand'];
			$goods_status				= $_REQUEST['goods_status'];
			$goods_small_desc			= $_REQUEST['goods_small_desc'];
			$goods_middle_desc		= $_REQUEST['goods_middle_desc'];
			$goods_big_desc			= $_REQUEST['goods_big_desc'];
			$m_goods_big_descYN	= $_REQUEST['m_goods_big_descYN'];
			$m_goods_big_desc		= $_REQUEST['m_goods_big_desc'];
			$supply_price				= $_REQUEST['supply_price'];
			$sales_price					= $_REQUEST['sales_price'];
			$discount_price				= $_REQUEST['discount_price'];
			$saved_priceYN				= $_REQUEST['saved_priceYN'];
			$saved_price					= $_REQUEST['saved_price'];
			$goods_optionYN			= $_REQUEST['goods_optionYN'];
			$goods_option_txt			= $_REQUEST['goods_option_txt'];
			$goods_stock				= $_REQUEST['goods_stock'];
			$goods_code				= $_REQUEST['goods_code'];
			$goods_query		= "UPDATE ".$_gl['goods_info_table']." SET showYN='".$showYN."',salesYN='".$salesYN."',cate_1='".$cate_1."',cate_2='".$cate_2."',cate_3='".$cate_3."',related_goods='".$related_goods."',sales_store='".$sales_store."',goods_name='".$goods_name."',goods_eng_name='".$goods_eng_name."',goods_model='".$goods_model."',goods_brand='".$goods_brand."',goods_status='".$goods_status."',goods_small_desc='".$goods_small_desc."',goods_middle_desc='".$goods_middle_desc."',goods_big_desc='".$goods_big_desc."',m_goods_big_descYN='".$m_goods_big_descYN."',m_goods_big_desc='".$m_goods_big_desc."',supply_price='".$supply_price."',sales_price='".$sales_price."',discount_price='".$discount_price."',saved_priceYN='".$saved_priceYN."',saved_price='".$saved_price."',goods_optionYN='".$goods_optionYN."',goods_option_txt='".$goods_option_txt."',goods_stock='".$goods_stock."',goods_latedate='".date("Y-m-d H:i:s")."' WHERE goods_code='".$goods_code."'";
			$goods_result		= mysqli_query($my_db, $goods_query);
			if ($goods_result)
				$flag	= "Y";
			else
				$flag	= "N";
			echo $flag;
		break;

		case "edit_best_goods" :
			$goods_code		= $_REQUEST['goods_code'];
			$goods_sequence	= $_REQUEST['goods_sequence'];

			$goods_query		= "UPDATE ".$_gl['goods_info_table']." SET goods_sequence='".$goods_sequence."' WHERE goods_code='".$goods_code."'";
			$goods_result		= mysqli_query($my_db, $goods_query);
		break;

		case "edit_new_goods" :
			$goods_code		= $_REQUEST['goods_code'];
			$goods_sequence	= $_REQUEST['goods_sequence'];

			$goods_query		= "UPDATE ".$_gl['goods_info_table']." SET goods_sequence='".$goods_sequence."' WHERE goods_code='".$goods_code."'";
			$goods_result		= mysqli_query($my_db, $goods_query);
		break;

		case "edit_plan_goods" :
			$goods_code		= $_REQUEST['goods_code'];
			$goods_sequence	= $_REQUEST['goods_sequence'];

			$goods_query		= "UPDATE ".$_gl['goods_info_table']." SET goods_sequence='".$goods_sequence."' WHERE goods_code='".$goods_code."'";
			$goods_result		= mysqli_query($my_db, $goods_query);
		break;

		case "delete_best_goods" :
			$goods_code		= $_REQUEST['goods_code'];

			$goods_query		= "UPDATE ".$_gl['goods_info_table']." SET goods_sequence='0',goods_best_flag='N' WHERE goods_code='".$goods_code."'";
			$goods_result		= mysqli_query($my_db, $goods_query);
		break;

		case "delete_new_goods" :
			$goods_code		= $_REQUEST['goods_code'];

			$goods_query		= "UPDATE ".$_gl['goods_info_table']." SET goods_sequence='0',goods_new_flag='N' WHERE goods_code='".$goods_code."'";
			$goods_result		= mysqli_query($my_db, $goods_query);
		break;

		case "delete_plan_goods" :
			$goods_code		= $_REQUEST['goods_code'];

			$goods_query		= "UPDATE ".$_gl['goods_info_table']." SET goods_sequence='0',goods_plan_flag='N' WHERE goods_code='".$goods_code."'";
			$goods_result		= mysqli_query($my_db, $goods_query);
		break;

		case "show_best_goods_list" :
			$target	= $_REQUEST['target'];
			$list_query		= "SELECT * FROM ".$_gl['goods_info_table']." WHERE goods_best_flag='Y' ORDER BY goods_sequence ASC";
			$list_result		= mysqli_query($my_db, $list_query);
			$innerHTML	= "<thead>";
			$innerHTML	.= "<tr>";
			$innerHTML	.= "<th>상품명</th>";
			$innerHTML	.= "<th>상품코드</th>";
			$innerHTML	.= "<th>상품브랜드</th>";
			$innerHTML	.= "<th>순서</th>";
			$innerHTML	.= "<th></th>";
			$innerHTML	.= "</tr>";
			$innerHTML	.= "</thead>";
			$innerHTML	.= "<tbody>";

			while ($list_data = mysqli_fetch_array($list_result))
			{
				$innerHTML	.= "<tr>";
				$innerHTML	.= "<td>".$list_data['goods_name']."</td>";
				$innerHTML	.= "<td>".$list_data['goods_code']."</td>";
				$innerHTML	.= "<td>".$list_data['goods_brand']."</td>";
				$innerHTML	.= "<td><input class='form-control edit_best_goods' value='".$list_data['goods_sequence']."' edit_code='".$list_data['goods_code']."'></td>";
				$innerHTML	.= "<td><button type='button' class='btn btn-danger del_best_goods' del_code='".$list_data['goods_code']."'>삭제</button></td>";
				$innerHTML	.= "</tr>";
			}
			$innerHTML	.= "</tbody>";
			echo $innerHTML;
		break;

		case "show_new_goods_list" :
			$target	= $_REQUEST['target'];
			$list_query		= "SELECT * FROM ".$_gl['goods_info_table']." WHERE goods_new_flag='Y' ORDER BY goods_sequence ASC";
			$list_result		= mysqli_query($my_db, $list_query);
			$innerHTML	= "<thead>";
			$innerHTML	.= "<tr>";
			$innerHTML	.= "<th>상품명</th>";
			$innerHTML	.= "<th>상품코드</th>";
			$innerHTML	.= "<th>상품브랜드</th>";
			$innerHTML	.= "<th>순서</th>";
			$innerHTML	.= "<th></th>";
			$innerHTML	.= "</tr>";
			$innerHTML	.= "</thead>";
			$innerHTML	.= "<tbody>";

			while ($list_data = mysqli_fetch_array($list_result))
			{
				$innerHTML	.= "<tr>";
				$innerHTML	.= "<td>".$list_data['goods_name']."</td>";
				$innerHTML	.= "<td>".$list_data['goods_code']."</td>";
				$innerHTML	.= "<td>".$list_data['goods_brand']."</td>";
				$innerHTML	.= "<td><input class='form-control edit_new_goods' value='".$list_data['goods_sequence']."' edit_code='".$list_data['goods_code']."'></td>";
				$innerHTML	.= "<td><button type='button' class='btn btn-danger del_new_goods' del_code='".$list_data['goods_code']."'>삭제</button></td>";
				$innerHTML	.= "</tr>";
			}
			$innerHTML	.= "</tbody>";
			echo $innerHTML;
		break;

		case "show_plan_goods_list" :
			$target	= $_REQUEST['target'];
			$list_query		= "SELECT * FROM ".$_gl['goods_info_table']." WHERE goods_plan_flag='Y' ORDER BY goods_sequence ASC";
			$list_result		= mysqli_query($my_db, $list_query);
			$innerHTML	= "<thead>";
			$innerHTML	.= "<tr>";
			$innerHTML	.= "<th>상품명</th>";
			$innerHTML	.= "<th>상품코드</th>";
			$innerHTML	.= "<th>상품브랜드</th>";
			$innerHTML	.= "<th>순서</th>";
			$innerHTML	.= "<th></th>";
			$innerHTML	.= "</tr>";
			$innerHTML	.= "</thead>";
			$innerHTML	.= "<tbody>";

			while ($list_data = mysqli_fetch_array($list_result))
			{
				$innerHTML	.= "<tr>";
				$innerHTML	.= "<td>".$list_data['goods_name']."</td>";
				$innerHTML	.= "<td>".$list_data['goods_code']."</td>";
				$innerHTML	.= "<td>".$list_data['goods_brand']."</td>";
				$innerHTML	.= "<td><input class='form-control edit_plan_goods' value='".$list_data['goods_sequence']."' edit_code='".$list_data['goods_code']."'></td>";
				$innerHTML	.= "<td><button type='button' class='btn btn-danger del_plan_goods' del_code='".$list_data['goods_code']."'>삭제</button></td>";
				$innerHTML	.= "</tr>";
			}
			$innerHTML	.= "</tbody>";
			echo $innerHTML;
		break;

		case "show_category_list" :
			$target	= $_REQUEST['target'];
			$list_query		= "SELECT * FROM ".$_gl['category_info_table']." WHERE 1 ORDER BY cate_1 ASC, cate_2 ASC, cate_3 ASC";
			$list_result		= mysqli_query($my_db, $list_query);
			$innerHTML	= "<thead>";
			$innerHTML	.= "<tr>";
			$innerHTML	.= "<th>1번 카테고리</th>";
			$innerHTML	.= "<th>2번 카테고리</th>";
			$innerHTML	.= "<th>3번 카테고리</th>";
			$innerHTML	.= "<th>카테고리 이미지</th>";
			$innerHTML	.= "<th>카테고리 명</th>";
			$innerHTML	.= "<th>PC 화면 노출여부</th>";
			$innerHTML	.= "<th>MOBILE 화면 노출여부</th>";
			$innerHTML	.= "<th>카테고리 접속 권한</th>";
			$innerHTML	.= "<th>카테고리 생성 날짜</th>";
			$innerHTML	.= "<th></th>";
			$innerHTML	.= "</tr>";
			$innerHTML	.= "</thead>";
			$innerHTML	.= "<tbody>";
			//$i	= 1;
			while ($list_data = mysqli_fetch_array($list_result))
			{
				$innerHTML	.= "<tr>";
				$innerHTML	.= "<td>".$list_data['cate_1']."</td>";
				$innerHTML	.= "<td>".$list_data['cate_2']."</td>";
				$innerHTML	.= "<td>".$list_data['cate_3']."</td>";
				$innerHTML	.= "<td><image src='".$list_data['cate_img_url']."'></td>";
				$innerHTML	.= "<td>".$list_data['cate_name']."</td>";
				$innerHTML	.= "<td>".$list_data['cate_pcYN']."</td>";
				$innerHTML	.= "<td>".$list_data['cate_mobileYN']."</td>";
				$innerHTML	.= "<td>".$list_data['cate_accessYN']."</td>";
				$innerHTML	.= "<td>".$list_data['cate_date']."</td>";
				$innerHTML	.= "<td><a href='./category_detail.php?idx=".$list_data['idx']."'><button type='button' class='btn btn-primary'>수정</button></a> <a href='#' onclick='delete_goods(".$list_data['goods_name'].",".$list_data['goods_code'].");return false;'><button type='button' class='btn btn-danger'>삭제</button></a></td>";
				$innerHTML	.= "</tr>";
				//$i++;
			}
			$innerHTML	.= "</tbody>";
			echo $innerHTML;
		break;

		case "show_event_list" :
			$target	= $_REQUEST['target'];
			$list_query		= "SELECT * FROM ".$_gl['event_info_table']." WHERE 1 ORDER BY idx DESC";
			$list_result		= mysqli_query($my_db, $list_query);
			$innerHTML	= "<thead>";
			$innerHTML	.= "<tr>";
			$innerHTML	.= "<th>이벤트 제목</th>";
			$innerHTML	.= "<th>이벤트 기간</th>";
			$innerHTML	.= "<th>이벤트 등록일</th>";
			$innerHTML	.= "<th></th>";
			$innerHTML	.= "</tr>";
			$innerHTML	.= "</thead>";
			$innerHTML	.= "<tbody>";
			//$i	= 1;
			while ($list_data = mysqli_fetch_array($list_result))
			{
				$innerHTML	.= "<tr>";
				$innerHTML	.= "<td>".$list_data['event_title']."</td>";
				$innerHTML	.= "<td>".substr($list_data['event_startdate'],0,10)." ~ ".substr($list_data['event_enddate'],0,10)."</td>";
				$innerHTML	.= "<td>".$list_data['event_regdate']."</td>";
				$innerHTML	.= "<td><a href='./event_detail.php?idx=".$list_data['idx']."'><button type='button' class='btn btn-primary'>수정</button></a> <a href='#' onclick='delete_event(".$list_data['idx'].");return false;'><button type='button' class='btn btn-danger'>삭제</button></a></td>";
				$innerHTML	.= "</tr>";
				//$i++;
			}
			$innerHTML	.= "</tbody>";
			echo $innerHTML;
		break;

		case "show_post_list" :
			$target	= $_REQUEST['target'];
			$list_query		= "SELECT * FROM ".$_gl['post_info_table']." WHERE 1 ORDER BY idx DESC";
			$list_result		= mysqli_query($my_db, $list_query);
			$innerHTML	= "<thead>";
			$innerHTML	.= "<tr>";
			$innerHTML	.= "<th>포스트 제목</th>";
			$innerHTML	.= "<th>포스트 등록일</th>";
			$innerHTML	.= "<th></th>";
			$innerHTML	.= "</tr>";
			$innerHTML	.= "</thead>";
			$innerHTML	.= "<tbody>";
			//$i	= 1;
			while ($list_data = mysqli_fetch_array($list_result))
			{
				$innerHTML	.= "<tr>";
				$innerHTML	.= "<td>".$list_data['post_title']."</td>";
				$innerHTML	.= "<td>".$list_data['post_regdate']."</td>";
				$innerHTML	.= "<td><a href='./post_detail.php?idx=".$list_data['idx']."'><button type='button' class='btn btn-primary'>수정</button></a> <a href='#' onclick='delete_post(".$list_data['idx'].");return false;'><button type='button' class='btn btn-danger'>삭제</button></a></td>";
				$innerHTML	.= "</tr>";
				//$i++;
			}
			$innerHTML	.= "</tbody>";
			echo $innerHTML;
		break;

		case "show_purchasing_list" :
			$target	= $_REQUEST['target'];
			$list_query		= "SELECT * FROM ".$_gl['purchasing_info_table']." WHERE 1 ORDER BY idx DESC";
			$list_result		= mysqli_query($my_db, $list_query);
			$innerHTML	= "<thead>";
			$innerHTML	.= "<tr>";
			$innerHTML	.= "<th>브랜드명</th>";
			$innerHTML	.= "<th>브랜드 주소</th>";
			$innerHTML	.= "<th>브랜드 전화번호</th>";
			$innerHTML	.= "<th>브랜드 특이사항</th>";
			$innerHTML	.= "<th>브랜드 등록일자</th>";
			$innerHTML	.= "<th>브랜드 최근 정보수정일자</th>";
			$innerHTML	.= "<th></th>";
			$innerHTML	.= "</tr>";
			$innerHTML	.= "</thead>";
			$innerHTML	.= "<tbody>";
			//$i	= 1;
			while ($list_data = mysqli_fetch_array($list_result))
			{
				$innerHTML	.= "<tr>";
				$innerHTML	.= "<td>".$list_data['purchasing_name']."</td>";
				$innerHTML	.= "<td>".$list_data['purchasing_addr']."</td>";
				$innerHTML	.= "<td>".$list_data['purchasing_phone']."</td>";
				$innerHTML	.= "<td>".$list_data['purchasing_desc']."</td>";
				$innerHTML	.= "<td>".$list_data['purchasing_regdate']."</td>";
				$innerHTML	.= "<td>".$list_data['purchasing_latedate']."</td>";
				$innerHTML	.= "<td><a href='./purchasing_detail.php?idx=".$list_data['idx']."'><button type='button' class='btn btn-primary'>수정</button></a> <a href='#' class='del_purchasing' data-idx='".$list_data['idx']."'><button type='button' class='btn btn-danger'>삭제</button></a></td>";
				$innerHTML	.= "</tr>";
				//$i++;
			}
			$innerHTML	.= "</tbody>";
			echo $innerHTML;
		break;

		case "show_sales_store_list" :
			$target	= $_REQUEST['target'];

			$list_query		= "SELECT * FROM ".$_gl['sales_store_info_table']." WHERE 1 ORDER BY idx DESC";
			$list_result		= mysqli_query($my_db, $list_query);
			$innerHTML	= "<thead>";
			$innerHTML	.= "<tr>";
			$innerHTML	.= "<th>판매경로명</th>";
			$innerHTML	.= "<th>판매경로 매체명</th>";
			$innerHTML	.= "<th>판매경로 특이사항</th>";
			$innerHTML	.= "<th>판매경로 등록일자</th>";
			$innerHTML	.= "<th>판매경로 최근 정보수정일자</th>";
			$innerHTML	.= "<th></th>";
			$innerHTML	.= "</tr>";
			$innerHTML	.= "</thead>";
			$innerHTML	.= "<tbody>";
			//$i	= 1;
			while ($list_data = mysqli_fetch_array($list_result))
			{
				$innerHTML	.= "<tr>";
				$innerHTML	.= "<td>".$list_data['sales_store_name']."</td>";
				$innerHTML	.= "<td>".$list_data['sales_store_media']."</td>";
				$innerHTML	.= "<td>".$list_data['sales_store_desc']."</td>";
				$innerHTML	.= "<td>".$list_data['sales_store_regdate']."</td>";
				$innerHTML	.= "<td>".$list_data['sales_store_latedate']."</td>";
				$innerHTML	.= "<td><a href='./sales_store_detail.php?idx=".$list_data['idx']."'><button type='button' class='btn btn-primary'>수정</button></a> <a href='#' class='del_sales_store' data-idx='".$list_data['idx']."'><button type='button' class='btn btn-danger'>삭제</button></a></td>";
				$innerHTML	.= "</tr>";
				//$i++;
			}
			$innerHTML	.= "</tbody>";
			echo $innerHTML;
		break;

		case "show_goods_list" :
			$target	= $_REQUEST['target'];
			$list_query		= "SELECT * FROM ".$_gl['goods_info_table']." WHERE 1 ORDER BY idx DESC";
			$list_result		= mysqli_query($my_db, $list_query);
			$innerHTML	= "<thead>";
			$innerHTML	.= "<tr>";
			$innerHTML	.= "<th>판매경로</th>";
			$innerHTML	.= "<th>진열상태</th>";
			$innerHTML	.= "<th>판매상태</th>";
			$innerHTML	.= "<th>상품 코드</th>";
			$innerHTML	.= "<th>상품명</th>";
			$innerHTML	.= "<th>모델명</th>";
			$innerHTML	.= "<th>판매가</th>";
			$innerHTML	.= "<th>재고</th>";
			$innerHTML	.= "<th>등록일</th>";
			$innerHTML	.= "<th></th>";
			$innerHTML	.= "</tr>";
			$innerHTML	.= "</thead>";
			$innerHTML	.= "<tbody>";
			//$i	= 1;
			while ($list_data = mysqli_fetch_array($list_result))
			{
				// 판매경로 이름 불러오기
				$sales_store	= sales_store_name($list_data['sales_store']);
				$innerHTML	.= "<tr>";
				$innerHTML	.= "<td>".$sales_store."</td>";
				$innerHTML	.= "<td>".$list_data['showYN']."</td>";
				$innerHTML	.= "<td>".$list_data['salesYN']."</td>";
				$innerHTML	.= "<td>".$list_data['goods_code']."</td>";
				$innerHTML	.= "<td><img src='".$list_data['goods_img_url']."' width='80px'>".$list_data['goods_name']."</td>";
				$innerHTML	.= "<td>".$list_data['goods_model']."</td>";
				$innerHTML	.= "<td>".$list_data['sales_price']."</td>";
				$innerHTML	.= "<td>".$list_data['goods_stock']."</td>";
				$innerHTML	.= "<td>".$list_data['goods_regdate']."</td>";
				$innerHTML	.= "<td><a href='./goods_detail.php?goodscode=".$list_data['goods_code']."'><button type='button' class='btn btn-primary'>수정</button></a> <a href='#' class='del_goods' data-goodscode='".$list_data['goods_code']."'><button type='button' class='btn btn-danger'>삭제</button></a></td>";
				$innerHTML	.= "</tr>";
				//$i++;
			}
			$innerHTML	.= "</tbody>";
			echo $innerHTML;
		break;

		case "delete_goods_info" :
			$goodscode	= $_REQUEST['goodscode'];
			$goods_query		= "DELETE FROM ".$_gl['goods_info_table']." WHERE goods_code='".$goodscode."'";
			$goods_result		= mysqli_query($my_db, $goods_query);
			if ($goods_result)
				$flag	= "Y";
			else
				$flag	= "N";
			echo $flag;
		break;

		case "show_stock_list" :
			$target	= $_REQUEST['target'];
			$list_query		= "SELECT * FROM ".$_gl['goods_info_table']." WHERE 1 ORDER BY idx DESC";
			$list_result		= mysqli_query($my_db, $list_query);
			$innerHTML	= "<thead>";
			$innerHTML	.= "<tr>";
			$innerHTML	.= "<th>브랜드명</th>";
			$innerHTML	.= "<th>상품 코드</th>";
			$innerHTML	.= "<th>상품명</th>";
			$innerHTML	.= "<th>매입수</th>";
			$innerHTML	.= "<th>매입금액</th>";
			$innerHTML	.= "<th>매입총액</th>";
			$innerHTML	.= "<th>판매수</th>";
			$innerHTML	.= "<th>판매금액</th>";
			$innerHTML	.= "<th>판매총액</th>";
			$innerHTML	.= "<th>현재재고</th>";
			$innerHTML	.= "</tr>";
			$innerHTML	.= "</thead>";
			$innerHTML	.= "<tbody>";
			//$i	= 1;
			while ($list_data = mysqli_fetch_array($list_result))
			{
				// 매입총액 구하기
				$total_suply_price	= $list_data['supply_price'] * $list_data['goods_stock'];
				// 판매총액 구하기
				$total_sales_price	= $list_data['sales_price'] * $list_data['goods_sales_cnt'];
				// 현재재고 구하기
				$current_stock		= $list_data['goods_stock'] - $list_data['goods_sales_cnt'];
				$innerHTML	.= "<tr>";
				$innerHTML	.= "<td>".$list_data['goods_brand']."</td>";
				$innerHTML	.= "<td>".$list_data['goods_code']."</td>";
				$innerHTML	.= "<td><img src='".$list_data['goods_img_url']."' width='80px'>".$list_data['goods_name']."</td>";
				$innerHTML	.= "<td>".$list_data['goods_stock']."</td>";
				$innerHTML	.= "<td>".number_format($list_data['supply_price'])." 원</td>";
				$innerHTML	.= "<td>".number_format($total_suply_price)." 원</td>";
				$innerHTML	.= "<td>".$list_data['goods_sales_cnt']."</td>";
				$innerHTML	.= "<td>".number_format($list_data['sales_price'])." 원</td>";
				$innerHTML	.= "<td>".number_format($total_sales_price)." 원</td>";
				$innerHTML	.= "<td>".$current_stock."</td>";
				//$innerHTML	.= "<td id='".$list_data['goods_code']."' class='stock_td'>".$list_data['goods_stock']."</td>";
				$innerHTML	.= "</tr>";
				//$i++;
			}
			$innerHTML	.= "</tbody>";
			echo $innerHTML;
		break;

		case "update_stock_info" :
			$goods_code		= $_REQUEST['goods_code'];
			$stock_cnt			= $_REQUEST['stock_cnt'];
			$stock_price			= $_REQUEST['stock_price'];
			$sales_cnt			= $_REQUEST['sales_cnt'];
			$sales_price			= $_REQUEST['sales_price'];
			$stock_edit_desc	= $_REQUEST['stock_edit_desc'];

			// 상품 재고 정보 UPDATE
			$stock_query		= "UPDATE ".$_gl['goods_info_table']." SET goods_stock='".$stock_cnt."', supply_price='".$stock_price."', goods_sales_cnt='".$sales_cnt."',sales_price='".$sales_price."' WHERE goods_code='".$goods_code."'"; 
			$stock_result		= mysqli_query($my_db, $stock_query);

			// 상품 재고 정보 로그 INSERT
			$stock_query2		= "INSERT INTO ".$_gl['stock_change_log_table']."(goods_code,stock_cnt,stock_price,sales_cnt,sales_price,stock_edit_desc,stock_change_regdate) values('".$goods_code."','".$stock_cnt."','".$stock_price."','".$sales_cnt."','".$sales_price."','".$stock_edit_desc."','".date("Y-m-d H:i:s")."')"; 
			$stock_result2		= mysqli_query($my_db, $stock_query2);


			if ($stock_result2)
				$flag	= "Y";
			else
				$flag	= "N";

			echo $flag;
		break;

		case "update_stock_info_bak" :
			$goods_code	= $_REQUEST['goods_code'];
			$goods_stock	= $_REQUEST['goods_stock'];
			$stock_query		= "UPDATE ".$_gl['goods_info_table']." SET goods_stock='".$goods_stock."' WHERE goods_code='".$goods_code."'"; 
			$stock_result		= mysqli_query($my_db, $stock_query);
			if ($stock_result)
				$flag	= "Y";
			else
				$flag	= "N";
			echo $flag;
		break;

		case "insert_purchasing_info" :
			$purchasing_name	= $_REQUEST['purchasing_name'];
			$purchasing_addr	= $_REQUEST['purchasing_addr'];
			$purchasing_phone	= $_REQUEST['purchasing_phone'];
			$purchasing_desc	= $_REQUEST['purchasing_desc'];
			$purchasing_query		= "INSERT INTO ".$_gl['purchasing_info_table']."(purchasing_name,purchasing_addr,purchasing_phone,purchasing_desc,purchasing_regdate) values('".$purchasing_name."','".$purchasing_addr."','".$purchasing_phone."','".$purchasing_desc."','".date("Y-m-d H:i:s")."');"; 
			$purchasing_result		= mysqli_query($my_db, $purchasing_query);
			if ($purchasing_result)
				$flag	= "Y";
			else
				$flag	= "N";
			echo $flag;
		break;

		case "update_purchasing_info" :
			$idx						= $_REQUEST['idx'];
			$purchasing_name	= $_REQUEST['purchasing_name'];
			$purchasing_addr	= $_REQUEST['purchasing_addr'];
			$purchasing_phone	= $_REQUEST['purchasing_phone'];
			$purchasing_desc	= $_REQUEST['purchasing_desc'];
			$purchasing_query		= "UPDATE ".$_gl['purchasing_info_table']." SET purchasing_name='".$purchasing_name."',purchasing_addr='".$purchasing_addr."',purchasing_phone='".$purchasing_phone."',purchasing_desc='".$purchasing_desc."',purchasing_latedate='".date("Y-m-d H:i:s")."' WHERE idx='".$idx."'";
			$purchasing_result		= mysqli_query($my_db, $purchasing_query);
			if ($purchasing_result)
				$flag	= "Y";
			else
				$flag	= "N";
			echo $flag;
		break;

		case "insert_sales_store_info" :
			$sales_store_name		= $_REQUEST['sales_store_name'];
			$sales_store_media		= $_REQUEST['sales_store_media'];
			$sales_store_desc		= $_REQUEST['sales_store_desc'];

			$sales_store_query		= "INSERT INTO ".$_gl['sales_store_info_table']."(sales_store_name, sales_store_media, sales_store_desc, sales_store_regdate) values('".$sales_store_name."','".$sales_store_media."','".$sales_store_desc."','".date("Y-m-d H:i:s")."');"; 
			$sales_store_result		= mysqli_query($my_db, $sales_store_query);
			if ($sales_store_result)
				$flag	= "Y";
			else
				$flag	= "N";
			echo $flag;
		break;

		case "update_sales_store_info" :
			$idx						= $_REQUEST['idx'];
			$sales_store_name		= $_REQUEST['sales_store_name'];
			$sales_store_media		= $_REQUEST['sales_store_media'];
			$sales_store_desc		= $_REQUEST['sales_store_desc'];

			$sales_store_query		= "UPDATE ".$_gl['sales_store_info_table']." SET sales_store_name='".$sales_store_name."',sales_store_media='".$sales_store_media."',sales_store_desc='".$sales_store_desc."',sales_store_latedate='".date("Y-m-d H:i:s")."' WHERE idx='".$idx."'";
			$sales_store_result		= mysqli_query($my_db, $sales_store_query);
			if ($sales_store_result)
				$flag	= "Y";
			else
				$flag	= "N";
			echo $flag;
		break;

		case "show_banner_detail" :
			$banner_type	= $_REQUEST['banner_type'];
			$list_query		= "SELECT * FROM ".$_gl['banner_config_info_table']." WHERE banner_type='".$banner_type."'";
			$list_result		= mysqli_query($my_db, $list_query);
			$list_data = mysqli_fetch_array($list_result);
			echo $list_data['banner_speed']."||".$list_data['banner_time']."||".$list_data['banner_effect'];
		break;

		// 회원가입시 아이디 중복체크
		case "duplicate_check": 
			$input = $_REQUEST['input'];
			$chk_id_query 	= "SELECT * FROM ".$_gl['member_info_table']." WHERE mb_id='".$input."'";
			$chk_id_result 	= mysqli_query($my_db, $chk_id_query);
			$chk_id_data	= mysqli_num_rows($chk_id_result);
			if($chk_id_data > 0) {
				$flag = "N";
			}else{
				$flag = "Y";
			}
			echo $flag;
		break;

		case "member_join":
			$user_id = preg_replace("/\s+/", "", $_POST['user_id']);
			$password = preg_replace("/\s+/", "", $_POST['password']);
			$username = preg_replace("/\s+/", "", $_POST['username']);
			$zipcode = $_POST['zipcode'];
			$addr1 = $_POST['addr1'];
			$addr2 = trim($_POST['addr2']);
			$email1 = preg_replace("/\s+/", "", $_POST['email1']);
			$email2 = $_POST['email2'];
			$emailYN = $_POST['emailYN'];
			$tel1 = $_POST['tel1'];
			$tel2 = preg_replace("/\s+/", "", $_POST['tel2']);
			$tel3 = preg_replace("/\s+/", "", $_POST['tel3']);
			$phone1 = $_POST['phone1'];
			$phone2 = $_POST['phone2'];
			$phone3 = $_POST['phone3'];
			$smsYN = $_POST['smsYN'];
			$birthY = preg_replace("/\s+/", "", $_POST['birthY']);
			$birthM = preg_replace("/\s+/", "", $_POST['birthM']);
			$birthD = preg_replace("/\s+/", "", $_POST['birthD']);
			$email = $email1 . '@' . $email2;
			if($tel2 == '') {
				$tel = '';
			}else{
				$tel = $tel1 . '-' . $tel2 . '-' . $tel3;
			}
			$phone = $phone1 . '-' . $phone2 . '-' . $phone3;
			if($birthY !== '' && $birthM !== '' && $birthD !== '') {
				if($birthM < 10 && strlen($birthM) < 2) {
					$birthM = "/0".$birthM;
				}else{
					$birthM = "/".$birthM;
				}
				if($birthD < 10 && strlen($birthD) < 2) {
					$birthD = "/0".$birthD;
				}else{
					$birthD = "/".$birthD;
				}
			}
			$birth = $birthY . $birthM . $birthD;
			// 등급 수정할것
			$grade = "silver";
			$insert_query    = "INSERT INTO ".$_gl['member_info_table']."(mb_id, mb_password, mb_name, mb_birth, mb_address1, mb_address2, mb_zipcode, mb_telphone, mb_handphone, mb_smsYN, mb_email, mb_emailYN, mb_grade, mb_join_date, mb_join_ipaddr) values('".$user_id."','".$password."','".$username."','".$birth."','".$addr1."','".$addr2."','".$zipcode."','".$tel."','".$phone."','".$smsYN."','".$email."','".$emailYN."','".$grade."','".date("Y-m-d H:i:s")."','".$_SERVER['REMOTE_ADDR']."')";
			$insert_result   = mysqli_query($my_db, $insert_query);
			// result - 메일 발송
			if($insert_result) {
				$mail_reult = sendMail("ojoonwoo2@gmail.com", "촌의감각", "회원가입을 축하합니다.", "내용", "ojoonwoo@naver.com", "$username");
				$flag = "Y";
			}else{
				$flag = "N";
			}
			echo $flag;
		break;

		case "member_modify":
			$user_id = preg_replace("/\s+/", "", $_POST['user_id']);
			$password = preg_replace("/\s+/", "", $_POST['password']);
			$username = preg_replace("/\s+/", "", $_POST['username']);
			$zipcode = $_POST['zipcode'];
			$addr1 = $_POST['addr1'];
			$addr2 = trim($_POST['addr2']);
			$email1 = preg_replace("/\s+/", "", $_POST['email1']);
			$email2 = $_POST['email2'];
			$emailYN = $_POST['emailYN'];
			$tel1 = $_POST['tel1'];
			$tel2 = preg_replace("/\s+/", "", $_POST['tel2']);
			$tel3 = preg_replace("/\s+/", "", $_POST['tel3']);
			$phone1 = $_POST['phone1'];
			$phone2 = $_POST['phone2'];
			$phone3 = $_POST['phone3'];
			$smsYN = $_POST['smsYN'];
			$birthY = preg_replace("/\s+/", "", $_POST['birthY']);
			$birthM = preg_replace("/\s+/", "", $_POST['birthM']);
			$birthD = preg_replace("/\s+/", "", $_POST['birthD']);
			$email = $email1 . '@' . $email2;
			if($tel2 == '') {
				$tel = '';
			}else{
				$tel = $tel1 . '-' . $tel2 . '-' . $tel3;
			} 
			$phone = $phone1 . '-' . $phone2 . '-' . $phone3;
			if($birthM !== '' && ($birthM < 10 && strlen($birthM) < 2)) {
				$birthM = "/0".$birthM;
			}else{
				$birthM = "/".$birthM;
			}
			if($birthD !== '' && ($birthD < 10 && strlen($birthD) < 2)) {
				$birthD = "/0".$birthD;
			}else{
				$birthD = "/".$birthD;
			}
			$birth = $birthY . $birthM . $birthD;
			$update_query = "UPDATE ".$_gl['member_info_table']." SET mb_password='".$password."',mb_name='".$username."',mb_birth='".$birth."',mb_address1='".$addr1."',mb_address2='".$addr2."',mb_zipcode='".$zipcode."',mb_telphone='".$tel."',mb_handphone='".$phone."',mb_smsYN='".$smsYN."',mb_email='".$email."',mb_emailYN='".$emailYN."',mb_update_date='".date("Y-m-d H:i:s")."' WHERE mb_id='".$user_id."'";
			$update_result   = mysqli_query($my_db, $update_query);
			if($update_result) {
				$flag = "Y";
			}else{
				$flag = "N";
			}
			echo $flag;
		break;

		// 회원수정시 회원본인인지 체크
		case "member_check":
			$m_id = $_REQUEST['m_id'];
			$m_pw = $_REQUEST['m_pw'];
			$pw_query		= "SELECT mb_id,mb_name,mb_handphone,mb_telphone,mb_zipcode,mb_address1,mb_address2,mb_birth,mb_email,mb_emailYN,mb_smsYN FROM ".$_gl['member_info_table']." WHERE mb_id='".$m_id."' AND mb_password='".$m_pw."'";
			$pw_result		= mysqli_query($my_db, $pw_query);
			$pw_data 		= mysqli_fetch_array($pw_result);
			if($pw_data) {
				$flag = "Y";
			}else{
				$flag = "N";
			}
			echo $flag;
			// $id_query		= "SELECT * FROM ".$_gl['member_info_table']." WHERE mb_id='".$m_id."'";
			// $id_result		= mysqli_query($my_db, $id_query);
			// $id_data = mysqli_fetch_array($id_result);
			// if($id_data) { // 아이디가 있을경우 입력한 비밀번호 검사
			// 	$pw_query		= "SELECT mb_id,mb_name,mb_question,mb_answer,mb_handphone,mb_telphone,mb_zipcode,mb_address1,mb_address2,mb_birth,mb_email,mb_emailYN,mb_gender,mb_smsYN FROM ".$_gl['member_info_table']." WHERE mb_id='".$id_data['mb_id']."' AND mb_password='".$m_pw."'";
			// 	$pw_result		= mysqli_query($my_db, $pw_query);
			// 	$pw_data 		= mysqli_fetch_array($pw_result);
			// 	if($pw_data) {
			// 		echo json_encode($pw_data);
			// 	}else{
			// 		echo json_encode("P");
			// 	}
			// }else{ // 입력한 아이디가 없는경우
			// 	echo json_encode("N");
			// }
		break;

		case "show_member_list" :
			$target	= $_REQUEST['target'];
			$list_query		= "SELECT * FROM ".$_gl['member_info_table']." WHERE 1 ORDER BY idx DESC";
			$list_result		= mysqli_query($my_db, $list_query);
			$innerHTML	= "<thead>";
			$innerHTML	.= "<tr>";
			$innerHTML	.= "<th><input type='checkbox' name='all_check' id='all_check'></th>";
			$innerHTML	.= "<th>순번</th>";
			$innerHTML	.= "<th>아이디</th>";
			$innerHTML	.= "<th>이름</th>";
			$innerHTML	.= "<th>등급</th>";
			$innerHTML	.= "<th>회원가입일시</th>";
			$innerHTML	.= "<th>최종로그인</th>";
			$innerHTML	.= "<th>메일/SMS 발송</th>";
			$innerHTML	.= "<th>정보수정</th>";
			$innerHTML	.= "</tr>";
			$innerHTML	.= "</thead>";
			$innerHTML	.= "<tbody>";
			//$i	= 1;
			while ($list_data = mysqli_fetch_array($list_result))
			{
				$user_id = $list_data['mb_id'];
				$innerHTML	.= "<tr>";
				$innerHTML	.= "<td><input type='checkbox' name='one_check' id='one_check'></td>";
				$innerHTML	.= "<td></td>";
				$innerHTML	.= "<td>".$list_data['mb_id']."</td>";
				$innerHTML	.= "<td>".$list_data['mb_name']."</td>";
				$innerHTML	.= "<td>".$list_data['mb_grade']."</td>";
				$innerHTML	.= "<td>".$list_data['mb_join_date']."</td>";
				$innerHTML	.= "<td>".$list_data['mb_login_date']."</td>";
				$innerHTML	.= "<td><input type='button' id='send_mail' onclick='sendMail();' value='메일'>&nbsp;
										<input type='button' id='send_sms' onclick='sendSMS();' value='SMS'></td>";
				$innerHTML	.= "<td><a href='./modify_form.php?userid=".$list_data['mb_id']."'>
											<input type='button' value='수정'><a></td>";
				$innerHTML	.= "</tr>";
				//$i++;
			}
			$innerHTML	.= "</tbody>";
			echo $innerHTML;
		break;

		case "member_modify":
			$user_id = preg_replace("/\s+/", "", $_POST['user_id']);
			$password = preg_replace("/\s+/", "", $_POST['password']);
			$username = preg_replace("/\s+/", "", $_POST['username']);
			$zipcode = $_POST['zipcode'];
			$addr1 = $_POST['addr1'];
			$addr2 = trim($_POST['addr2']);
			$email1 = preg_replace("/\s+/", "", $_POST['email1']);
			$email2 = $_POST['email2'];
			$emailYN = $_POST['emailYN'];
			$tel1 = $_POST['tel1'];
			$tel2 = preg_replace("/\s+/", "", $_POST['tel2']);
			$tel3 = preg_replace("/\s+/", "", $_POST['tel3']);
			$phone1 = $_POST['phone1'];
			$phone2 = $_POST['phone2'];
			$phone3 = $_POST['phone3'];
			$smsYN = $_POST['smsYN'];
			$birthY = preg_replace("/\s+/", "", $_POST['birthY']);
			$birthM = preg_replace("/\s+/", "", $_POST['birthM']);
			$birthD = preg_replace("/\s+/", "", $_POST['birthD']);
			$grade = preg_replace("/\s+/", "", $_POST['grade']);
			$email = $email1 . '@' . $email2;
			if($tel2 == '') {
				$tel = '';
			}else{
				$tel = $tel1 . '-' . $tel2 . '-' . $tel3;
			} 
			$phone = $phone1 . '-' . $phone2 . '-' . $phone3;
			if($birthM !== '' && ($birthM < 10 && strlen($birthM) < 2)) {
				$birthM = "/0".$birthM;
			}else{
				$birthM = "/".$birthM;
			}
			if($birthD !== '' && ($birthD < 10 && strlen($birthD) < 2)) {
				$birthD = "/0".$birthD;
			}else{
				$birthD = "/".$birthD;
			}
			$birth = $birthY . $birthM . $birthD;
			$update_query = "UPDATE ".$_gl['member_info_table']." SET mb_password='".$password."',mb_name='".$username."',mb_birth='".$birth."',mb_address1='".$addr1."',mb_address2='".$addr2."',mb_zipcode='".$zipcode."',mb_telphone='".$tel."',mb_handphone='".$phone."',mb_smsYN='".$smsYN."',mb_email='".$email."',mb_emailYN='".$emailYN."',mb_grade='".$grade."',mb_update_date='".date("Y-m-d H:i:s")."' WHERE mb_id='".$user_id."'";
			$update_result   = mysqli_query($my_db, $update_query);
			if($update_result) {
				$flag = "Y";
			}else{
				$flag = "N";
			}
			echo $flag;
		break;

		case "insert_banner_info" :
			$banner_name			= $_REQUEST['banner_name'];
			$device_type			= $_REQUEST['device_type'];
			$banner_type			= $_REQUEST['banner_type'];
			$banner_value			= $_REQUEST['banner_value'];
			$banner_showYN			= $_REQUEST['banner_showYN'];
			$banner_show_order		= $_REQUEST['banner_show_order'];
			$banner_link_target		= $_REQUEST['banner_link_target'];
			
			$order_duplicate_query	= "SELECT * FROM ".$_gl['banner_info_table']." WHERE 1 AND banner_type = '".$banner_type."' AND device_type = '".$device_type."' AND banner_show_order = '".$banner_show_order."' AND banner_showYN = 'Y'";
			$duplicate_result = mysqli_query($my_db, $order_duplicate_query);
			if($duplicate_result){
				$duplicate_data = mysqli_fetch_array($duplicate_result);
				$update_show_order_query = "UPDATE ".$_gl['banner_info_table']." SET banner_showYN = 'N' WHERE idx = '".$duplicate_data['idx']."'";
				$update_result	= mysqli_query($my_db, $update_show_order_query);
			}
			
			$banner_query	= "INSERT INTO ".$_gl['banner_info_table']."(banner_name,device_type,banner_type,banner_showYN,banner_show_order,banner_img_link,banner_link_target,banner_regdate) values('".$banner_name."','".$device_type."','".$banner_type."','".$banner_showYN."','".$banner_show_order."','".$banner_value."','".$banner_link_target."','".date("Y-m-d H:i:s")."')";
			$banner_result	= mysqli_query($my_db, $banner_query);
			$id_num				= mysqli_insert_id($my_db);
			if($banner_result)
				$flag = $id_num;
			else
				$flag = "0";
			echo $flag;
		break;
			
		case "update_banner_info" :
			$idx					= $_REQUEST['idx'];
			$banner_name			= $_REQUEST['banner_name'];
			$device_type			= $_REQUEST['device_type'];
			$banner_type			= $_REQUEST['banner_type'];
			$banner_value			= $_REQUEST['banner_value'];
			$banner_showYN			= $_REQUEST['banner_showYN'];
			$banner_show_order		= $_REQUEST['banner_show_order'];
			$banner_link_target		= $_REQUEST['banner_link_target'];

			$order_duplicate_query	= "SELECT * FROM ".$_gl['banner_info_table']." WHERE 1 AND banner_type = '".$banner_type."' AND device_type = '".$device_type."' AND banner_show_order = '".$banner_show_order."' AND banner_showYN = 'Y'";
			$duplicate_result = mysqli_query($my_db, $order_duplicate_query);
			if($duplicate_result){
				$duplicate_data = mysqli_fetch_array($duplicate_result);
				$update_show_order_query = "UPDATE ".$_gl['banner_info_table']." SET banner_showYN = 'N' WHERE idx = '".$duplicate_data['idx']."'";
				$update_result	= mysqli_query($my_db, $update_show_order_query);
			}
			
			$banner_query = "UPDATE ".$_gl['banner_info_table']." SET banner_name='".$banner_name."', device_type='".$device_type."', banner_type='".$banner_type."', banner_showYN='".$banner_showYN."', banner_show_order='".$banner_show_order."', banner_img_link='".$banner_value."', banner_link_target='".$banner_link_target."', banner_regdate='".date("Y-m-d H:i:s")."' WHERE idx='".$idx."'";

			$banner_result	= mysqli_query($my_db, $banner_query);

			if($banner_result)
				$flag = $idx;
			else
				$flag = "0";
			echo $flag;
		break;


		case "update_option_info" :
			$best_goods_flag			= $_REQUEST['best_goods_flag'];
			$new_goods_flag				= $_REQUEST['new_goods_flag'];
			$plan_goods_flag			= $_REQUEST['plan_goods_flag'];
			$cate_goods_flag			= $_REQUEST['cate_goods_flag'];
			$best_goods_flagYN			= $_REQUEST['best_goods_flagYN'];
			$new_goods_flagYN			= $_REQUEST['new_goods_flagYN'];
			$plan_goods_flagYN			= $_REQUEST['plan_goods_flagYN'];
			$cate_goods_flagYN			= $_REQUEST['cate_goods_flagYN'];
			$default_saved_priceYN		= $_REQUEST['default_saved_priceYN'];
			$default_saved_price		= $_REQUEST['default_saved_price'];
			$default_delivery_price 	= $_REQUEST['default_delivery_price'];
			$default_delivery_priceYN 	= $_REQUEST['default_delivery_priceYN'];

			$option1_query		= "UPDATE ".$_gl['site_option_table']." SET option_value='".$best_goods_flag."', option_load='".$best_goods_flagYN."' WHERE option_name='best_goods_flag'"; 
			$option1_result		= mysqli_query($my_db, $option1_query);

			$option2_query		= "UPDATE ".$_gl['site_option_table']." SET option_value='".$new_goods_flag."', option_load='".$new_goods_flagYN."' WHERE option_name='new_goods_flag'"; 
			$option2_result		= mysqli_query($my_db, $option2_query);

			$option3_query		= "UPDATE ".$_gl['site_option_table']." SET option_value='".$plan_goods_flag."', option_load='".$plan_goods_flagYN."' WHERE option_name='plan_goods_flag'"; 
			$option3_result		= mysqli_query($my_db, $option3_query);

			$option4_query		= "UPDATE ".$_gl['site_option_table']." SET option_value='".$cate_goods_flag."', option_load='".$cate_goods_flagYN."' WHERE option_name='cate_goods_flag'"; 
			$option4_result		= mysqli_query($my_db, $option4_query);

			$option5_query		= "UPDATE ".$_gl['site_option_table']." SET option_value='".$default_saved_price."', option_load='".$default_saved_priceYN."' WHERE option_name='default_saved_price'"; 
			$option5_result		= mysqli_query($my_db, $option5_query);

			$option6_query		= "UPDATE ".$_gl['site_option_table']." SET option_value='".$default_delivery_price."', option_load='".$default_delivery_priceYN."' WHERE option_name='default_delivery_price'"; 
			$option6_result		= mysqli_query($my_db, $option6_query);

			if ($option6_result)
				$flag	= "Y";
			else
				$flag	= "N";

			echo $flag;
		break;

		case "show_banner_list" :
			$target	= $_REQUEST['target'];
			$list_query		= "SELECT * FROM ".$_gl['banner_info_table']." WHERE 1 AND admin_showYN = 'Y' ORDER BY idx DESC";
			$list_result		= mysqli_query($my_db, $list_query);
			$innerHTML	= "<thead>";
			$innerHTML	.= "<tr>";
			$innerHTML	.= "<th>배너 이름</th>";
			$innerHTML	.= "<th>디바이스 타입</th>";
			$innerHTML	.= "<th>배너 타입</th>";
			$innerHTML	.= "<th>배너 노출 여부</th>";
			$innerHTML	.= "<th>배너 표시 순서</th>";
			$innerHTML	.= "<th>배너 이미지</th>";
			$innerHTML	.= "<th>배너 링크</th>";
			$innerHTML	.= "<th>배너 타겟</th>";
			$innerHTML	.= "<th>배너 등록일</th>";
			$innerHTML	.= "<th></th>";
			$innerHTML	.= "</tr>";
			$innerHTML	.= "</thead>";
			$innerHTML	.= "<tbody>";
			//$i	= 1;
			while ($list_data = mysqli_fetch_array($list_result))
			{
				$innerHTML	.= "<tr>";
				$innerHTML	.= "<td>".$list_data['banner_name']."</td>";
				$innerHTML	.= "<td>".$list_data['device_type']."</td>";
				$innerHTML	.= "<td>".$list_data['banner_type']."</td>";
				$innerHTML	.= "<td class='showYN'>".$list_data['banner_showYN']."</td>";
				$innerHTML	.= "<td>".$list_data['banner_show_order']."</td>";
				$innerHTML	.= "<td>".$list_data['banner_img_url']."</td>";
				$innerHTML	.= "<td>".$list_data['banner_img_link']."</td>";
				$innerHTML	.= "<td>".$list_data['banner_link_target']."</td>";
				$innerHTML	.= "<td>".$list_data['banner_regdate']."</td>";
				$innerHTML	.= "<td><a href='./banner_detail.php?idx=".$list_data['idx']."'><button type='button' class='btn btn-primary'>수정</button></a> <a href='javascript:void(0)' class='del_banner' data-idx='".$list_data['idx']."' onclick='delete_row(".$list_data['idx'].");return false;'><button type='button' class='btn btn-danger'>삭제</button></a></td>";
				$innerHTML	.= "</tr>";
				//$i++;
			}
			$innerHTML	.= "</tbody>";
			echo $innerHTML;
		break;

		case "show_review_list":

			$target	= $_REQUEST['target'];
			$list_query		= "SELECT * FROM ".$_gl['board_review_table']." WHERE 1 ORDER BY thread DESC";
			$list_result	= mysqli_query($my_db, $list_query);
			$innerHTML	= "<thead>";
			$innerHTML	.= "<tr>";
			$innerHTML	.= "<th><input type='checkbox' name='all_check' id='all_check'></th>";
			$innerHTML	.= "<th>순번</th>";
			$innerHTML	.= "<th>상품코드</th>";
			$innerHTML	.= "<th>제목</th>";
			$innerHTML	.= "<th>작성자</th>";
			$innerHTML	.= "<th>작성일시</th>";
			$innerHTML	.= "<th>조회수</th>";
			$innerHTML	.= "<th>답변</th>";
			$innerHTML	.= "</tr>";
			$innerHTML	.= "</thead>";
			$innerHTML	.= "<tbody>";
			//$i	= 1;
			while ($list_data = mysqli_fetch_array($list_result))
			{
				$innerHTML	.= "<tr>";
				$innerHTML	.= "<td><input type='checkbox' name='one_check' id='one_check'></td>";
				$innerHTML	.= "<td></td>";
				$innerHTML	.= "<td><a href='".$_mnv_PC_goods_url."goods_detail.php?goods_code=".$list_data['goods_code']."' target='_blank'>".$list_data['goods_code']."</a></td>";
				$innerHTML	.= "<td>";
				if($list_data['depth']>0)
				{
					$depth = $list_data['depth']*7;
					$innerHTML	.= "<img height='1' width=$depth>";
				}
				$innerHTML	.= "<a href='./read_review.php?idx=".$list_data['idx']."'>
										".$list_data['subject']."
										</td>";
				$innerHTML	.= "<td>".$list_data['user_id']."</td>";
				$innerHTML	.= "<td>".$list_data['date']."</td>";
				$innerHTML	.= "<td>".$list_data['hit']."</td>";
				$innerHTML	.= "<td>
										<a href='./reply_review.php?idx=".$list_data['idx']."'>
										<input type='button' value='답변'></a>
										<a href='./delete_review.php?idx=".$list_data['idx']."'>
										<input type='button' value='삭제'></a>
									</td>";
				$innerHTML	.= "</tr>";
				//$i++;
			}
			$innerHTML	.= "</tbody>";
			echo $innerHTML;

		break;
			
		case "show_qna_list":

			$target	= $_REQUEST['target'];
			$list_query		= "SELECT * FROM ".$_gl['board_qna_table']." WHERE 1 ORDER BY thread DESC";
			$list_result	= mysqli_query($my_db, $list_query);
			$innerHTML	= "<thead>";
			$innerHTML	.= "<tr>";
			$innerHTML	.= "<th><input type='checkbox' name='all_check' id='all_check'></th>";
			$innerHTML	.= "<th>순번</th>";
			$innerHTML	.= "<th>상품코드</th>";
			$innerHTML	.= "<th>제목</th>";
			$innerHTML	.= "<th>작성자</th>";
			$innerHTML	.= "<th>작성일시</th>";
			$innerHTML	.= "<th>조회수</th>";
			$innerHTML	.= "<th>답변</th>";
			$innerHTML	.= "</tr>";
			$innerHTML	.= "</thead>";
			$innerHTML	.= "<tbody>";
			//$i	= 1;
			while ($list_data = mysqli_fetch_array($list_result))
			{
				$innerHTML	.= "<tr>";
				$innerHTML	.= "<td><input type='checkbox' name='one_check' id='one_check'></td>";
				$innerHTML	.= "<td></td>";
				$innerHTML	.= "<td><a href='".$_mnv_PC_goods_url."goods_detail.php?goods_code=".$list_data['goods_code']."' target='_blank'>".$list_data['goods_code']."</a></td>";
				$innerHTML	.= "<td>";
				if($list_data['depth']>0)
				{
					$depth = $list_data['depth']*7;
					$innerHTML	.= "<img height='1' width=$depth>";
				}
				$innerHTML	.= "<a href='./read_qna.php?idx=".$list_data['idx']."'>
										".$list_data['subject']."
										</td>";
				$innerHTML	.= "<td>".$list_data['user_id']."</td>";
				$innerHTML	.= "<td>".$list_data['date']."</td>";
				$innerHTML	.= "<td>".$list_data['hit']."</td>";
				$innerHTML	.= "<td>
										<a href='./reply_qna.php?idx=".$list_data['idx']."&pg=".$pg."'>
										<input type='button' value='답변'></a>
										<a href='./delete_qna.php?idx=".$list_data['idx']."'>
										<input type='button' value='삭제'></a>
									</td>";
				$innerHTML	.= "</tr>";
				//$i++;
			}
			$innerHTML	.= "</tbody>";
			echo $innerHTML;

		break;
			
		case "show_mtm_list":

			$target	= $_REQUEST['target'];
			$list_query		= "SELECT * FROM ".$_gl['board_mtm_table']." WHERE 1 ORDER BY thread DESC";
			$list_result	= mysqli_query($my_db, $list_query);
			$innerHTML	= "<thead>";
			$innerHTML	.= "<tr>";
			$innerHTML	.= "<th><input type='checkbox' name='all_check' id='all_check'></th>";
			$innerHTML	.= "<th>순번</th>";
			$innerHTML	.= "<th>질문유형</th>";
			$innerHTML	.= "<th>제목</th>";
			$innerHTML	.= "<th>작성자</th>";
			$innerHTML	.= "<th>답변여부</th>";
			$innerHTML	.= "<th>이메일 답변 발송여부</th>";
			$innerHTML	.= "<th>작성일시</th>";
			$innerHTML	.= "<th>답변</th>";
			$innerHTML	.= "</tr>";
			$innerHTML	.= "</thead>";
			$innerHTML	.= "<tbody>";
			//$i	= 1;
			while ($list_data = mysqli_fetch_array($list_result))
			{
				$list_data['user_email'] = ($list_data['user_email'] != '')?"Y":"N";
				$innerHTML	.= "<tr>";
				$innerHTML	.= "<td><input type='checkbox' name='one_check' id='one_check'></td>";
				$innerHTML	.= "<td></td>";
				$innerHTML	.= "<td>".$list_data['question_type']."</td>";
				$innerHTML	.= "<td>";
				if($list_data['depth']>0)
				{
					$depth = $list_data['depth']*7;
					$innerHTML	.= "<img height='1' width=$depth>";
				}
				$innerHTML	.= "<a href='./read_mtm.php?idx=".$list_data['idx']."'>
										".$list_data['subject']."
										</td>";
				$innerHTML	.= "<td>".$list_data['user_id']."</td>";
				$innerHTML	.= "<td>".$list_data['answerYN']."</td>";
				$innerHTML	.= "<td>".$list_data['user_email']."</td>";
				$innerHTML	.= "<td>".$list_data['date']."</td>";
				$innerHTML	.= "<td>
									<a href='./reply_mtm.php?idx=".$list_data['idx']."&pg=".$pg."'>
									<input type='button' value='답변'></a>
									<a href='./delete_mtm.php?idx=".$list_data['idx']."'>
									<input type='button' value='삭제'></a>
								</td>";
				$innerHTML	.= "</tr>";
				//$i++;
			}
			$innerHTML	.= "</tbody>";
			echo $innerHTML;

		break;
			
		case "show_notice_list":

			$target	= $_REQUEST['target'];
			$list_query		= "SELECT * FROM ".$_gl['board_notice_table']." WHERE 1 ORDER BY thread DESC";
			$list_result	= mysqli_query($my_db, $list_query);
			$innerHTML	= "<thead>";
			$innerHTML	.= "<tr>";
			$innerHTML	.= "<th><input type='checkbox' name='all_check' id='all_check'></th>";
			$innerHTML	.= "<th>순번</th>";
			$innerHTML	.= "<th>제목</th>";
			$innerHTML	.= "<th>작성자</th>";
			$innerHTML	.= "<th>작성일시</th>";
			$innerHTML	.= "<th>조회수</th>";
			$innerHTML	.= "<th>노출여부</th>";
			$innerHTML	.= "<th>수정/삭제</th>";
			$innerHTML	.= "</tr>";
			$innerHTML	.= "</thead>";
			$innerHTML	.= "<tbody>";
			//$i	= 1;
			while ($list_data = mysqli_fetch_array($list_result))
			{
				$innerHTML	.= "<tr>";
				$innerHTML	.= "<td><input type='checkbox' name='one_check' id='one_check'></td>";
				$innerHTML	.= "<td></td>";
				$innerHTML	.= "<td>";
				if($list_data['depth']>0)
				{
					$depth = $list_data['depth']*7;
					$innerHTML	.= "<img height='1' width=$depth>";
				}
				$innerHTML	.= "<a href='./read_notice.php?idx=".$list_data['idx']."'>
										".$list_data['subject']."
										</td>";
				$innerHTML	.= "<td>".$list_data['user_id']."</td>";
				$innerHTML	.= "<td>".$list_data['date']."</td>";
				$innerHTML	.= "<td>".$list_data['hit']."</td>";
				$innerHTML	.= "<td>".$list_data['showYN']."</td>";
				$innerHTML	.= "<td>
									<a href='./edit_notice.php?idx=".$list_data['idx']."&pg=".$pg."'>
									<input type='button' value='수정'></a>
									<a href='./delete_notice.php?idx=".$list_data['idx']."'>
									<input type='button' value='삭제'></a>
								</td>";
				$innerHTML	.= "</tr>";
				//$i++;
			}
			$innerHTML	.= "</tbody>";
			echo $innerHTML;

		break;
			
		case "write_notice":
			
			$user_id = $_REQUEST['user_id'];
			$subject = $_REQUEST['subject'];
			$content = $_REQUEST['content'];
			$showYN  = $_REQUEST['showYN'];

			$s_query = "SELECT max(thread) AS thread, max(idx) FROM ".$_gl['board_notice_table']."";
			$max_thread_result = mysqli_query($my_db, $s_query);
			$max_thread_fetch = mysqli_fetch_row($max_thread_result);

			$max_thread = ceil($max_thread_fetch[0]/1000)*1000+1000;
			$max_idx = $max_thread_fetch[1]+1;

			$i_query = "INSERT INTO ".$_gl['board_notice_table']."(group_id, thread, depth, user_id, subject, content, showYN, date, ipaddr) 
			VALUES('".$max_idx."','".$max_thread."',0,'".$user_id."','".$subject."','".$content."','".$showYN."','".date('Y-m-d H:i:s')."','".$_SERVER['REMOTE_ADDR']."')";

			$i_result = mysqli_query($my_db, $i_query); // 글 저장

			if($i_result){
				$flag = "Y";
			}else{
				$flag = "N";
			}

			echo $flag;
			
		break;

		case "reply_review":

			$user_id = $_REQUEST['user_id'];
			$idx	 = $_REQUEST['idx'];
			$goods_code = $_REQUEST['goods_code'];
			$subject = $_REQUEST['subject'];
			$content = $_REQUEST['content'];
			$p_thread = $_REQUEST['p_thread'];
			$p_depth = $_REQUEST['p_depth'];
			$parent_gID = $_REQUEST['parent_gID'];

			$prev_parent_thread = ceil($p_thread/1000)*1000 - 1000; // 올림

			//원본글보다는 작고 위값보다는 큰 글들의 thread 값을 모두 1씩 낮춘다.
			//만약 부모글이 2000이면 prev_parent_thread는 1000이므로 2000> x >1000 인 x 글들을 모두 -1 한다.

			$u_query = "UPDATE ".$_gl['board_review_table']." SET thread=thread-1 WHERE thread > '".$prev_parent_thread."' AND thread < '".$p_thread."'";
			$result = mysqli_query ($my_db, $u_query); 

			//원본글보다는 1 작은 값으로 답글을 등록한다.
			//원본글의 바로 밑에 등록되게 된다.
			//depth는 원본글의 depth + 1 이다. 원본글이 3(이글도 답글)이면 답글은 4가된다.
			$i_query = "INSERT INTO ".$_gl['board_review_table']."(group_id, thread, depth, user_id, goods_code, subject, content, date, ipaddr) 
							VALUES ('".$parent_gID."','".$p_thread."'-1,'".$p_depth."'+1,'".$user_id."','".$goods_code."','".$subject."','".$content."','".date('Y-m-d H:i:s')."','".$_SERVER['REMOTE_ADDR']."')";
			$result = mysqli_query($my_db, $i_query);

			if($result){
				$flag = "Y";
			}else{
				$flag = "N";
			}

			echo $flag;

		break;
			
		case "reply_qna":

			$user_id = $_REQUEST['user_id'];
			$idx	 = $_REQUEST['idx'];
			$goods_code = $_REQUEST['goods_code'];
			$subject = $_REQUEST['subject'];
			$content = $_REQUEST['content'];
			$p_thread = $_REQUEST['p_thread'];
			$p_depth = $_REQUEST['p_depth'];
			$parent_gID = $_REQUEST['parent_gID'];

			$prev_parent_thread = ceil($p_thread/1000)*1000 - 1000; // 올림

			//원본글보다는 작고 위값보다는 큰 글들의 thread 값을 모두 1씩 낮춘다.
			//만약 부모글이 2000이면 prev_parent_thread는 1000이므로 2000> x >1000 인 x 글들을 모두 -1 한다.

			$u_query = "UPDATE ".$_gl['board_qna_table']." SET thread=thread-1 WHERE thread > '".$prev_parent_thread."' AND thread < '".$p_thread."'";
			$result = mysqli_query ($my_db, $u_query); 

			//원본글보다는 1 작은 값으로 답글을 등록한다.
			//원본글의 바로 밑에 등록되게 된다.
			//depth는 원본글의 depth + 1 이다. 원본글이 3(이글도 답글)이면 답글은 4가된다.
			$i_query = "INSERT INTO ".$_gl['board_qna_table']."(group_id, thread, depth, user_id, goods_code, subject, content, date, ipaddr) 
							VALUES ('".$parent_gID."','".$p_thread."'-1,'".$p_depth."'+1,'".$user_id."','".$goods_code."','".$subject."','".$content."','".date('Y-m-d H:i:s')."','".$_SERVER['REMOTE_ADDR']."')";
			$result = mysqli_query($my_db, $i_query);

			if($result){
				$flag = "Y";
			}else{
				$flag = "N";
			}

			echo $flag;

		break;
			
		case "reply_mtm":

			$user_id = $_REQUEST['user_id'];
			$idx	 = $_REQUEST['idx'];
			$user_email = $_REQUEST['user_email'];
			$subject = $_REQUEST['subject'];
			$content = $_REQUEST['content'];
			$p_thread = $_REQUEST['p_thread'];
			$p_depth = $_REQUEST['p_depth'];
			$parent_gID = $_REQUEST['parent_gID'];
			$parent_content = $_REQUEST['parent_content'];
			$parent_date = $_REQUEST['parent_date'];

			$prev_parent_thread = ceil($p_thread/1000)*1000 - 1000; // 올림

			//원본글보다는 작고 위값보다는 큰 글들의 thread 값을 모두 1씩 낮춘다.
			//만약 부모글이 2000이면 prev_parent_thread는 1000이므로 2000> x >1000 인 x 글들을 모두 -1 한다.

			$u_query = "UPDATE ".$_gl['board_mtm_table']." SET thread=thread-1 WHERE thread > '".$prev_parent_thread."' AND thread < '".$p_thread."'";
			$result = mysqli_query($my_db, $u_query); 

			$answerYN = "Y";
			
			//원본글보다는 1 작은 값으로 답글을 등록한다.
			//원본글의 바로 밑에 등록되게 된다.
			//depth는 원본글의 depth + 1 이다. 원본글이 3(이글도 답글)이면 답글은 4가된다.
			$i_query = "INSERT INTO ".$_gl['board_mtm_table']."(group_id, thread, depth, user_id, user_email, subject, content, date, ipaddr) 
							VALUES ('".$parent_gID."','".$p_thread."'-1,'".$p_depth."'+1,'".$user_id."','".$user_email."','".$subject."','".$content."','".date('Y-m-d H:i:s')."','".$_SERVER['REMOTE_ADDR']."')";
			$result = mysqli_query($my_db, $i_query);

			if($result){
				$update_query = "UPDATE ".$_gl['board_mtm_table']." SET answerYN='".$answerYN."' WHERE group_id='".$parent_gID."'";
				$update_result = mysqli_query($my_db, $update_query);
				if($update_result && $user_email != ''){
					$mail_result = sendMail(
						"yh.kim@minivertising.kr",
						"촌의감각",
						"문의하신 내용의 답변드립니다.",
						"<div style='width: 600px;margin: 0 auto;margin-bottom: 35px;margin-top: 60px;font-family: &quot;맑은 고딕&quot;, &quot;Malgun Gothic&quot;;text-align: center'>
						<h2>
							<img src='http://www.store-chon.com/PC/images/mail_title_logo.png' alt='촌의감각' style='width: 116px;height: 92px'/>
						</h2>
						<span style='display: inline-block;width: 18px;height: 1px;background-color: #b88b5b;margin: 15px 0'></span>
						<p style='line-height: 18px;margin-bottom: 18px;font-size: 14px'>
						문의하신 내용의 답변드립니다.
						</p>
						</div>
						<div style='margin:0 auto;width:570px;border-top:1px solid #b88b5b;border-bottom:1px solid #b88b5b;font-size:13px;margin-bottom:35px;'>
						<div style='border-bottom:1px solid #cccacb;'>
						<div style='padding: 14px 16px;'>
						<span style='display:inline-block;color:#b88b5b;vertical-align:top;padding-right:12px;'>문의날짜</span>
						<span style='display:inline-block;width:400px;line-height:19px;'>$parent_date.09.20</span>
						</div>
						</div>
						<div style='border-bottom:1px solid #cccacb;'>
						<div style='padding: 14px 16px;'>
						<span style='display:inline-block;color:#b88b5b;vertical-align:top;padding-right:12px;'>문의내용</span>
						<span style='display:inline-block;width:400px;line-height:19px;'>$parent_content</span>
						</div>
						</div>
						<div>
						<div style='padding: 14px 16px;'>
						<span style='display:inline-block;color:#b88b5b;vertical-align:top;padding-right:12px;'>답변내용</span>
						<span style='display:inline-block;text-align:left;width:430px;line-height:19px;'>$content</span>
						</div>
						</div>
						</div>
						<div style='margin:0 auto;text-align:center;margin-bottom:60px;'>
						<a href='http://store-chon.com/PC/member/member_login.php' style='text-decoration: none;color: #000'><p style='background-color: #b88b5b;margin: 0 auto;width: 186px;padding: 14px 0'><span style='display: block;color: #fff;vertical-align: middle;font-size: 15px;letter-spacing: -1px'>촌의 감각 로그인</span></p></a>
						</div>
						<div style='background-color: #f9f3ec;width: 600px;height: 154px;margin: 0 auto;font-family: &quot;맑은 고딕&quot;, &quot;Malgun Gothic&quot;'>
						<div style='padding: 20px 38px;text-align: left;font-size: 12px'>
						<p style='margin: 0;padding-bottom: 4px'>본 메일은 발신전용입니다.</p>
						<p style='margin: 0;padding-bottom: 4px'>기타 관련 사항은 고객센터(070-4888-3580) 또는 촌의 감각 쇼핑몰에서 문의 바랍니다.</p>
						<p style='margin: 0;padding-bottom: 4px;padding-top: 10px'>Copyright@CHON. ALL RIGHTS RESERVED.</p>
						</div>
						</div>",
						"$user_email", "$username");
				$flag = "Y";
				}
			}else{
				$flag = "N";
			}

			echo $flag;

		break;

		case "edit_review":

			$user_id = $_REQUEST['user_id'];
			$idx	 = $_REQUEST['idx'];
			$goods_code = $_REQUEST['goods_code'];
			$subject = $_REQUEST['subject'];
			$content = $_REQUEST['content'];

			// $s_query = "SELECT max(thread) AS thread FROM ".$_gl['board_review_table']."";
			// $max_thread_result = mysqli_query($my_db, $s_query);
			// $max_thread_fetch = mysqli_fetch_row($max_thread_result);

			// $max_thread = ceil($max_thread_fetch[0]/1000)*1000+1000;

			$u_query = "UPDATE ".$_gl['board_review_table']." SET subject='".$subject."', content='".$content."', date='".date('Y-m-d H:i:s')."', ipaddr='".$_SERVER['REMOTE_ADDR']."' WHERE idx='".$idx."'";
			$u_result = mysqli_query ($my_db, $u_query); // 글 수정
			if($u_result){
				$flag = "Y";
			}else{
				$flag = "N";
			}

			echo $flag;

		break;
			
		case "edit_qna":

			$user_id = $_REQUEST['user_id'];
			$idx	 = $_REQUEST['idx'];
			$goods_code = $_REQUEST['goods_code'];
			$subject = $_REQUEST['subject'];
			$content = $_REQUEST['content'];

			// $s_query = "SELECT max(thread) AS thread FROM ".$_gl['board_review_table']."";
			// $max_thread_result = mysqli_query($my_db, $s_query);
			// $max_thread_fetch = mysqli_fetch_row($max_thread_result);

			// $max_thread = ceil($max_thread_fetch[0]/1000)*1000+1000;

			$u_query = "UPDATE ".$_gl['board_qna_table']." SET subject='".$subject."', content='".$content."', date='".date('Y-m-d H:i:s')."', ipaddr='".$_SERVER['REMOTE_ADDR']."' WHERE idx='".$idx."'";
			$u_result = mysqli_query ($my_db, $u_query); // 글 수정
			if($u_result){
				$flag = "Y";
			}else{
				$flag = "N";
			}

			echo $flag;

		break;
			
		case "edit_notice":

			$user_id = $_REQUEST['user_id'];
			$idx	 = $_REQUEST['idx'];
			$subject = $_REQUEST['subject'];
			$content = $_REQUEST['content'];
			$showYN  = $_REQUEST['showYN'];

			// $s_query = "SELECT max(thread) AS thread FROM ".$_gl['board_review_table']."";
			// $max_thread_result = mysqli_query($my_db, $s_query);
			// $max_thread_fetch = mysqli_fetch_row($max_thread_result);

			// $max_thread = ceil($max_thread_fetch[0]/1000)*1000+1000;

			$u_query = "UPDATE ".$_gl['board_notice_table']." SET user_id='".$user_id."', subject='".$subject."', content='".$content."',showYN='".$showYN."', date='".date('Y-m-d H:i:s')."', ipaddr='".$_SERVER['REMOTE_ADDR']."' WHERE idx='".$idx."'";
			$u_result = mysqli_query ($my_db, $u_query); // 글 수정
			if($u_result){
				$flag = "Y";
			}else{
				$flag = "N";
			}

			echo $flag;

		break;

		case "delete_review":

			$user_id = $_REQUEST['user_id'];
			$idx	 = $_REQUEST['idx'];
			$group_id	 = $_REQUEST['group_id'];
			$goods_code = $_REQUEST['goods_code'];

			$del_subject = "삭제된 글입니다.";
			$del_content = "삭제된 글입니다.";

			// 모든 글에서의 내용 뽑아내서 치환할경우
			// $query = "SELECT * FROM ".$_gl['board_review_table']." WHERE idx = '".$idx."'";
			// $result = mysqli_query($my_db, $query);
			// $target = mysqli_fetch_array($result); // 지울 제목, 내용

			// $query = "SELECT * FROM ".$_gl['board_review_table']." WHERE group_id = '".$group_id."'";
			// $result = mysqli_query($my_db, $query);
			// while ($array = mysqli_fetch_array($result)) {
			// 	$contentArr[][] = str_replace($target['content'], $del_content, $array['content']);
			// }
			// print_r($contentArr);

			$query = "SELECT * FROM ".$_gl['board_review_table']." WHERE group_id = '".$group_id."'";
			$result = mysqli_query($my_db, $query);
			$rows = mysqli_num_rows($result);

			if($rows>1)
			{
				$query = "UPDATE ".$_gl['board_review_table']." SET subject='".$del_subject."', content='".$del_content."', date='".date('Y-m-d H:i:s')."', ipaddr='".$_SERVER['REMOTE_ADDR']."' WHERE idx='".$idx."'";
				$result = mysqli_query($my_db, $query); // 글 수정 (답변글 존재)
			}else{
				$query = "DELETE FROM ".$_gl['board_review_table']." WHERE idx='".$idx."'";
				$result = mysqli_query($my_db, $query); // 글 삭제 (답변글 X)
			}

			if($result){
				$flag = "Y";
			}else{
				$flag = "N";
			}

			echo $flag;
		break;
			
		case "delete_qna":

			$user_id = $_REQUEST['user_id'];
			$idx	 = $_REQUEST['idx'];
			$group_id	 = $_REQUEST['group_id'];
			$goods_code = $_REQUEST['goods_code'];

			$del_subject = "삭제된 글입니다.";
			$del_content = "삭제된 글입니다.";

			// 모든 글에서의 내용 뽑아내서 치환할경우
			// $query = "SELECT * FROM ".$_gl['board_review_table']." WHERE idx = '".$idx."'";
			// $result = mysqli_query($my_db, $query);
			// $target = mysqli_fetch_array($result); // 지울 제목, 내용

			// $query = "SELECT * FROM ".$_gl['board_review_table']." WHERE group_id = '".$group_id."'";
			// $result = mysqli_query($my_db, $query);
			// while ($array = mysqli_fetch_array($result)) {
			// 	$contentArr[][] = str_replace($target['content'], $del_content, $array['content']);
			// }
			// print_r($contentArr);

			$query = "SELECT * FROM ".$_gl['board_qna_table']." WHERE group_id = '".$group_id."'";
			$result = mysqli_query($my_db, $query);
			$rows = mysqli_num_rows($result);

			if($rows>1)
			{
				$query = "UPDATE ".$_gl['board_qna_table']." SET subject='".$del_subject."', content='".$del_content."', date='".date('Y-m-d H:i:s')."', ipaddr='".$_SERVER['REMOTE_ADDR']."' WHERE idx='".$idx."'";
				$result = mysqli_query($my_db, $query); // 글 수정 (답변글 존재)
			}else{
				$query = "DELETE FROM ".$_gl['board_qna_table']." WHERE idx='".$idx."'";
				$result = mysqli_query($my_db, $query); // 글 삭제 (답변글 X)
			}

			if($result){
				$flag = "Y";
			}else{
				$flag = "N";
			}

			echo $flag;
		break;
			
		case "delete_notice":

			$user_id = $_REQUEST['user_id'];
			$idx	 = $_REQUEST['idx'];
			$group_id	 = $_REQUEST['group_id'];

			$query = "UPDATE ".$_gl['board_notice_table']." SET showYN='N' WHERE idx='".$idx."'";
			$result = mysqli_query($my_db, $query); // 공지사항 비노출로 변경

			if($result){
				$flag = "Y";
			}else{
				$flag = "N";
			}

			echo $flag;
		break;

		case "insert_best_goods_info":
			$goods_code			= $_REQUEST['goods_code'];
			$goods_sequence		= $_REQUEST['goods_sequence'];

			$query = "UPDATE ".$_gl['goods_info_table']." SET goods_best_flag='Y', goods_sequence='".$goods_sequence."' WHERE goods_code='".$goods_code."'";
			$result = mysqli_query($my_db, $query); // 공지사항 비노출로 변경

			if($result){
				$flag = "Y";
			}else{
				$flag = "N";
			}

			echo $flag;
		break;

		case "insert_new_goods_info":
			$goods_code			= $_REQUEST['goods_code'];
			$goods_sequence		= $_REQUEST['goods_sequence'];

			$query = "UPDATE ".$_gl['goods_info_table']." SET goods_new_flag='Y', goods_sequence='".$goods_sequence."' WHERE goods_code='".$goods_code."'";
			$result = mysqli_query($my_db, $query); // 공지사항 비노출로 변경

			if($result){
				$flag = "Y";
			}else{
				$flag = "N";
			}

			echo $flag;
		break;

		case "insert_plan_goods_info":
			$goods_code			= $_REQUEST['goods_code'];
			$goods_sequence		= $_REQUEST['goods_sequence'];

			$query = "UPDATE ".$_gl['goods_info_table']." SET goods_plan_flag='Y', goods_sequence='".$goods_sequence."' WHERE goods_code='".$goods_code."'";
			$result = mysqli_query($my_db, $query); // 공지사항 비노출로 변경

			if($result){
				$flag = "Y";
			}else{
				$flag = "N";
			}

			echo $flag;
		break;
			
		case "delete_row":
			$idx = $_REQUEST['idx'];

			$query = "UPDATE ".$_gl['banner_info_table']." SET admin_showYN='N', banner_showYN='N' WHERE idx='".$idx."'";
			$result = mysqli_query($my_db, $query); // 배너 비노출로 변경

			if($result){
				$flag = "Y";
			}else{
				$flag = "N";
			}

			echo $flag;
		break;
	}

?>