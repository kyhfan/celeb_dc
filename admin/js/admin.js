/*
*
*	관리자 JS 파일
*
*/

// *********************** 베스트 상품 관리 *********************** //

// 베스트 상품 관리 > 베스트 상품 추가 버튼 클릭
$(document).on("click", "#add_best_goods_btn", function(){
	$("#list_best_goods").hide();
	$("#add_best_goods").show();
});

// 베스트 상품 관리 > 베스트 상품 목록 버튼 클릭
$(document).on("click", "#list_best_goods_btn", function(){
	$("#add_best_goods").hide();
	$("#list_best_goods").show();
});

// 베스트 상품 정보 insert
$(document).on("click", "#submit_btn16", function(){
	var goods_code			= $("#goods_code").val();
	var goods_sequence	= $("#goods_sequence").val();

	if (goods_code == "")
	{
		alert("상품코드를 입력해주세요.");
		$("#goods_code").focus();
		return false;
	}

	if (goods_sequence == "")
	{
		alert("노출순서를 입력해주세요.");
		$("#goods_sequence").focus();
		return false;
	}

	$.ajax({
		type   : "POST",
		async  : false,
		url    : "admin_exec.php",
		data:{
			"exec"					: "insert_best_goods_info",
			"goods_code"		: goods_code,
			"goods_sequence"	: goods_sequence
		},
		success: function(response){
			alert(response);
			if (response == "N")
			{
				alert("다시 시도해 주세요.");
				location.reload();
			}else{
				alert("베스트 상품이 선택 되었습니다.");
				location.reload();
			}
		}
	});
});

// 전체 베스트 상품 리스트 생성
function show_best_goods_list(id)
{
	$.ajax({
		type   : "POST",
		async  : false,
		url    : "admin_exec.php",
		data:{
			"exec"		: "show_best_goods_list",
			"target"	: id
		},
		success: function(response){
			$("#"+id).html(response);
		}
	});
}

// 베스트 상품 관리 > 베스타 상품 목록 > 순서 blur
$(document).on("blur", ".edit_best_goods", function(){
	var goods_code			= $(this).attr('edit_code');
	var goods_sequence	= $(this).val();

	$.ajax({
		type   : "POST",
		async  : false,
		url    : "admin_exec.php",
		data:{
			"exec"					: "edit_best_goods",
			"goods_code"		: goods_code,
			"goods_sequence"	: goods_sequence
		}
	});
});

// 베스트 상품 관리 > 베스타 상품 목록 > 삭제 버튼 클릭
$(document).on("blur", ".del_best_goods", function(){
	var goods_code			= $(this).attr('del_code');

	if (confirm("베스트 상품에서 제외할까요?"))
	{
		$.ajax({
			type   : "POST",
			async  : false,
			url    : "admin_exec.php",
			data:{
				"exec"					: "delete_best_goods",
				"goods_code"		: goods_code
			},
			success: function(response){
				alert("베스트상품에서 제외되었습니다.");
				location.reload();
			}
		});
	}
});

// *********************** 신 상품 관리 *********************** //

// 신 상품 관리 > 신 상품 추가 버튼 클릭
$(document).on("click", "#add_new_goods_btn", function(){
	$("#list_new_goods").hide();
	$("#add_new_goods").show();
});

// 신 상품 관리 > 신 상품 목록 버튼 클릭
$(document).on("click", "#list_new_goods_btn", function(){
	$("#add_new_goods").hide();
	$("#list_new_goods").show();
});

// 신 상품 정보 insert
$(document).on("click", "#submit_btn17", function(){
	var goods_code			= $("#goods_code").val();
	var goods_sequence	= $("#goods_sequence").val();

	if (goods_code == "")
	{
		alert("상품코드를 입력해주세요.");
		$("#goods_code").focus();
		return false;
	}

	if (goods_sequence == "")
	{
		alert("노출순서를 입력해주세요.");
		$("#goods_sequence").focus();
		return false;
	}

	$.ajax({
		type   : "POST",
		async  : false,
		url    : "admin_exec.php",
		data:{
			"exec"					: "insert_new_goods_info",
			"goods_code"		: goods_code,
			"goods_sequence"	: goods_sequence
		},
		success: function(response){
			if (response == "N")
			{
				alert("다시 시도해 주세요.");
				location.reload();
			}else{
				alert("신 상품이 선택 되었습니다.");
				location.reload();
			}
		}
	});
});

// 전체 신 상품 리스트 생성
function show_new_goods_list(id)
{
	$.ajax({
		type   : "POST",
		async  : false,
		url    : "admin_exec.php",
		data:{
			"exec"		: "show_new_goods_list",
			"target"	: id
		},
		success: function(response){
			$("#"+id).html(response);
		}
	});
}

// 신 상품 관리 > 신 상품 목록 > 수정 버튼 클릭
$(document).on("blur", ".edit_new_goods", function(){
	var goods_code			= $(this).attr('edit_code');
	var goods_sequence	= $(this).val();

	$.ajax({
		type   : "POST",
		async  : false,
		url    : "admin_exec.php",
		data:{
			"exec"					: "edit_new_goods",
			"goods_code"		: goods_code,
			"goods_sequence"	: goods_sequence
		}
	});

});

// 신 상품 관리 > 신 상품 목록 > 삭제 버튼 클릭
$(document).on("blur", ".del_new_goods", function(){
	var goods_code			= $(this).attr('del_code');

	if (confirm("신 상품에서 제외할까요?"))
	{
		$.ajax({
			type   : "POST",
			async  : false,
			url    : "admin_exec.php",
			data:{
				"exec"					: "delete_new_goods",
				"goods_code"		: goods_code
			},
			success: function(response){
				alert("신상품에서 제외되었습니다.");
				location.reload();
			}
		});
	}
});

// *********************** 스페셜 상품 관리 *********************** //

// 스페셜 상품 관리 > 스페셜 상품 추가 버튼 클릭
$(document).on("click", "#add_plan_goods_btn", function(){
	$("#list_plan_goods").hide();
	$("#add_plan_goods").show();
});

// 스페셜 상품 관리 > 스페셜 상품 목록 버튼 클릭
$(document).on("click", "#list_plan_goods_btn", function(){
	$("#add_plan_goods").hide();
	$("#list_plan_goods").show();
});

// 스페셜 상품 정보 insert
$(document).on("click", "#submit_btn18", function(){
	var goods_code			= $("#goods_code").val();
	var goods_sequence	= $("#goods_sequence").val();

	if (goods_code == "")
	{
		alert("상품코드를 입력해주세요.");
		$("#goods_code").focus();
		return false;
	}

	if (goods_sequence == "")
	{
		alert("노출순서를 입력해주세요.");
		$("#goods_sequence").focus();
		return false;
	}

	$.ajax({
		type   : "POST",
		async  : false,
		url    : "admin_exec.php",
		data:{
			"exec"					: "insert_plan_goods_info",
			"goods_code"		: goods_code,
			"goods_sequence"	: goods_sequence
		},
		success: function(response){
			if (response == "N")
			{
				alert("다시 시도해 주세요.");
				location.reload();
			}else{
				alert("스페셜 상품이 선택 되었습니다.");
				location.reload();
			}
		}
	});
});

