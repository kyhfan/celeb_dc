<?
	include_once "header.php";
	// 이벤트 정보 SELECT
	$event_info	= select_event_info($_REQUEST['idx']);
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
          <h1 class="page-header">이벤트 수정</h1>
        </div>
        <!-- /.col-lg-12 -->
      </div>
      <!-- /.row -->
      <!-- /.panel-heading -->
      <div class="panel-body">
        <div class="panel-body">
          <div class="table-responsive" id="add_event">
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th>타이틀</th>
                  <th>내용</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>이벤트명</td>
                  <td colspan="2">
                    <input class="form-control" id="event_title" style="width:100%" value="<?=$event_info['event_title']?>">
                  </td>
                </tr>
                <tr>
                  <td>이벤트 기간</td>
                  <td colspan="2">
                    <input class="form-control" id="event_startdate" value="<?=substr($event_info['event_startdate'],0,10)?>"> - <input class="form-control" id="event_enddate" value="<?=substr($event_info['event_enddate'],0,10)?>">
                  </td>
                </tr>
                <tr>
                  <td colspan="3"> 내 용 </td>
                </tr>
                <tr>
                  <td colspan="3">
                    <form action="sample.php" method="post">
                      <textarea name="event_contents"  id="event_contents" rows="10" cols="100" style="width:100%; height:412px;"><?=$event_info['event_contents']?></textarea>
                    </form>
                  </td>
                </tr>
              </tbody>
            </table>
            <button type="button" class="btn btn-danger btn-lg btn-block" id="submit_btn13">완 료</button>
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
	<script src="../bower_components/jquery/dist/jquery-ui.js"></script>
	<script type="text/javascript" src="../../lib/smarteditor/js/HuskyEZCreator.js" charset="utf-8"></script>

	<!-- Page-Level Demo Scripts - Tables - Use for reference -->
	<script>
	var oEditors		= [];
	$(document).ready(function() {
		// 테이블 api 세팅 
		var table	= $('#event_list').DataTable({
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

	nhn.husky.EZCreator.createInIFrame({
		oAppRef: oEditors,
		elPlaceHolder: "event_contents",
		sSkinURI: "../../lib/smarteditor/SmartEditor2Skin.html",	
		htParams : {
			bUseToolbar : true,				// 툴바 사용 여부 (true:사용/ false:사용하지 않음)
			bUseVerticalResizer : true,		// 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
			bUseModeChanger : true,			// 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
			//aAdditionalFontList : aAdditionalFontSet,		// 추가 글꼴 목록
			fOnBeforeUnload : function(){
				//alert("완료!");
			}
		}, //boolean
		fOnAppLoad : function(){
			//예제 코드
			//oEditors.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
		},
		fCreator: "createSEditor2"
	});

	$( function() {
		$( "#event_startdate" ).datepicker();
		$( "#event_enddate" ).datepicker();
	});

	</script>

</body>

</html>
