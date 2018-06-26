<?
	include_once "header.php";
?>
<link href="../../lib/filer/css/jquery.filer.css" type="text/css" rel="stylesheet" />
<link href="../../lib/filer/css/themes/jquery.filer-dragdropbox-theme.css" type="text/css" rel="stylesheet" />
<body>

<div id="wrapper">
  <!-- Navigation -->
  <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">쇼핑몰 관리자</a>
    </div>
  <!-- /.navbar-header -->

<?
	include_once "top_navi.php";
	include_once "side_navi.php";
?>
</div>
<!-- /.navbar-static-side -->
  </nav>

  <!-- Page Content -->
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">카테고리 관리</h1>
        </div>
        <!-- /.col-lg-12 -->
      </div>
      <!-- /.row -->
      <!-- /.panel-heading -->
      <button type="button" class="btn btn-outline btn-primary btn-lg" id="add_category_btn">카테고리 추가</button>
      <button type="button" class="btn btn-outline btn-success btn-lg" id="list_category_btn">카테고리 목록</button>
      <div class="panel-body">
        <div class="panel-body">
          <div class="table-responsive" id="add_category">
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th>타이틀</th>
                  <th>내용</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>카테고리명</td>
                  <td colspan="2">
                    <input type="text" id="cate_name">
                  </td>
                </tr>
                <tr>
                  <td>카테고리 이미지</td>
                  <td colspan="2">
                    <form action="../../lib/filer/php/upload.php" id="main_image_frm" method="post" enctype="multipart/form-data">
                      <input type="file" name="files[]" id="filer_input" multiple="multiple">
                    </form>
                    <input class="form-control" id="banner_value" placeholder="예시) http://store-chon.com/event/event_list1.php" style="width:90%"> 
                  </td>
                </tr>
                <tr>
                  <td>1차 카테고리</td>
                  <td id="cate1_sel_td" style="display:none;">
                    <select id="cate_1">
                      <option value="">선택하세요</option>
                      <option value=""></option>
                    </select> *1차 카테고리를 선택하지 않으면 1차 카테고리에 저장이 됩니다.
                  </td>
                  <td id="cate1_btn_td">
                    <a href="#">추가</a>
                  </td>
                </tr>
                <!-- <tr>
                  <td>2차 카테고리</td>
                  <td id="cate2_sel_td" style="display:none;">
                    <select id="cate_2">
                      <option value="">선택하세요</option>
                      <option value=""></option>
                    </select> *2차 카테고리를 선택하지 않으면 2차 카테고리에 저장이 됩니다.
                  </td>
                  <td id="cate2_btn_td">
                    <a href="#">추가</a>
                  </td>
                </tr>
                <tr>
                  <td>3차 카테고리</td>
                  <td id="cate3_sel_td" style="display:none;">
                    <select id="cate_3">
                      <option value="">선택하세요</option>
                      <option value=""></option>
                    </select> *3차 카테고리를 선택하지 않으면 3차 카테고리에 저장이 됩니다.
                  </td>
                  <td id="cate3_btn_td">
                    <a href="#">추가</a>
                  </td>
                </tr> -->
                <tr>
                  <td>PC쇼핑몰 노출여부</td>
                  <td>
                    <input type="radio" name="cate_pcYN" value="Y">노출함
                    <input type="radio" name="cate_pcYN" value="N" checked>노출 안함
                  </td>
                </tr>
                <tr>
                  <td>모바일 쇼핑몰 노출여부</td>
                  <td>
                    <input type="radio" name="cate_mobileYN" value="Y">노출함
                    <input type="radio" name="cate_mobileYN" value="N" checked>노출 안함
                  </td>
                </tr>
                <tr>
                  <td>접근 권한</td>
                  <td>
                    <input type="radio" name="cate_accessYN" value="ALL">전체(회원 + 비회원)
                    <input type="radio" name="cate_accessYN" value="MEMBER" checked>회원전용(비회원 제외)
                    <input type="radio" name="cate_accessYN" value="SPECIFIC">특정 회원등급
                    <select id="access_specific">
                      <option value="">선택하세요</option>
                    </select>
                  </td>
                </tr>
              </tbody>
            </table>
            <button type="button" class="btn btn-danger btn-lg btn-block" id="submit_btn">완 료</button>
          </div>
          <!-- /.table-responsive -->
          <div class="table-responsive" id="list_category" style="display:none;">
            <table width="100%" class="table table-striped table-bordered table-hover" id="category_list">
            </table>
          </div>
          <!-- /.table-responsive -->
        </div>
      </div>
      <!-- /.panel-body -->
    </div>
    <!-- /.container-fluid -->
  </div>
  <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->

<?
	include_once "lib.php";
?>
	<!-- DataTables JavaScript -->
	<script src="../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
	<script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
	<script src="../bower_components/datatables-responsive/js/dataTables.responsive.js"></script>

	<script src="../../lib/filer/js/jquery.filer.min.js"></script>
	<!-- Page-Level Demo Scripts - Tables - Use for reference -->
	<script>
	$('#filer_input').filer({
		showThumbs: true,
		templates: {
			box: '<ul class="jFiler-items-list jFiler-items-grid"></ul>',
			item: '<li class="jFiler-item">\
						<div class="jFiler-item-container">\
							<div class="jFiler-item-inner">\
								<div class="jFiler-item-thumb">\
									<div class="jFiler-item-status"></div>\
									<div class="jFiler-item-info">\
										<span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
										<span class="jFiler-item-others">{{fi-size2}}</span>\
									</div>\
									{{fi-image}}\
								</div>\
								<div class="jFiler-item-assets jFiler-row">\
									<ul class="list-inline pull-left"></ul>\
									<ul class="list-inline pull-right">\
										<li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
									</ul>\
								</div>\
							</div>\
						</div>\
					</li>',
			itemAppend: '<li class="jFiler-item">\
							<div class="jFiler-item-container">\
								<div class="jFiler-item-inner">\
									<div class="jFiler-item-thumb">\
										<div class="jFiler-item-status"></div>\
										<div class="jFiler-item-info">\
											<span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
											<span class="jFiler-item-others">{{fi-size2}}</span>\
										</div>\
										{{fi-image}}\
									</div>\
									<div class="jFiler-item-assets jFiler-row">\
										<ul class="list-inline pull-left">\
											<li><span class="jFiler-item-others">{{fi-icon}}</span></li>\
										</ul>\
										<ul class="list-inline pull-right">\
											<li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
										</ul>\
									</div>\
								</div>\
							</div>\
						</li>',
			itemAppendToEnd: false,
			removeConfirmation: true,
			_selectors: {
				list: '.jFiler-items-list',
				item: '.jFiler-item',
				remove: '.jFiler-item-trash-action'
			}
		},
		addMore: false
	});


	$(document).ready(function() {
		// 회원 등급 셀렉트박스
		show_select_grade("access_specific");
		// 1번 카테고리 정보
		show_select_cate1("cate_1");
		// 카테고리 리스트
		show_category_list("category_list");

		// 테이블 api 세팅 
		var table	= $('#category_list').DataTable({
			"columnDefs": [ {
				"searchable": false,
				"orderable": false,
				"targets": 0
			} ],
			"order": [[ 1, 'asc' ]],
			"ordering":false,
			"searching": true
		});
	});

	</script>

</body>

</html>