// 전체 스페셜 상품 리스트 생성
function show_plan_goods_list(id)
{
	$.ajax({
		type   : "POST",
		async  : false,
		url    : "admin_exec.php",
		data:{
			"exec"		: "show_plan_goods_list",
			"target"	: id
		},
		success: function(response){
			$("#"+id).html(response);
		}
	});
}

// 스페셜 상품 관리 > 스페셜 상품 목록 > 수정 버튼 클릭
$(document).on("blur", ".edit_plan_goods", function(){
	var goods_code			= $(this).attr('edit_code');
	var goods_sequence	= $(this).val();

	$.ajax({
		type   : "POST",
		async  : false,
		url    : "admin_exec.php",
		data:{
			"exec"					: "edit_plan_goods",
			"goods_code"		: goods_code,
			"goods_sequence"	: goods_sequence
		}
	});

});

// 스페셜 상품 관리 > 스페셜 상품 목록 > 삭제 버튼 클릭
$(document).on("blur", ".del_plan_goods", function(){
	var goods_code			= $(this).attr('del_code');

	if (confirm("스페셜 상품에서 제외할까요?"))
	{
		$.ajax({
			type   : "POST",
			async  : false,
			url    : "admin_exec.php",
			data:{
				"exec"					: "delete_plan_goods",
				"goods_code"		: goods_code
			},
			success: function(response){
				alert("스페셜상품에서 제외되었습니다.");
				location.reload();
			}
		});
	}
});

// *********************** 포스트 *********************** //

// 이벤트 & 포스트 관리 > 포스트 추가 버튼 클릭
$(document).on("click", "#add_post_btn", function(){
	$("#list_post").hide();
	$("#add_post").show();
});

// 이벤트 & 포스트 관리 > 포스트 목록 버튼 클릭
$(document).on("click", "#list_post_btn", function(){
	$("#add_post").hide();
	$("#list_post").show();
});

// 포스트 정보 insert
$(document).on("click", "#submit_btn14", function(){
	var post_title				= $("#post_title").val();
	var post_subtitle			= $("#post_subtitle").val();
	var post_contents			= oEditors.getById["post_contents"].getIR();

	if (post_title == "")
	{
		alert("포스트 제목을 입력해주세요.");
		$("#post_title").focus();
		return false;
	}

	if (post_subtitle == "")
	{
		alert("포스트 설명을 입력해주세요.");
		$("#post_title").focus();
		return false;
	}

	if (post_contents == "")
	{
		alert("포스트 내용을 입력해주세요.");
		$("#post_contents").focus();
		return false;
	}

	$.ajax({
		type   : "POST",
		async  : false,
		url    : "admin_exec.php",
		data:{
			"exec"					: "insert_post_info",
			"post_title"			: post_title,
			"post_subtitle"		: post_subtitle,
			"post_contents"		: post_contents
		},
		success: function(response){
			if (response == "N")
			{
				alert("다시 시도해 주세요.");
				location.reload();
			}else{
				img_submit5(response);
				alert("포스트가 추가 되었습니다.");
				location.reload();
			}
		}
	});
});

// 포스트 정보 update
$(document).on("click", "#submit_btn15", function(){
	var idx						= $("#idx").val();
	var post_title				= $("#post_title").val();
	var post_contents			= oEditors.getById["post_contents"].getIR();

	if (post_title == "")
	{
		alert("포스트 제목을 입력해주세요.");
		$("#post_title").focus();
		return false;
	}

	if (post_contents == "")
	{
		alert("포스트 내용을 입력해주세요.");
		$("#post_contents").focus();
		return false;
	}

	$.ajax({
		type   : "POST",
		async  : false,
		url    : "admin_exec.php",
		data:{
			"exec"					: "update_post_info",
			"idx"					: idx,
			"post_title"			: post_title,
			"post_contents"		: post_contents
		},
		success: function(response){
			if (response == "Y")
			{
				alert("포스트 정보가 수정 되었습니다.");
				location.reload();
			}else{
				alert("다시 시도해 주세요.");
				location.reload();
			}
		}
	});
});

// 전체 이벤트 리스트 생성
function show_post_list(id)
{
	$.ajax({
		type   : "POST",
		async  : false,
		url    : "admin_exec.php",
		data:{
			"exec"	: "show_post_list",
			"target"	: id
		},
		success: function(response){
			$("#"+id).html(response);
		}
	});
}

// *********************** 이벤트 *********************** //

// 이벤트 & 포스트 관리 > 이벤트 추가 버튼 클릭
$(document).on("click", "#add_event_btn", function(){
	$("#list_event").hide();
	$("#add_event").show();
});

// 이벤트 & 포스트 관리 > 이벤트 목록 버튼 클릭
$(document).on("click", "#list_event_btn", function(){
	$("#add_event").hide();
	$("#list_event").show();
});

// 이벤트 정보 insert
$(document).on("click", "#submit_btn12", function(){
	var event_title				= $("#event_title").val();
	var event_startdate			= $("#event_startdate").val();
	var event_enddate			= $("#event_enddate").val();
	var event_contents			= oEditors.getById["event_contents"].getIR();

	if (event_title == "")
	{
		alert("이벤트 제목을 입력해주세요.");
		$("#event_title").focus();
		return false;
	}

	if (event_contents == "")
	{
		alert("이벤트 내용을 입력해주세요.");
		$("#event_contents").focus();
		return false;
	}

	$.ajax({
		type   : "POST",
		async  : false,
		url    : "admin_exec.php",
		data:{
			"exec"					: "insert_event_info",
			"event_title"			: event_title,
			"event_startdate"	: event_startdate,
			"event_enddate"	: event_enddate,
			"event_contents"	: event_contents
		},
		success: function(response){
			if (response == "N")
			{
				alert("다시 시도해 주세요.");
				location.reload();
			}else if (response == "SN"){
				alert("이벤트 시작일이 현재날짜보다 작으면 안됩니다.");
			}else if (response == "EN"){
				alert("이벤트 종료일은 시작일보다 작으면 안됩니다.");
			}else{
				img_submit4(response);
				alert("이벤트가 추가 되었습니다.");
				location.reload();
			}
		}
	});
});

// 이벤트 정보 update
$(document).on("click", "#submit_btn13", function(){
	var idx						= $("#idx").val();
	var event_title				= $("#event_title").val();
	var event_startdate			= $("#event_startdate").val();
	var event_enddate			= $("#event_enddate").val();
	var event_contents			= oEditors.getById["event_contents"].getIR();

	if (event_title == "")
	{
		alert("이벤트 제목을 입력해주세요.");
		$("#event_title").focus();
		return false;
	}

	if (event_contents == "")
	{
		alert("이벤트 내용을 입력해주세요.");
		$("#event_contents").focus();
		return false;
	}

	$.ajax({
		type   : "POST",
		async  : false,
		url    : "admin_exec.php",
		data:{
			"exec"					: "update_event_info",
			"idx"					: idx,
			"event_title"			: event_title,
			"event_startdate"	: event_startdate,
			"event_enddate"	: event_enddate,
			"event_contents"	: event_contents
		},
		success: function(response){
			if (response == "Y")
			{
				alert("이벤트 정보가 수정 되었습니다.");
				location.reload();
			}else if (response == "SN"){
				alert("이벤트 시작일이 현재날짜보다 작으면 안됩니다.");
			}else if (response == "EN"){
				alert("이벤트 종료일은 시작일보다 작으면 안됩니다.");
			}else{
				alert("다시 시도해 주세요.");
				location.reload();
			}
		}
	});
});

