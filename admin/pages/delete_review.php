<?
	include_once "header.php";

	$idx = $_GET['idx'];

	$s_query = "SELECT * FROM ".$_gl['board_review_table']." WHERE idx='".$idx."'";
	$result = @mysqli_query($my_db, $s_query);
	$data = @mysqli_fetch_array($result);

?>
<body>
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
  <div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">리뷰 삭제</h1>
      </div>
      <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="row">
              <form method="post" id="modify_form" role="form">
                <div class="col-lg-12">
                  <div class="form-group">
                    <label class="col-sm-2">글이 삭제됩니다.</label>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group" style="text-align:center;">
                      <input class="form-control" type="button" id="delete_rev" value="삭제">
                      <input class="form-control" type="button" onclick="history.back();" value="취소">
                    </div>
                  </div>
                  <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
              </form>
            </div>
            <!-- /.row (nested) -->
          </div>
          <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
      </div>
      <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="../dist/js/sb-admin-2.js"></script>

<!-- Naver SmartEditor -->
<script type="text/javascript" src="../../lib/smarteditor/js/HuskyEZCreator.js" charset="utf-8"></script>

</body>
</html>
<script>
	$('#delete_rev').on('click', function(){
		$.ajax({
			method: 'POST',
			url: './admin_exec.php',
			data: {
				exec        : "delete_review",
				idx         : <?=$data['idx']?>,
				user_id     : <?=$data['user_id']?>,
				group_id    : <?=$data['group_id']?>
			},
			success: function(res){
				if(res == "Y")
				{
					alert("리뷰가 삭제되었습니다.");
					location.href="list_review.php";
				}else{
					alert("리뷰 삭제 실패");
					location.reload();
				}
			}
		})
	});
</script>