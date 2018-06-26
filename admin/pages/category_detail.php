<?
	include_once "header.php";
	// 카테고리 정보 SELECT
	$category_info	= select_category_info($_REQUEST['idx']);
?>
<body>
<input type="hidden" id="idx" value="<?=$_REQUEST['idx']?>">
<input type="hidden" id="cate1_val" value="<?=$category_info['cate_1']?>">
<input type="hidden" id="cate2_val" value="<?=$category_info['cate_2']?>">
<input type="hidden" id="cate3_val" value="<?=$category_info['cate_3']?>">

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
          <h1 class="page-header">카테고리 수정</h1>
        </div>
        <!-- /.col-lg-12 -->
      </div>
      <!-- /.row -->
      <!-- /.panel-heading -->
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
                    <input type="text" id="cate_name" value="<?=$category_info['cate_name']?>">
                  </td>
                </tr>
                <tr>
                  <td>1차 카테고리</td>
<?
	if ($category_info['cate_1'] != "0")
	{
?>
                  <td id="cate1_sel_td">
                    <select id="cate_1">
                      <option value="">선택하세요</option>
                      <option value=""></option>
                    </select> *1차 카테고리를 선택하지 않으면 1차 카테고리에 저장이 됩니다.
                  </td>
<?
	}else{
?>
                  <td id="cate1_btn_td">
                    <a href="#">추가</a>
                  </td>
<?
	}
?>
                </tr>
                <tr>
                  <td>2차 카테고리</td>
<?
	if ($category_info['cate_2'] != "0")
	{
?>
                  <td id="cate2_sel_td">
                    <select id="cate_2">
                      <option value="">선택하세요</option>
                      <option value=""></option>
                    </select> *2차 카테고리를 선택하지 않으면 2차 카테고리에 저장이 됩니다.
                  </td>
<?
	}else{
?>
                  <td id="cate2_btn_td">
                    <a href="#">추가</a>
                  </td>
<?
	}
?>
                </tr>
                <tr>
                  <td>3차 카테고리</td>
<?
	if ($category_info['cate_3'] != "0")
	{
?>
                  <td id="cate3_sel_td">
                    <select id="cate_3">
                      <option value="">선택하세요</option>
                      <option value=""></option>
                    </select> *3차 카테고리를 선택하지 않으면 3차 카테고리에 저장이 됩니다.
                  </td>
<?
	}else{
?>
                  <td id="cate3_btn_td">
                    <a href="#">추가</a>
                  </td>
<?
	}
?>
                </tr>
                <tr>
                  <td>PC쇼핑몰 노출여부</td>
                  <td>
                    <input type="radio" name="cate_pcYN" value="Y" <?if ($category_info['cate_pcYN']=="Y"){?>checked<?}?>>노출함
                    <input type="radio" name="cate_pcYN" value="N" <?if ($category_info['cate_pcYN']=="N"){?>checked<?}?>>노출 안함
                  </td>
                </tr>
                <tr>
                  <td>모바일 쇼핑몰 노출여부</td>
                  <td>
                    <input type="radio" name="cate_mobileYN" value="Y" <?if ($category_info['cate_mobileYN']=="Y"){?>checked<?}?>>노출함
                    <input type="radio" name="cate_mobileYN" value="N" <?if ($category_info['cate_mobileYN']=="N"){?>checked<?}?>>노출 안함
                  </td>
                </tr>
                <tr>
                  <td>접근 권한</td>
                  <td>
                    <input type="radio" name="cate_accessYN" value="ALL" <?if ($category_info['cate_accessYN']=="ALL"){?>checked<?}?>>전체(회원 + 비회원)
                    <input type="radio" name="cate_accessYN" value="MEMBER" <?if ($category_info['cate_accessYN']=="MEMBER"){?>checked<?}?>>회원전용(비회원 제외)
                    <input type="radio" name="cate_accessYN" value="SPECIFIC" <?if ($category_info['cate_accessYN']=="SPECIFIC"){?>checked<?}?>>특정 회원등급
                    <select id="access_specific">
                      <option value="">선택하세요</option>
                    </select>
                  </td>
                </tr>
              </tbody>
            </table>
            <button type="button" class="btn btn-danger btn-lg btn-block" id="submit_btn4">수 정</button>
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

	<!-- Page-Level Demo Scripts - Tables - Use for reference -->
	<script>
	$(document).ready(function() {
		// 회원 등급 셀렉트박스
		show_select_grade("access_specific");
		// 1번 카테고리 정보
		show_select_cate1("cate_1");
		// 세팅된 카테고리 노출
		selected_category("cate_1",$("#cate1_val").val(),$("#cate2_val").val(),$("#cate3_val").val());

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
		table.on( 'order.dt search.dt', function () {
			table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
				cell.innerHTML = i+1;
			} );
		} ).draw();
	});

	</script>

</body>

</html>