// 전체 이벤트 리스트 생성
function show_event_list(id)
{
	$.ajax({
		type   : "POST",
		async  : false,
		url    : "admin_exec.php",
		data:{
			"exec"	: "show_event_list",
			"target"	: id
		},
		success: function(response){
			$("#"+id).html(response);
		}
	});
}

// *********************** 카테고리 *********************** //

// 1차 카테고리 선택 메뉴 show
$(document).on("click", "#cate1_btn_td a", function(){
	$("#cate1_btn_td").hide();
	$("#cate1_sel_td").show();
});

// 2차 카테고리 선택 메뉴 show
$(document).on("click", "#cate2_btn_td a", function(){
	if ($("#cate1_sel_td").css("display") == "none")
	{
		alert("1차 카테고리를 먼저 선택해 주셔야 합니다.");
		return false;
	}
	$("#cate2_btn_td").hide();
	$("#cate2_sel_td").show();
});

// 3차 카테고리 선택 메뉴 show
$(document).on("click", "#cate3_btn_td a", function(){
	if ($("#cate1_sel_td").css("display") == "none")
	{
		alert("1차 카테고리를 먼저 선택해 주셔야 합니다.");
		return false;
	}
	if ($("#cate2_sel_td").css("display") == "none")
	{
		alert("2차 카테고리를 먼저 선택해 주셔야 합니다.");
		return false;
	}
	$("#cate3_btn_td").hide();
	$("#cate3_sel_td").show();
});

// 관리자 카테고리 관리 > 카테고리 추가 버튼 클릭
$(document).on("click", "#add_category_btn", function(){
	$("#list_category").hide();
	$("#add_category").show();
});

// 관리자 카테고리 관리 > 카테고리 목록 버튼 클릭
$(document).on("click", "#list_category_btn", function(){
	$("#add_category").hide();
	$("#list_category").show();
});

// 1차 카테고리 선택시 2차 카테고리 내용 변경
$(document).on("change", "#cate_1", function(){
	show_select_cate2("cate_2");
});

// 2차 카테고리 선택시 3차 카테고리 내용 변경
$(document).on("change", "#cate_2", function(){
	show_select_cate3("cate_3");
});

// 회원 등급 select 새로 생성
function show_select_grade(id)
{
	$.ajax({
		type   : "POST",
		async  : false,
		url    : "admin_exec.php",
		data:{
			"exec"	: "show_select_grade"
		},
		success: function(response){
			$("#"+id).html(response);
		}
	});
}

// 카테고리1 select 새로 생성
function show_select_cate1(id)
{
	$.ajax({
		type   : "POST",
		async  : false,
		url    : "admin_exec.php",
		data:{
			"exec"	: "show_select_cate1"
		},
		success: function(response){
			$("#"+id).html(response);
		}
	});
}

// 판매경로 select 새로 생성
function show_select_sales_store(id)
{
	$.ajax({
		type   : "POST",
		async  : false,
		url    : "admin_exec.php",
		data:{
			"exec"	: "show_select_sales_store"
		},
		success: function(response){
			$("#"+id).html(response);
		}
	});
}

// 판매경로 select 새로 생성
function show_select_brand(id)
{
	$.ajax({
		type   : "POST",
		async  : false,
		url    : "admin_exec.php",
		data:{
			"exec"	: "show_select_brand"
		},
		success: function(response){
			$("#"+id).html(response);
		}
	});
}

// 브랜드 선택된값 세팅
function selected_brand(id,brand)
{
	$("#"+id).val(brand);
}

// 판매경로 선택된값 세팅
function selected_sales_store(id,sales_store)
{
	$("#"+id).val(sales_store);
}

// 카테고리1 선택된값 세팅
function selected_category(id,cate1_val,cate2_val,cate3_val)
{
	$("#"+id).val(cate1_val);
	show_select_cate2("cate_2");
	$("#cate_2").val(cate2_val);
	show_select_cate3("cate_3");
	$("#cate_3").val(cate3_val);
}

// 카테고리2 select 새로 생성
function show_select_cate2(id)
{
	var cate_1	= $("#cate_1").val();

	$.ajax({
		type   : "POST",
		async  : false,
		url    : "admin_exec.php",
		data:{
			"exec"	: "show_select_cate2",
			"cate_1"	: cate_1
		},
		success: function(response){
			$("#"+id).html(response);
		}
	});
}

// 카테고리3 select 새로 생성
function show_select_cate3(id)
{
	var cate_1	= $("#cate_1").val();
	var cate_2	= $("#cate_2").val();

	$.ajax({
		type   : "POST",
		async  : false,
		url    : "admin_exec.php",
		data:{
			"exec"	: "show_select_cate3",
			"cate_1"	: cate_1,
			"cate_2"	: cate_2
		},
		success: function(response){
			$("#"+id).html(response);
		}
	});
}

// 전체 카테고리 리스트 생성
function show_category_list(id)
{
	$.ajax({
		type   : "POST",
		async  : false,
		url    : "admin_exec.php",
		data:{
			"exec"	: "show_category_list",
			"target"	: id
		},
		success: function(response){
			$("#"+id).html(response);
		}
	});
}

// 카테고리 정보 insert
$(document).on("click", "#submit_btn", function(){
	var cate_name				= $("#cate_name").val();
	var cate_1					= $("#cate_1").val();
	var cate_2					= $("#cate_2").val();
	var cate_3					= $("#cate_3").val();
	var cate_pcYN				= $(':radio[name="cate_pcYN"]:checked').val();
	var cate_mobileYN		= $(':radio[name="cate_mobileYN"]:checked').val();
	var cate_accessYN		= $(':radio[name="cate_accessYN"]:checked').val();
	var access_specific		= $("#access_specific").val();

	if (cate_name == "")
	{
		alert("카테고리 이름을 입력해주세요.");
		$("#cate_name").focus();
		return false;
	}

	if (cate_accessYN == "SPECIFIC")
	{
		if (access_specific == "")
		{
			alert("카테고리가 보여질 회원등급을 선택해 주세요.");
			return false;
		}
	}

	$.ajax({
		type   : "POST",
		async  : false,
		url    : "admin_exec.php",
		data:{
			"exec"				: "insert_cate_info",
			"cate_name"			: cate_name,
			"cate_1"			: cate_1,
			"cate_2"			: cate_2,
			"cate_3"			: cate_3,
			"cate_pcYN"			: cate_pcYN,
			"cate_mobileYN"		: cate_mobileYN,
			"cate_accessYN"		: cate_accessYN,
			"access_specific"	: access_specific
		},
		success: function(response){
			var res_arr = response.split("||");
			
			if (res_arr[0] == "Y")
			{
				//alert("카테고리가 추가 되었습니다.");
				img_submit6(res_arr[1],res_arr[2],res_arr[3]);
				location.reload();
			}else{
				alert("다시 시도해 주세요.");
				location.reload();
			}
		}
	});
});

