<?
	include_once "header.php";

	// 거래처 정보 SELECT
	$purchasing_info	= select_purchasing_info($_REQUEST['idx']);
?>
<body>
<input type="hidden" id="idx" value="<?=$_REQUEST['idx']?>">
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
          <h1 class="page-header">거래처 정보 수정</h1>
        </div>
        <!-- /.col-lg-12 -->
      </div>
      <!-- /.row -->
      <!-- /.panel-heading -->
      <div class="panel-body">
        <div class="panel-body">
          <div class="table-responsive" id="add_purchasing">
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th>타이틀</th>
                  <th>내용</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>* 거래처명</td>
                  <td colspan="2">
                    <input class="form-control" id="purchasing_name" style="width:100%" value="<?=$purchasing_info['purchasing_name']?>">
                  </td>
                </tr>
                <tr>
                  <td>거래처 주소</td>
                  <td>
                    <input class="form-control" id="purchasing_addr" style="width:100%" value="<?=$purchasing_info['purchasing_addr']?>">
                  </td>
                </tr>
                <tr>
                  <td>* 거래처 전화번호</td>
                  <td>
                    <input class="form-control" id="purchasing_phone" style="width:100%" value="<?=$purchasing_info['purchasing_phone']?>">
                  </td>
                </tr>
                <tr>
                  <td>거래처 특이사항</td>
                  <td>
                    <textarea class="form-control" id="purchasing_desc" rows="3" style="width:100%"><?=$purchasing_info['purchasing_desc']?></textarea>
                  </td>
                </tr>
              </tbody>
            </table>
            <button type="button" class="btn btn-danger btn-lg btn-block" id="submit_btn6">거래처 정보 수정</button>
          </div>
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

</body>

</html>
