<?
	include_once "header.php";
	$idx = $_REQUEST['idx'];

	$hit_query = "UPDATE ".$_gl['board_notice_table']." SET hit=hit+1 WHERE idx='".$idx."'";
	$result = mysqli_query($my_db, $hit_query); 

	$read_query = "SELECT * FROM ".$_gl['board_notice_table']." WHERE idx='".$idx."'";
	$result = mysqli_query($my_db, $read_query);
	$data = mysqli_fetch_array($result);

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
  <div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">공지사항 읽기</h1>
      </div>
      <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="row">
              <div class="col-lg-12">
                <table class="table">
                  <tr class="active">
                    <td colspan="8" align="center" style="font-size:20px;"><?=$data['subject']?></td>
                  </tr>
                  <tr>
                    <td>아이디</td>
                    <td><b><?=$data['user_id']?></b></td>
                    <td>제목</td>
                    <td><b><?=$data['subject']?></b></td>
                    <td>작성일시</td>
                    <td><b><?=$data['date']?></b></td>
                    <td>노출여부</td>
                    <td><b><?=$data['showYN']?></b></td>
                  </tr>
                  <tr>
                    <td colspan="8"><?=$data['content']?></td>
                  </tr>
                </table>
              </div>
              <div class="row">
                <div class="col-lg-12">
                  <div class="form-group" style="text-align:center;">
                    <input class="form-control" type="button" onclick="go_page('list');" value="목록">
                    <input class="form-control" type="button" onclick="go_page('edit');" value="수정">
                    <input class="form-control" type="button" onclick="go_page('delete');" value="삭제">
                  </div>
                </div>
              </div>
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
<script type="text/javascript">

  function go_page(action) {
    switch (action) {
      case "list":
        location.href="list_notice.php";
        break;
      case "reply":
        location.href="reply_notice.php?idx=<?=$idx?>";
        break;
      case "edit":
        location.href="edit_notice.php?idx=<?=$idx?>";
        break;
      case "delete":
        location.href="delete_notice.php?idx=<?=$idx?>";
        break;
    }
  }

</script>

</body>

</html>
