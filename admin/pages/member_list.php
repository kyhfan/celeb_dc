<?
	include_once "header.php";
?>
<link href="../../lib/filer/css/jquery.filer.css" type="text/css" rel="stylesheet" />
<link href="../../lib/filer/css/themes/jquery.filer-dragdropbox-theme.css" type="text/css" rel="stylesheet" />
<style>
  a {
    text-decoration: none;
    color: #000;
    }
  a:hover {
      text-decoration: none;
      color: #000;
  }
</style>
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
          <h1 class="page-header">회원 리스트</h1>
        </div>
        <!-- /.col-lg-12 -->
      </div>
      <!-- /.row -->
      <!-- /.panel-heading -->
      <!-- <button type="button" class="btn btn-outline btn-primary btn-lg" id="add_category_btn">카테고리 추가</button>
      <button type="button" class="btn btn-outline btn-success btn-lg" id="list_category_btn">카테고리 목록</button> -->
      <div class="panel-body">
        <div class="panel-body">
          <!-- /.table-responsive -->
          <div class="table-responsive">
            <table width="100%" class="table table-striped table-bordered table-hover" id="member_list">
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
<script type="text/javascript" src="../../lib/smarteditor/js/HuskyEZCreator.js" charset="utf-8"></script>

<script src="../../lib/filer/js/jquery.filer.min.js"></script>
<script>
	var goods_code = null;
	$(document).ready(function() {
		// 멤버 리스트
		show_member_list("member_list");

		// 테이블 api 세팅 
		var table   = $('#member_list').DataTable({
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
			table.column(1, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
				cell.innerHTML = i+1;
			} );
		} ).draw();


	});

	function show_member_list(id)
	{
		$.ajax({
			type   : "POST",
			async  : false,
			url    : "admin_exec.php",
			data:{
				"exec"  : "show_member_list",
				"target"  : id
			},
			success: function(response){
				$("#"+id).html(response);
			}
		});
	}

</script>

</body>

</html>
