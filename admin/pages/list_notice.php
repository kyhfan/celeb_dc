<?
	include_once "header.php";

	if(isset($_REQUEST['pg']) == false)
		$pg = "1";
	else
		$pg = $_REQUEST['pg'];

	if (!$pg) {
		$pg = "1";
	}
	//if(isset($pg) == false) $pg = 1;  // $pg가 없으면 1로 생성
	$page_size = 10;  // 한 페이지에 나타날 개수
	$block_size = 10; // 한 화면에 나타낼 페이지 번호 개수
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
  .center_btn {
    text-align:center;
  }
  .center_btn > a {
    display:inline-block;
    width:120px;height:40px;
    line-height:40px;
    color: #000;
    font-weight: bold;
    background-color: #fff;
    border: 2px solid #000;
    margin-bottom: 40px;
    border-radius: 4px;
  }
</style>
<body>
  <form name="frm_execute" method="POST" onsubmit="return checkfrm()">
    <input type="hidden" name="pg" value="<?=$pg?>">
  </form>

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
    </nav>
    <!-- /.navbar-static-side ?????????????????????????????? --> 
  </div>

  <!-- Page Content -->
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">공지사항 리스트</h1>
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
            <table width="100%" class="table table-striped table-bordered table-hover" id="notice_list">
            </table>
            <div class="center_btn">
              <a href="./write_notice.php">작성하기</a>
            </div>
          </div>
          <!-- /.table-responsive 
        </div>
        <!-- /.panel-body -->
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
    show_notice_list("notice_list");

    // 테이블 api 세팅
    var table   = $('#notice_list').DataTable({
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

  function show_notice_list(id)
  {
    $.ajax({
      type   : "POST",
      async  : false,
      url    : "admin_exec.php",
      data:{
        "exec"  : "show_notice_list",
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