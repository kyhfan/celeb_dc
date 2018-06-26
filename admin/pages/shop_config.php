<?
	include_once "header.php";

	// 쇼핑몰 기본 설정 SELECT
	$shop_info	= select_shop_config_info();
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
<!-- /.navbar-static-side -->
  </nav>

  <!-- Page Content -->
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">쇼핑몰 기본 설정</h1>
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
                  <th>사용여부</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>베스트 상품 노출 방식</td>
                  <td>
                    <input type="radio" name="best_goods_flag" value="auto" <?if ($shop_info['best_goods_flag'][0]=="auto"){?>checked<?}?>>자동 ( 판매순 )
                    <input type="radio" name="best_goods_flag" value="manual" <?if ($shop_info['best_goods_flag'][0]=="manual"){?>checked<?}?>>수동 ( 관리자 임의 설정 )
                  </td>
                  <td>
                    <select id="best_goods_flagYN">
                      <option value="Y" <?if ($shop_info['best_goods_flag'][1]=="Y"){?>selected<?}?>>사용</option>
                      <option value="N" <?if ($shop_info['best_goods_flag'][1]=="N"){?>selected<?}?>>미사용</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>신 상품 노출 방식</td>
                  <td>
                    <input type="radio" name="new_goods_flag" value="auto" <?if ($shop_info['new_goods_flag'][0]=="auto"){?>checked<?}?>>자동 ( 등록일순 )
                    <input type="radio" name="new_goods_flag" value="manual" <?if ($shop_info['new_goods_flag'][0]=="manual"){?>checked<?}?>>수동 ( 관리자 임의 설정 )
                  </td>
                  <td>
                    <select id="new_goods_flagYN">
                      <option value="Y" <?if ($shop_info['new_goods_flag'][1]=="Y"){?>selected<?}?>>사용</option>
                      <option value="N" <?if ($shop_info['new_goods_flag'][1]=="N"){?>selected<?}?>>미사용</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>기획 상품 노출 방식</td>
                  <td>
                    <input type="radio" name="plan_goods_flag" value="auto" <?if ($shop_info['plan_goods_flag'][0]=="auto"){?>checked<?}?>>자동 ( 등록일순 )
                    <input type="radio" name="plan_goods_flag" value="manual" <?if ($shop_info['plan_goods_flag'][0]=="manual"){?>checked<?}?>>수동 ( 관리자 임의 설정 )
                  </td>
                  <td>
                    <select id="plan_goods_flagYN">
                      <option value="Y" <?if ($shop_info['plan_goods_flag'][1]=="Y"){?>selected<?}?>>사용</option>
                      <option value="N" <?if ($shop_info['plan_goods_flag'][1]=="N"){?>selected<?}?>>미사용</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>카테고리 베스트 상품 노출 방식</td>
                  <td>
                    <input type="radio" name="cate_goods_flag" value="auto" <?if ($shop_info['cate_goods_flag'][0]=="auto"){?>checked<?}?>>자동 ( 판매순 )
                    <input type="radio" name="cate_goods_flag" value="manual" <?if ($shop_info['cate_goods_flag'][0]=="manual"){?>checked<?}?>>수동 ( 관리자 임의 설정 )
                  </td>
                  <td>
                    <select id="cate_goods_flagYN">
                      <option value="Y" <?if ($shop_info['cate_goods_flag'][1]=="Y"){?>selected<?}?>>사용</option>
                      <option value="N" <?if ($shop_info['cate_goods_flag'][1]=="N"){?>selected<?}?>>미사용</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>기본 적립금</td>
                  <td>
                    <input type="text" id="default_saved_price" value="<?=$shop_info['default_saved_price'][0]?>"> 원
                  </td>
                  <td>
                    <select id="default_saved_priceYN">
                      <option value="Y" <?if ($shop_info['default_saved_price'][1]=="Y"){?>selected<?}?>>사용</option>
                      <option value="N" <?if ($shop_info['default_saved_price'][1]=="N"){?>selected<?}?>>미사용</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>기본 배송비</td>
                  <td>
                    <input type="text" id="default_delivery_price" value="<?=$shop_info['default_delivery_price'][0]?>"> 원
                  </td>
                  <td>
                    <select id="default_saved_priceYN">
                      <option value="Y" <?if ($shop_info['default_delivery_price'][1]=="Y"){?>selected<?}?>>사용</option>
                      <option value="N" <?if ($shop_info['default_delivery_price'][1]=="N"){?>selected<?}?>>미사용</option>
                    </select>
                  </td>
                </tr>
              </tbody>
            </table>
            <button type="button" class="btn btn-danger btn-lg btn-block" id="submit_btn8">수 정</button>
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
		// 카테고리 리스트
		show_category_list("category_list");

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
	});

	</script>

</body>

</html>