// 카테고리 정보 update
$(document).on("click", "#submit_btn4", function(){
	var idx						= $("#idx").val();
	var cate_name				= $("#cate_name").val();
	var cate_1					= $("#cate_1").val();
	var cate_2					= $("#cate_2").val();
	var cate_3					= $("#cate_3").val();
	var cate_pcYN				= $(':radio[name="cate_pcYN"]:checked').val();
	var cate_mobileYN		= $(':radio[name="cate_mobileYN"]:checked').val();
	var cate_accessYN		= $(':radio[name="cate_accessYN"]:checked').val();
	var access_specific		= $("#access_specific").val();

	if (cate_name == "")
	{
		alert("카테고리 이름을 입력해주세요.");
		$("#cate_name").focus();
		return false;
	}

	if (cate_accessYN == "SPECIFIC")
	{
		if (access_specific == "")
		{
			alert("카테고리가 보여질 회원등급을 선택해 주세요.");
			return false;
		}
	}
	$.ajax({
		type   : "POST",
		async  : false,
		url    : "admin_exec.php",
		data:{
			"exec"					: "update_cate_info",
			"idx"						: idx,
			"cate_name"			: cate_name,
			"cate_1"					: cate_1,
			"cate_2"					: cate_2,
			"cate_3"					: cate_3,
			"cate_pcYN"			: cate_pcYN,
			"cate_mobileYN"		: cate_mobileYN,
			"cate_accessYN"		: cate_accessYN,
			"access_specific"		: access_specific
		},
		success: function(response){
			alert(response);
			if (response == "Y")
			{
				alert("카테고리정보가 수정 되었습니다.");
				location.href='category.php';
			}else{
				alert("다시 시도해 주세요.");
				location.reload();
			}
		}
	});
});

// *********************** 상품관리 *********************** //

// 관리자 상품 관리 > 옵션사용 클릭
$(document).on("click", "#goods_optionY", function(){
	$("#option_ins").show();
});

// 관리자 상품 관리 > 옵션사용안함 클릭
$(document).on("click", "#goods_optionN", function(){
	$("#option_ins").hide();
});

// 관리자 상품 관리 > 옵션 추가 버튼 클릭
$(document).on("click", ".option_add_btn", function(){
	option_num	= Number(option_num) + 1;

	option_txt	= '<tr><td><input class="form-control" id="option_name'+option_num+'" placeholder="예시) 색상" style="width:100%"></td><td><input class="form-control" id="option_value'+option_num+'" placeholder="예시) 블랙;화이트;블루" style="width:90%"> <button type="button" class="btn btn-primary btn-xs option_add_btn">+</button></td></tr>';
	$("#option_detail_tr").append(option_txt);
});

// 관리자 상품 관리 > 적립금 직접 등록
$(document).on("click", "#saved_priceN", function(){
	$("#save_detail_div").show();
});

// 관리자 상품 관리 > 적립금 별도 설정
$(document).on("click", "#saved_priceY", function(){
	$("#save_detail_div").hide();
});

// 관리자 상품 관리 > 모바일 상품 상세설명 입력
$(document).on("click", "#m_goods_big_descY", function(){
	$("#mobile_detail_div").show();
});

// 관리자 상품 관리 > 모바일 상품 상세설명 입력안함
$(document).on("click", "#m_goods_big_descN", function(){
	$("#mobile_detail_div").hide();
});

// 전체 상품 리스트 생성
function show_goods_list(id)
{
	$.ajax({
		type   : "POST",
		async  : false,
		url    : "admin_exec.php",
		data:{
			"exec"	: "show_goods_list",
			"target"	: id
		},
		success: function(response){
			$("#"+id).html(response);
		}
	});
}

// 상품 정보 insert
$(document).on("click", "#submit_btn2", function(){
	var showYN						= $(':radio[name="showYN"]:checked').val();
	var salesYN						= $(':radio[name="salesYN"]:checked').val();
	var cate_1						= $("#cate_1").val();
	var cate_2						= $("#cate_2").val();
	var cate_3						= $("#cate_3").val();
	var related_goods				= $("#related_goods").val();
	var sales_store					= $("#sales_store").val();
	var goods_name				= $("#goods_name").val();
	var goods_eng_name			= $("#goods_eng_name").val();
	var goods_model				= $("#goods_model").val();
	var goods_brand				= $("#goods_brand").val();
	var goods_status				= $(':radio[name="goods_status"]:checked').val();
	var goods_small_desc			= $("#goods_small_desc").val();
	var goods_middle_desc		= $("#goods_middle_desc").val();
	var goods_big_desc			= oEditors.getById["goods_big_desc"].getIR();
	var m_goods_big_descYN		= $(':radio[name="m_goods_big_descYN"]:checked').val();
	var supply_price				= $("#supply_price").val();
	var sales_price					= $("#sales_price").val();
	var discount_price				= $("#discount_price").val();
	var saved_priceYN				= $(':radio[name="saved_priceYN"]:checked').val();
	var goods_optionYN			= $(':radio[name="goods_optionYN"]:checked').val();
	var goods_option_txt			= "";
	var goods_stock				= $("#goods_stock").val();
	var m_goods_big_desc		= "";
	var saved_price					= "";

	if (cate_1 == "")
	{
		alert("상품분류를 선택해주세요.");
		return false;
	}

	if (cate_2 == "" && cate_1 != "5")
	{
		alert("상품분류를 선택해주세요.");
		return false;
	}
/*
	if (cate_3 == "")
	{
		alert("상품분류를 선택해주세요.");
		return false;
	}
*/
	if (sales_store == "")
	{
		alert("판매경로를 선택해주세요.");
		return false;
	}

	if (goods_name == "")
	{
		alert("상품명을 입력해주세요.");
		$("#goods_name").focus();
		return false;
	}

	if (goods_small_desc == "")
	{
		alert("상품 요약 설명을 입력해주세요.");
		$("#goods_small_desc").focus();
		return false;
	}

	if (goods_middle_desc == "")
	{
		alert("상품 간략 설명을 입력해주세요.");
		$("#goods_middle_desc").focus();
		return false;
	}

	if (goods_big_desc == "")
	{
		alert("상품 상세 설명을 입력해주세요.");
		$("#goods_big_desc").focus();
		return false;
	}

	if (m_goods_big_descYN == "new")
	{
		m_goods_big_desc		= m_oEditors.getById["m_goods_big_desc"].getIR();
		if (m_goods_big_desc == "")
		{
			alert("모바일 상품 상세 설명을 입력해주세요.");
			$("#m_goods_big_desc").focus();
			return false;
		}
	}

	if (supply_price == "")
	{
		alert("공급가를 입력해주세요.");
		$("#supply_price").focus();
		return false;
	}

	if (sales_price == "")
	{
		alert("판매가를 입력해주세요.");
		$("#sales_price").focus();
		return false;
	}

	if (saved_priceYN == "N")
	{
		saved_price				= $("#saved_price").val();
		if (saved_price == "")
		{
			alert("적립금을 입력해주세요.");
			$("#saved_price").focus();
			return false;
		}
	}

	if (goods_optionYN == "Y")
	{
		for (var i=1; i<=option_num; i++ )
		{
			var option_tag	= "";
			if (i != option_num)
				option_tag	= "||";

			goods_option_txt			+= $("#option_name"+i).val() + "|+|" + $("#option_value"+i).val() + option_tag;
		}
		if (goods_option_txt == "")
		{
			alert("상품 옵션을 입력해 주세요.");
			return false;
		}
	}

	if (goods_stock == "")
	{
		alert("재고수량을 입력해주세요.");
		$("#goods_stock").focus();
		return false;
	}

	$.ajax({
		type   : "POST",
		async  : false,
		url    : "admin_exec.php",
		data:{
			"exec"							: "insert_goods_info",
			"showYN"						: showYN,
			"salesYN"						: salesYN,
			"cate_1"						: cate_1,
			"cate_2"						: cate_2,
			"cate_3"						: cate_3,
			"related_goods"				: related_goods,
			"sales_store"					: sales_store,
			"goods_name"				: goods_name,
			"goods_eng_name"			: goods_eng_name,
			"goods_model"				: goods_model,
			"goods_brand"				: goods_brand,
			"goods_status"				: goods_status,
			"goods_small_desc"		: goods_small_desc,
			"goods_middle_desc"		: goods_middle_desc,
			"goods_big_desc"			: goods_big_desc,
			"m_goods_big_descYN"	: m_goods_big_descYN,
			"m_goods_big_desc"		: m_goods_big_desc,
			"supply_price"				: supply_price,
			"sales_price"					: sales_price,
			"discount_price"				: discount_price,
			"saved_priceYN"				: saved_priceYN,
			"saved_price"				: saved_price,
			"goods_optionYN"			: goods_optionYN,
			"goods_option_txt"			: goods_option_txt,
			"goods_stock"				: goods_stock,
		},
		success: function(response){
			var res_arr = response.split("||");
			goods_code	= res_arr[1];
			if (res_arr[0]== "Y")
			{
				img_submit();
			}else{
				alert("다시 시도해 주세요.");
				location.reload();
			}
		}
	});
});

