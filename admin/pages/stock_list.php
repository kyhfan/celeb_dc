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
          <h1 class="page-header">재고 관리</h1>
        </div>
        <!-- /.col-lg-12 -->
      </div>
      <!-- /.row -->
      <!-- /.panel-heading -->
      <!-- <button type="button" class="btn btn-outline btn-primary btn-lg" id="edit_stock_info_btn">재고정보 수정</button> -->
      <button type="button" class="btn btn-outline btn-success btn-lg" id="list_stock_info_btn">재고정보 목록</button>
      <div class="panel-body">
        <div class="panel-body">
          <div class="table-responsive" id="edit_stock_info" style="display:none;">
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th>타이틀</th>
                  <th>내용</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>상품코드 선택</td>
                  <td colspan="2">
                    <select class="form-control" id="sel_goodscode">
                      <option value="">선택하세요</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>상품명</td>
                  <td>
                    <input class="form-control" id="stock_name" style="width:100%" readonly>
                  </td>
                </tr>
                <tr>
                  <td>매입수량</td>
                  <td>
                    <input class="form-control" id="stock_cnt"> 개
                  </td>
                </tr>
                <tr>
                  <td>매입금액</td>
                  <td>
                    <input class="form-control" id="stock_price"> 원
                  </td>
                </tr>
                <tr>
                  <td>판매수량</td>
                  <td>
                    <input class="form-control" id="sales_cnt"> 개
                  </td>
                </tr>
                <tr>
                  <td>판매금액</td>
                  <td>
                    <input class="form-control" id="sales_price"> 원
                  </td>
                </tr>
                <tr>
                  <td>재고정보 수정 사유</td>
                  <td>
                    <textarea class="form-control" id="stock_edit_desc" rows="3" style="width:100%"></textarea>
                  </td>
                </tr>
              </tbody>
            </table>
            <button type="button" class="btn btn-danger btn-lg btn-block" id="submit_btn11">재고정보 수정</button>
          </div>

          <!-- /.table-responsive -->
          <div class="table-responsive" id="list_stock_info">
            <table width="100%" class="table table-striped table-bordered table-hover" id="stock_list">
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

	<script>
	$(document).ready(function() {
		// 재고 리스트
		show_stock_list("stock_list");

		// 상품코드 리스트 가져오기 (select)
		show_select_goodscode("sel_goodscode");

		// 테이블 api 세팅 
		var table	= $('#stock_list').DataTable({
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
