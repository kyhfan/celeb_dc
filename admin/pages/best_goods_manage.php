<?
	include_once "header.php";
?>
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
          <h1 class="page-header">베스트 상품 관리</h1>
        </div>
        <!-- /.col-lg-12 -->
      </div>
      <!-- /.row -->
      <!-- /.panel-heading -->
      <button type="button" class="btn btn-outline btn-primary btn-lg" id="add_best_goods_btn">베스트 상품 추가</button>
      <button type="button" class="btn btn-outline btn-success btn-lg" id="list_best_goods_btn">베스트 상품 목록</button>
      <div class="panel-body">
        <div class="panel-body">
          <div class="table-responsive" id="add_best_goods">
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th>타이틀</th>
                  <th>내용</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>상품코드</td>
                  <td>
                    <input class="form-control" id="goods_code" style="width:100%">
                  </td>
                </tr>
                <tr>
                  <td>노출 순서</td>
                  <td>
                    <input class="form-control" id="goods_sequence" style="width:100%">
                  </td>
                </tr>
              </tbody>
            </table>
            <button type="button" class="btn btn-danger btn-lg btn-block" id="submit_btn16">베스트 상품 정보 입력</button>
          </div>
          <!-- /.table-responsive -->
          <div class="table-responsive" id="list_best_goods" style="display:none;">
            <table width="100%" class="table table-striped table-bordered table-hover" id="best_goods_list">
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
		// 1번 카테고리 정보
		show_select_cate1("cate_1");
		// 카테고리 리스트
		show_best_goods_list("best_goods_list");

		// 테이블 api 세팅 
		var table	= $('#best_goods_list').DataTable({
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