// 상품 정보 update
$(document).on("click", "#submit_btn3", function(){
	var showYN						= $(':radio[name="showYN"]:checked').val();
	var salesYN						= $(':radio[name="salesYN"]:checked').val();
	var cate_1						= $("#cate_1").val();
	var cate_2						= $("#cate_2").val();
	var cate_3						= $("#cate_3").val();
	var related_goods				= $("#related_goods").val();
	var sales_store					= $("#sales_store").val();
	var goods_name				= $("#goods_name").val();
	var goods_eng_name			= $("#goods_eng_name").val();
	var goods_model				= $("#goods_model").val();
	var goods_brand				= $("#goods_brand").val();
	var goods_status				= $(':radio[name="goods_status"]:checked').val();
	var goods_small_desc			= $("#goods_small_desc").val();
	var goods_middle_desc		= $("#goods_middle_desc").val();
	var goods_big_desc			= oEditors.getById["goods_big_desc"].getIR();
	var m_goods_big_descYN		= $(':radio[name="m_goods_big_descYN"]:checked').val();
	var supply_price				= $("#supply_price").val();
	var sales_price					= $("#sales_price").val();
	var discount_price				= $("#discount_price").val();
	var saved_priceYN				= $(':radio[name="saved_priceYN"]:checked').val();
	var goods_optionYN			= $(':radio[name="goods_optionYN"]:checked').val();
	var goods_option_txt			= "";
	var goods_stock				= $("#goods_stock").val();
	goods_code						= $("#goodscode").val();
	var m_goods_big_desc		= "";
	var saved_price					= "";

	if (cate_1 == "")
	{
		alert("상품분류를 선택해주세요.");
		return false;
	}

	if (cate_2 == "")
	{
		alert("상품분류를 선택해주세요.");
		return false;
	}
/*
	if (cate_3 == "")
	{
		alert("상품분류를 선택해주세요.");
		return false;
	}
*/
	if (goods_name == "")
	{
		alert("상품명을 입력해주세요.");
		$("#goods_name").focus();
		return false;
	}

	if (goods_small_desc == "")
	{
		alert("상품 요약 설명을 입력해주세요.");
		$("#goods_small_desc").focus();
		return false;
	}

//	if (goods_middle_desc == "")
//	{
//		alert("상품 간략 설명을 입력해주세요.");
//		$("#goods_middle_desc").focus();
//		return false;
//	}

	if (goods_big_desc == "")
	{
		alert("상품 상세 설명을 입력해주세요.");
		$("#goods_big_desc").focus();
		return false;
	}

	if (m_goods_big_descYN == "new")
	{
		m_goods_big_desc		= m_oEditors.getById["m_goods_big_desc"].getIR();
		if (m_goods_big_desc == "")
		{
			alert("모바일 상품 상세 설명을 입력해주세요.");
			$("#m_goods_big_desc").focus();
			return false;
		}
	}

	if (supply_price == "")
	{
		alert("공급가를 입력해주세요.");
		$("#supply_price").focus();
		return false;
	}

	if (sales_price == "")
	{
		alert("판매가를 입력해주세요.");
		$("#sales_price").focus();
		return false;
	}

	if (saved_priceYN == "N")
	{
		saved_price				= $("#saved_price").val();
		if (saved_price == "")
		{
			alert("적립금을 입력해주세요.");
			$("#saved_price").focus();
			return false;
		}
	}

	if (goods_optionYN == "Y")
	{
		alert(option_num);
		for (var i=1; i<=option_num; i++ )
		{
			var option_tag	= "";
			if (i != option_num)
				option_tag	= "||";

			goods_option_txt			+= $("#option_name"+i).val() + "|+|" + $("#option_value"+i).val() + option_tag;
		}
		if (goods_option_txt == "")
		{
			alert("상품 옵션을 입력해 주세요.");
			return false;
		}
	}

	if (goods_stock == "")
	{
		alert("재고수량을 입력해주세요.");
		$("#goods_stock").focus();
		return false;
	}

	$.ajax({
		type   : "POST",
		async  : false,
		url    : "admin_exec.php",
		data:{
			"exec"							: "update_goods_info",
			"showYN"						: showYN,
			"salesYN"						: salesYN,
			"cate_1"						: cate_1,
			"cate_2"						: cate_2,
			"cate_3"						: cate_3,
			"related_goods"				: related_goods,
			"sales_store"					: sales_store,
			"goods_name"				: goods_name,
			"goods_eng_name"			: goods_eng_name,
			"goods_model"				: goods_model,
			"goods_brand"				: goods_brand,
			"goods_status"				: goods_status,
			"goods_small_desc"		: goods_small_desc,
			"goods_middle_desc"		: goods_middle_desc,
			"goods_big_desc"			: goods_big_desc,
			"m_goods_big_descYN"	: m_goods_big_descYN,
			"m_goods_big_desc"		: m_goods_big_desc,
			"supply_price"				: supply_price,
			"sales_price"					: sales_price,
			"discount_price"				: discount_price,
			"saved_priceYN"				: saved_priceYN,
			"saved_price"				: saved_price,
			"goods_optionYN"			: goods_optionYN,
			"goods_option_txt"			: goods_option_txt,
			"goods_stock"				: goods_stock,
			"goods_code"				: goods_code,
		},
		success: function(response){
			var res_arr		= response.split("||");
			//goods_code	= goods_code;
			if (res_arr[0]== "Y")
			{
				img_submit2();
			}else{
				alert("다시 시도해 주세요.");
				location.reload();
			}
		}
	});
});

// 선택한 상품 삭제
$(document).on("click", ".del_goods", function(){
	if (confirm(" 상품을 삭제하시겠습니까?"))
	{
		var goodscode	= $(".del_goods").attr("data-goodscode");
		$.ajax({
			type   : "POST",
			async  : false,
			url    : "admin_exec.php",
			data:{
				"exec"						: "delete_goods_info",
				"goodscode"				: goodscode
			},
			success: function(response){
				if (response == "Y")
				{
					alert("해당 상품이 삭제 되었습니다.");
					location.reload();
				}else{
					alert("시스템 오류. 다시 시도해 주세요.");
					location.reload();
				}
			}
		});
	}
});

