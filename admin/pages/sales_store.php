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
          <h1 class="page-header">판매경로 관리</h1>
        </div>
        <!-- /.col-lg-12 -->
      </div>
      <!-- /.row -->
      <!-- /.panel-heading -->
      <button type="button" class="btn btn-outline btn-primary btn-lg" id="add_sales_store_btn">판매경로 추가</button>
      <button type="button" class="btn btn-outline btn-success btn-lg" id="list_sales_store_btn">판매경로 목록</button>
      <div class="panel-body">
        <div class="panel-body">
          <div class="table-responsive" id="add_sales_store">
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th>타이틀</th>
                  <th>내용</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>* 판매경로 명</td>
                  <td colspan="2">
                    <input class="form-control" id="sales_store_name" style="width:100%">
                  </td>
                </tr>
                <tr>
                  <td>매체명</td>
                  <td>
                    <input class="form-control" id="sales_store_media" style="width:100%" placeholder="ex ) 인스타그램, 페이스북, 블로그 등">
                  </td>
                </tr>
                <tr>
                  <td>판매경로 코드</td>
                  <td>
                    자동 생성
                  </td>
                </tr>
                <tr>
                  <td>판매경로 특이사항</td>
                  <td>
                    <textarea class="form-control" id="sales_store_desc" rows="3" style="width:100%"></textarea>
                  </td>
                </tr>
              </tbody>
            </table>
            <button type="button" class="btn btn-danger btn-lg btn-block" id="submit_btn9">판매경로 정보 입력</button>
          </div>
          <!-- /.table-responsive -->
          <div class="table-responsive" id="list_sales_store" style="display:none;">
            <table width="100%" class="table table-striped table-bordered table-hover" id="sales_store_list">
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
		// 판매경로 리스트
		show_sales_store_list("sales_store_list");

		// 테이블 api 세팅 
		var table	= $('#purchasing_list').DataTable({
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