function img_submit()
{
	var frm = $('#img_frm');
	var stringData = frm.serialize();
	frm.ajaxSubmit({
		type: 'post',
		url: '../../lib/filer/php/upload.php?ig=goods&goodscode='+goods_code,
		data: stringData,
		success:function(msg){
			alert('상품이 등록 되었습니다');
			self.location.reload();
		}
	}); // end ajaxSubmit
}

function img_submit2()
{
	var frm = $('#img_frm');
	var stringData = frm.serialize();
	frm.ajaxSubmit({
		type: 'post',
		url: '../../lib/filer/php/upload.php?ig=goods&goodscode='+goods_code,
		data: stringData,
		success:function(msg){
			alert('상품정보가 수정 되었습니다');
			self.location.reload();
		}
	}); // end ajaxSubmit
}

function img_submit3(idx)
{
	var frm = $('#main_image_frm');
	var stringData = frm.serialize();
	
	frm.ajaxSubmit({
		type: 'post',
		url: '../../lib/filer/php/upload.php?ig=banner&b_idx='+idx,
		data: stringData,
		success:function(msg){
			alert('배너가 등록 되었습니다');
			self.location.reload();
		}
	}); // end ajaxSubmit
}

function img_submit4(idx)
{
	var frm = $('#main_image_frm');
	var stringData = frm.serialize();
	frm.ajaxSubmit({
		type: 'post',
		url: '../../lib/filer/php/upload.php?ig=event&idx='+idx,
		data: stringData,
		success:function(msg){
			self.location.reload();
		}
	}); // end ajaxSubmit
}

function img_submit5(idx)
{
	var frm = $('#main_image_frm');
	var stringData = frm.serialize();
	frm.ajaxSubmit({
		type: 'post',
		url: '../../lib/filer/php/upload.php?ig=post&idx='+idx,
		data: stringData,
		success:function(msg){
			alert('배너가 등록 되었습니다');
			self.location.reload();
		}
	}); // end ajaxSubmit
}

function img_submit6(cate_1, cate_2, cate_3)
{
	var frm = $('#main_image_frm');
	var stringData = frm.serialize();
	frm.ajaxSubmit({
		type: 'post',
		url: '../../lib/filer/php/upload.php?ig=category&cate_1='+cate_1+'&cate_2='+cate_2+'&cate_3='+cate_3,
		data: stringData,
		success:function(msg){
			alert(msg);
			alert('카테고리가 등록 되었습니다');
			self.location.reload();
		}
	}); // end ajaxSubmit
}

// *********************** 재고관리 *********************** //

// 관리자 상품 관리 > 재고관리 > 재고 더블클릭
$(document).on("dblclick", ".stock_td", function(){
	var thisval	= $(this).html();
	$(this).attr('class','stock_td_fin');
	$(this).html("<input class='form-control' value='"+thisval+"'>");
	$(".stock_td_fin input").focus();
});

// 관리자 상품 관리 > 재고관리 > 재고 더블클릭 이후 블러처리
$(document).on("blur", ".stock_td_fin", function(){
	var thisval	= $(".stock_td_fin input").val();

	$.ajax({
		type   : "POST",
		async  : false,
		url    : "admin_exec.php",
		data:{
			"exec"				: "update_stock_info_bak",
			"goods_code"		: this.id,
			"goods_stock"		: thisval
		},
		success: function(response){
			if (response == "Y")
			{
				$(".stock_td_fin").html(thisval);
				$(".stock_td_fin").attr('class','stock_td');
			}else{
				alert("다시 시도해 주세요.");
				location.reload();
			}
		}
	});
});

// 쇼핑몰 관리 > 상품 관리 > 재고정보 수정 버튼 클릭
$(document).on("click", "#edit_stock_info_btn", function(){
	$("#list_stock_info").hide();
	$("#edit_stock_info").show();
});

// 쇼핑몰 관리 > 상품 관리 > 재고정보 목록 버튼 클릭
$(document).on("click", "#list_stock_info_btn", function(){
	$("#edit_stock_info").hide();
	$("#list_stock_info").show();
});

// 쇼핑몰 관리 > 상품 관리 > 재고 관리 > 상품코드 select 변경
$(document).on("change", "#sel_goodscode", function(){
	$.ajax({
		type   : "POST",
		async  : false,
		url    : "admin_exec.php",
		data:{
			"exec"				: "change_stock_goodscode",
			"goods_code"	: this.value
		},
		success: function(response){
			var res_arr	= response.split("||");
			$("#stock_name").val(res_arr[0]);
			$("#stock_cnt").val(res_arr[1]);
			$("#stock_price").val(res_arr[2]);
			$("#sales_cnt").val(res_arr[3]);
			$("#sales_price").val(res_arr[4]);
		}
	});

});

// 상품코드 가져오기 ( select )
function show_select_goodscode(id)
{
	$.ajax({
		type   : "POST",
		async  : false,
		url    : "admin_exec.php",
		data:{
			"exec"	: "show_select_goodscode"
		},
		success: function(response){
			$("#"+id).html(response);
		}
	});
}

// 전체 재고 리스트 생성
function show_stock_list(id)
{
	$.ajax({
		type   : "POST",
		async  : false,
		url    : "admin_exec.php",
		data:{
			"exec"	: "show_stock_list",
			"target"	: id
		},
		success: function(response){
			$("#"+id).html(response);
		}
	});
}

// 재고 정보 update
$(document).on("click", "#submit_btn11", function(){
	var goods_code			= $("#sel_goodscode").val();
	var stock_cnt			= $("#stock_cnt").val();
	var stock_price			= $("#stock_price").val();
	var sales_cnt				= $("#sales_cnt").val();
	var sales_price			= $("#sales_price").val();
	var stock_edit_desc	= $("#stock_edit_desc").val();

	if (stock_edit_desc == "")
	{
		alert("재고정보 수정 사유를 입력해주세요.");
		$("#stock_edit_desc").focus();
		return false;
	}

	$.ajax({
		type   : "POST",
		async  : false,
		url    : "admin_exec.php",
		data:{
			"exec"					: "update_stock_info",
			"goods_code"		: goods_code,
			"stock_cnt"			: stock_cnt,
			"stock_price"			: stock_price,
			"sales_cnt"			: sales_cnt,
			"sales_price"			: sales_price,
			"stock_edit_desc"	: stock_edit_desc
		},
		success: function(response){
			if (response == "Y")
			{
				alert("재고 정보가 수정되었습니다.");
				location.reload();
			}else{
				alert("다시 시도해 주세요.");
				location.reload();
			}
		}
	});
});

// *********************** 거래처 *********************** //

// 거래처 정보 insert
$(document).on("click", "#submit_btn5", function(){
	var purchasing_name		= $("#purchasing_name").val();
	var purchasing_addr			= $("#purchasing_addr").val();
	var purchasing_phone		= $("#purchasing_phone").val();
	var purchasing_desc			= $("#purchasing_desc").val();

	if (purchasing_name == "")
	{
		alert("브랜드 명을 입력해주세요.");
		$("#purchasing_name").focus();
		return false;
	}

	if (purchasing_phone == "")
	{
		alert("브랜드 전화번호를 입력해주세요.");
		$("#purchasing_phone").focus();
		return false;
	}

	$.ajax({
		type   : "POST",
		async  : false,
		url    : "admin_exec.php",
		data:{
			"exec"						: "insert_purchasing_info",
			"purchasing_name"		: purchasing_name,
			"purchasing_addr"		: purchasing_addr,
			"purchasing_phone"		: purchasing_phone,
			"purchasing_desc"		: purchasing_desc
		},
		success: function(response){
			if (response == "Y")
			{
				alert("브랜드 정보가 입력 되었습니다.");
				location.reload();
			}else{
				alert("다시 시도해 주세요.");
				location.reload();
			}
		}
	});
});

// 쇼핑몰 관리 > 거래처 관리 > 거래처 추가 버튼 클릭
$(document).on("click", "#add_purchasing_btn", function(){
	$("#list_purchasing").hide();
	$("#add_purchasing").show();
});

// 쇼핑몰 관리 > 거래처 관리 > 거래처 목록 버튼 클릭
$(document).on("click", "#list_purchasing_btn", function(){
	$("#add_purchasing").hide();
	$("#list_purchasing").show();
});

// 전체 거래처 리스트 생성
function show_purchasing_list(id)
{
	$.ajax({
		type   : "POST",
		async  : false,
		url    : "admin_exec.php",
		data:{
			"exec"	: "show_purchasing_list",
			"target"	: id
		},
		success: function(response){
			$("#"+id).html(response);
		}
	});
}

// 거래처 정보 update
$(document).on("click", "#submit_btn6", function(){
	var idx							= $("#idx").val();
	var purchasing_name		= $("#purchasing_name").val();
	var purchasing_addr			= $("#purchasing_addr").val();
	var purchasing_phone		= $("#purchasing_phone").val();
	var purchasing_desc			= $("#purchasing_desc").val();

	if (purchasing_name == "")
	{
		alert("브랜드 명을 입력해주세요.");
		$("#purchasing_name").focus();
		return false;
	}

	if (purchasing_phone == "")
	{
		alert("브랜드 전화번호를 입력해주세요.");
		$("#purchasing_phone").focus();
		return false;
	}

	$.ajax({
		type   : "POST",
		async  : false,
		url    : "admin_exec.php",
		data:{
			"exec"						: "update_purchasing_info",
			"idx"							: idx,
			"purchasing_name"		: purchasing_name,
			"purchasing_addr"		: purchasing_addr,
			"purchasing_phone"		: purchasing_phone,
			"purchasing_desc"		: purchasing_desc
		},
		success: function(response){
			if (response == "Y")
			{
				alert("브랜드 정보가 수정되었습니다.");
				location.reload();
			}else{
				alert("다시 시도해 주세요.");
				location.reload();
			}
		}
	});
});

// *********************** 판매경로 관리 *********************** //

// 판매경로 정보 insert
$(document).on("click", "#submit_btn9", function(){
	var sales_store_name		= $("#sales_store_name").val();
	var sales_store_media		= $("#sales_store_media").val();
	var sales_store_desc		= $("#sales_store_desc").val();

	if (sales_store_name == "")
	{
		alert("판매경로 명을 입력해주세요.");
		$("#sales_store_name").focus();
		return false;
	}

	$.ajax({
		type   : "POST",
		async  : false,
		url    : "admin_exec.php",
		data:{
			"exec"						: "insert_sales_store_info",
			"sales_store_name"		: sales_store_name,
			"sales_store_media"		: sales_store_media,
			"sales_store_desc"		: sales_store_desc
		},
		success: function(response){
			alert(response);
			if (response == "Y")
			{
				alert("판매경로 정보가 입력 되었습니다.");
				location.reload();
			}else{
				alert("다시 시도해 주세요.");
				location.reload();
			}
		}
	});
});

// 쇼핑몰 관리 > 판매경로 관리 > 판매경로 추가 버튼 클릭
$(document).on("click", "#add_sales_store_btn", function(){
	$("#list_sales_store").hide();
	$("#add_sales_store").show();
});

// 쇼핑몰 관리 > 판매경로 관리 > 판매경로 목록 버튼 클릭
$(document).on("click", "#list_sales_store_btn", function(){
	$("#add_sales_store").hide();
	$("#list_sales_store").show();
});

// 전체 판매경로 리스트 생성
function show_sales_store_list(id)
{
	$.ajax({
		type   : "POST",
		async  : false,
		url    : "admin_exec.php",
		data:{
			"exec"	: "show_sales_store_list",
			"target"	: id
		},
		success: function(response){
			$("#"+id).html(response);
		}
	});
}

// 판매경로 정보 update
$(document).on("click", "#submit_btn10", function(){
	var idx							= $("#idx").val();
	var sales_store_name		= $("#sales_store_name").val();
	var sales_store_media		= $("#sales_store_media").val();
	var sales_store_desc		= $("#sales_store_desc").val();

	if (sales_store_name == "")
	{
		alert("판매경로 명을 입력해주세요.");
		$("#sales_store_name").focus();
		return false;
	}

	$.ajax({
		type   : "POST",
		async  : false,
		url    : "admin_exec.php",
		data:{
			"exec"						: "update_sales_store_info",
			"idx"						: idx,
			"sales_store_name"		: sales_store_name,
			"sales_store_media"	: sales_store_media,
			"sales_store_desc"		: sales_store_desc
		},
		success: function(response){
			if (response == "Y")
			{
				alert("판매경로 정보가 수정되었습니다.");
				location.reload();
			}else{
				alert("다시 시도해 주세요.");
				location.reload();
			}
		}
	});
});

// *********************** 관리자 로그인 *********************** //

// 관리자 로그인 정보 체크
$(document).on("click", ".loginSubmit", function(){
	var admin_id	= $("#admin_id").val();
	var admin_pw	= $("#admin_pw").val();

	if (admin_id == "")
	{
		alert("관리자 아이디를 입력해 주세요.");
		$("#admin_id").focus();
		return false;
	}

	if (admin_pw == "")
	{
		alert("관리자 비밀번호를 입력해 주세요.");
		$("#admin_pw").focus();
		return false;
	}

	$.ajax({
		type   : "POST",
		async  : false,
		url    : "admin_exec.php",
		data:{
			"exec"			: "login_admin",
			"admin_id"		: admin_id,
			"admin_pw"	: admin_pw
		},
		success: function(response){
			if (response == "Y")
			{
				location.href	= "../pages/index.php";
			}else{
				alert("아이디 혹은 비밀번호가 틀리셨습니다. 다시 입력해 주세요.");
				return false;
			}
		}
	});
});

// 관리자 생성 정보 체크
$(document).on("click", ".JoinSubmit", function(){
	var admin_id		= $("#admin_id").val();
	var admin_pw		= $("#admin_pw").val();
	var admin_name	= $("#admin_name").val();

	if (admin_id == "")
	{
		alert("관리자 아이디를 입력해 주세요.");
		$("#admin_id").focus();
		return false;
	}

	if (admin_pw == "")
	{
		alert("관리자 비밀번호를 입력해 주세요.");
		$("#admin_pw").focus();
		return false;
	}

	if (admin_name == "")
	{
		alert("관리자 이름을 입력해 주세요.");
		$("#admin_name").focus();
		return false;
	}

	$.ajax({
		type   : "POST",
		async  : false,
		url    : "admin_exec.php",
		data:{
			"exec"			: "join_admin",
			"admin_id"		: admin_id,
			"admin_pw"	: admin_pw,
			"admin_name"	: admin_name
		},
		success: function(response){
			if (response == "Y")
			{
				location.href	= "../pages/login.php";
			}else if (response == "D"){
				alert("이미 동일한 아이디가 있습니다. 다른 아이디로 입력해 주세요.");
				return false;
			}else{
				alert("아이디 혹은 비밀번호가 틀리셨습니다. 다시 입력해 주세요.");
				return false;
			}
		}
	});

});

// *********************** 배너 설정 *********************** //

// 배너 정보 insert
$(document).on("click", "#submit_btn7", function(){
	var banner_name				= $("#banner_name").val();
	var device_type				= $("#device_type").val();
	var banner_type				= $("#banner_type").val();
	var banner_value			= $("#banner_value").val();
	var banner_showYN			= $("#banner_showYN").val();
	var banner_show_order		= $("#banner_show_order").val();
	var banner_link_target		= $("#banner_link_target").val();
	var inputFile  = $("#filer_input").val();

	if (banner_name == "")
	{
		alert("배너 설명을 넣어주세요.");
		$("#banner_name").focus();
		return false;
	}
	
	if (device_type == "")
	{
		alert("디바이스 타입을 넣어주세요.");
		$("#device_type").focus();
		return false;
	}

	if (banner_type == "")
	{
		alert("배너 타입을 선택해주세요.");
		$("#banner_type").focus();
		return false;
	}
	
	if (inputFile == "") {
		alert("배너 이미지를 넣어주세요.");
		return false;
	}

	if (banner_value == "")
	{
		alert("배너 링크를 입력해주세요.");
		$("#banner_value").focus();
		return false;
	}
	
	if (banner_show_order == "")
	{
		alert("배너 순서를 입력해주세요.");
		$("#banner_show_order").focus();
		return false;
	}


	$.ajax({
		type   : "POST",
		async  : false,
		url    : "admin_exec.php",
		data:{
			"exec"							: "insert_banner_info",
			"banner_name"				: banner_name,
			"device_type"				: device_type,
			"banner_type"				: banner_type,
			"banner_value"				: banner_value,
			"banner_showYN"			: banner_showYN,
			"banner_show_order"		: banner_show_order,
			"banner_link_target"		: banner_link_target
		},
		success: function(response){
			if (response == "0")
			{
				alert("다시 시도해 주세요.");
				location.reload();
			}else{
				alert("배너 정보가 입력 되었습니다.");
				img_submit3(response);
				location.reload();
			}
		}
	});
});

// 배너 정보 update
$(document).on("click", "#submit_btn19", function(){
	var banner_name				= $("#banner_name").val();
	var device_type				= $("#device_type").val();
	var banner_type				= $("#banner_type").val();
	var banner_value			= $("#banner_value").val();
	var banner_showYN			= $("#banner_showYN").val();
	var banner_show_order		= $("#banner_show_order").val();
	var banner_link_target		= $("#banner_link_target").val();
	var inputFile  = $("#filer_input").val();
	

	if (banner_name == "")
	{
		alert("배너 설명을 넣어주세요.");
		$("#banner_name").focus();
		return false;
	}

	if (device_type == "")
	{
		alert("디바이스 타입을 넣어주세요.");
		$("#device_type").focus();
		return false;
	}

	if (banner_type == "")
	{
		alert("배너 타입을 선택해주세요.");
		$("#banner_type").focus();
		return false;
	}

	if (banner_value == "")
	{
		alert("배너 링크를 입력해주세요.");
		$("#banner_value").focus();
		return false;
	}

	if (banner_show_order == "")
	{
		alert("배너 순서를 입력해주세요.");
		$("#banner_show_order").focus();
		return false;
	}


	$.ajax({
		type   : "POST",
		async  : false,
		url    : "admin_exec.php",
		data:{
			"exec"							: "update_banner_info",
			"idx"						: idx,
			"banner_name"				: banner_name,
			"device_type"				: device_type,
			"banner_type"				: banner_type,
			"banner_value"				: banner_value,
			"banner_showYN"			: banner_showYN,
			"banner_show_order"		: banner_show_order,
			"banner_link_target"		: banner_link_target
		},
		success: function(response){
			if (response == "0")
			{
				alert("다시 시도해 주세요.");
				location.reload();
			}else{
				alert("배너 정보가 수정 되었습니다.");
				if(inputFile != '') {
					img_submit3(response);
				}
				location.reload();
			}
		}
	});
});

// 전체 거래처 리스트 생성
function show_banner_list(id)
{
	$.ajax({
		type   : "POST",
		async  : false,
		url    : "admin_exec.php",
		data:{
			"exec"	: "show_banner_list",
			"target"	: id
		},
		success: function(response){
			$("#"+id).html(response);
		}
	});
}

// 쇼핑몰 관리 > 배너 관리 > 배너 추가 버튼 클릭
$(document).on("click", "#add_banner_btn", function(){
	$("#list_banner").hide();
	$("#add_banner").show();
});

// 쇼핑몰 관리 > 배너 관리 > 배너 목록 버튼 클릭
$(document).on("click", "#list_banner_btn", function(){
	$("#add_banner").hide();
	$("#list_banner").show();
});

// *********************** 쇼핑몰 기본 설정 *********************** //

// 배너 정보 insert
$(document).on("click", "#submit_btn8", function(){
	if (confirm("쇼핑몰 기본설정을 수정하시겠습니까?"))
	{
		var best_goods_flag				= $(':radio[name="best_goods_flag"]:checked').val();
		var new_goods_flag				= $(':radio[name="new_goods_flag"]:checked').val();
		var plan_goods_flag				= $(':radio[name="plan_goods_flag"]:checked').val();
		var cate_goods_flag				= $(':radio[name="cate_goods_flag"]:checked').val();
		var best_goods_flagYN			= $("#best_goods_flagYN").val();
		var new_goods_flagYN			= $("#new_goods_flagYN").val();
		var plan_goods_flagYN			= $("#plan_goods_flagYN").val();
		var cate_goods_flagYN			= $("#cate_goods_flagYN").val();
		var default_saved_priceYN		= $("#default_saved_priceYN").val();
		var default_saved_price			= $("#default_saved_price").val();
		var default_delivery_priceYN	= $("#default_delivery_priceYN").val();
		var default_delivery_price		= $("#default_delivery_price").val();

		$.ajax({
			type   : "POST",
			async  : false,
			url    : "admin_exec.php",
			data:{
				"exec"							: "update_option_info",
				"best_goods_flag"				: best_goods_flag,
				"new_goods_flag"				: new_goods_flag,
				"plan_goods_flag"				: plan_goods_flag,
				"cate_goods_flag"				: cate_goods_flag,
				"best_goods_flagYN"				: best_goods_flagYN,
				"new_goods_flagYN"				: new_goods_flagYN,
				"plan_goods_flagYN"				: plan_goods_flagYN,
				"cate_goods_flagYN"				: cate_goods_flagYN,
				"default_saved_priceYN"			: default_saved_priceYN,
				"default_saved_price"			: default_saved_price,
				"default_delivery_priceYN"		: default_delivery_priceYN,
				"default_delivery_price"		: default_delivery_price
			},
			success: function(response){
				if (response == "Y")
				{
					alert("사이트 기본 설정이 수정되었습니다.");
					location.reload();
				}else{
					alert("다시 시도해 주세요.");
					location.reload();
				}
			}
		});
	}
});