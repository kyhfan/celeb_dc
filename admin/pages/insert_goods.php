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
          <h1 class="page-header">상품 등록</h1>
        </div>
        <!-- /.col-lg-12 -->
      </div>
      <!-- /.row -->
      <!-- /.panel-heading -->
      <!-- <button type="button" class="btn btn-outline btn-primary btn-lg" id="add_category_btn">카테고리 추가</button>
      <button type="button" class="btn btn-outline btn-success btn-lg" id="list_category_btn">카테고리 목록</button> -->
      <div class="panel-body">
        <div class="panel-body">
          <div class="table-responsive" id="add_goods">
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th colspan="2" style="background:#dde">표시 설정</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>진열상태</td>
                  <td colspan="2">
                    <input type="radio" name="showYN" value="Y"> 진열함
                    <input type="radio" name="showYN" value="N" checked> 진열안함
                  </td>
                </tr>
                <tr>
                  <td>판매상태</td>
                  <td colspan="2">
                    <input type="radio" name="salesYN" value="Y"> 판매함
                    <input type="radio" name="salesYN" value="N" checked> 판매안함
                  </td>
                </tr>
                <tr>
                  <td>* 상품분류 선택</td>
                  <td>
                    <select class="form-control" id="cate_1">
                      <option value="">선택하세요</option>
                    </select>
                    <select class="form-control" id="cate_2">
                      <option value="">선택하세요</option>
                    </select>
                    <!-- <select class="form-control" id="cate_3">
                      <option value="">선택하세요</option>
                    </select> -->
                  </td>
                </tr>
                <tr>
                  <td>연관 상품</td>
                  <td colspan="2">
                    <input class="form-control" id="related_goods" style="width:50%">
                    * 상품코드를 입력해 주시고, 2개 이상일시 ;로 구분해 주세요.(PR00001;PR00002)
                  </td>
                </tr>
                <tr>
                  <td>판매 경로</td>
                  <td colspan="2">
                    <select class="form-control" id="sales_store">
                      <option value="">선택하세요</option>
                    </select>
                  </td>
                </tr>
              </tbody>
            </table>
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th colspan="2" style="background:#dde">기본 정보</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>* 상품명</td>
                  <td colspan="2">
                    <input class="form-control" id="goods_name" style="width:100%">
                  </td>
                </tr>
                <tr>
                  <td>영문 상품명</td>
                  <td colspan="2">
                    <input class="form-control" id="goods_eng_name" style="width:100%">
                  </td>
                </tr>
                <tr>
                  <td>모델명</td>
                  <td colspan="2">
                    <input class="form-control" id="goods_model" style="width:100%">
                  </td>
                </tr>
                <tr>
                  <td>브랜드명</td>
                  <td colspan="2">
                    <select class="form-control" id="goods_brand">
                      <option value="">선택하세요</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>* 상품 이미지</td>
                  <td colspan="2">
                    <form action="../../lib/filer/php/upload.php" id="img_frm" method="post" enctype="multipart/form-data">
                      <input type="file" name="files[]" id="filer_input" multiple="multiple">
                      <!-- <input type="submit" value="Submit"> -->
                    </form>
                  </td>
                </tr>
                <tr>
                  <td>상품코드</td>
                  <td colspan="2">
                    자동생성
                  </td>
                </tr>
                <tr>
                  <td>상품상태</td>
                  <td colspan="2">
                    <input type="radio" name="goods_status" value="new" checked> 신상품
                    <input type="radio" name="goods_status" value="uesd"> 중고상품
                    <input type="radio" name="goods_status" value="return"> 반품/재고/진열상품
                  </td>
                </tr>
                <tr>
                  <td>* 상품 요약설명</td>
                  <td colspan="2">
                    <input class="form-control" id="goods_small_desc" style="width:100%">
                  </td>
                </tr>
                <tr>
                  <td>상품 간략설명</td>
                  <td colspan="2">
                    <textarea class="form-control" id="goods_middle_desc" rows="3" style="width:100%"></textarea>
                  </td>
                </tr>
                <tr>
                  <td>* 상품 상세설명</td>
                  <td colspan="2">
                    <form action="sample.php" method="post">
                      <textarea name="goods_big_desc"  id="goods_big_desc" rows="10" cols="100" style="width:100%; height:412px; display:none;"></textarea>
                    </form>
                  </td>
                </tr>
                <tr>
                  <td>모바일 상품 상세설명</td>
                  <td colspan="2">
                    <input type="radio" name="m_goods_big_descYN" id="m_goods_big_descY" value="new"> 직접 등록
                    <input type="radio" name="m_goods_big_descYN" id="m_goods_big_descN" value="same" checked> 상품 상세설명 동일
                    <div id="mobile_detail_div" style="display:none;">
                      <form action="sample.php" method="post">
                        <textarea name="m_goods_big_desc"  id="m_goods_big_desc" rows="10" cols="100" style="width:100%; height:412px;"></textarea>
                      </form>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th colspan="2" style="background:#dde">판매 정보</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>* 공급가</td>
                  <td colspan="2">
                    <input class="form-control" id="supply_price"> 원
                  </td>
                </tr>
                <tr>
                  <td>* 판매가</td>
                  <td colspan="2">
                    <input class="form-control" id="sales_price"> 원
                  </td>
                </tr>
                <tr>
                  <td>할인가</td>
                  <td colspan="2">
                    <input class="form-control" id="discount_price"> 원
                  </td>
                </tr>
                <tr>
                  <td>적립금</td>
                  <td colspan="2">
                    <input type="radio" name="saved_priceYN" id="saved_priceY" value="Y" checked> 기본 설정 사용
                    <input type="radio" name="saved_priceYN" id="saved_priceN" value="N"> 별도 설정
                    <div id="save_detail_div" style="display:none;">
                      <input class="form-control" id="saved_price"> 원
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th colspan="3" style="background:#dde">옵션/재고 설정</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>옵션사용</td>
                  <td colspan="2">
                    <input type="radio" name="goods_optionYN" id="goods_optionY" value="Y"> 사용함 ( 최대 5개 )
                    <input type="radio" name="goods_optionYN" id="goods_optionN" value="N" checked> 사용안함
                  </td>
                </tr>
                <tr id="option_ins" style="display:none;">
                  <td>옵션입력</td>
                  <td colspan="2">
                    <table class="table">
                      <thead>
                        <tr>
                          <th style="width:30%">옵션명</th>
                          <th>옵션값</th>
                        </tr>
                      </thead>
                      <tbody id="option_detail_tr">
                        <tr>
                          <td>
                            <input class="form-control" id="option_name1" placeholder="예시) 색상" style="width:100%">
                          </td>
                          <td>
                            <input class="form-control" id="option_value1" placeholder="예시) 블랙;화이트;블루" style="width:90%"> 
                            <button type="button" class="btn btn-primary btn-xs option_add_btn">+</button>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
                <tr>
                  <td>* 재고수량</td>
                  <td colspan="2">
                    <input class="form-control" id="goods_stock"> 개
                  </td>
                </tr>
              </tbody>
            </table>
            <button type="button" class="btn btn-danger btn-lg btn-block" id="submit_btn2">완 료</button>
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
	<script type="text/javascript" src="../../lib/smarteditor/js/HuskyEZCreator.js" charset="utf-8"></script>

	<script src="../../lib/filer/js/jquery.filer.min.js"></script>
	<script>
	var oEditors		= [];
	var m_oEditors	= [];
	var goods_code = null;
	var option_num	= 1;
	$(document).ready(function() {
		// 1번 카테고리 정보
		show_select_cate1("cate_1");
		// 판매 경로 정보
		show_select_sales_store("sales_store");
		// 브랜드 정보
		show_select_brand("goods_brand");
	});

	nhn.husky.EZCreator.createInIFrame({
		oAppRef: oEditors,
		elPlaceHolder: "goods_big_desc",
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

	nhn.husky.EZCreator.createInIFrame({
		oAppRef: m_oEditors,
		elPlaceHolder: "m_goods_big_desc",
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

	$('#filer_input').filer({
		showThumbs: true,
		templates: {
			box: '<ul class="jFiler-items-list jFiler-items-grid"></ul>',
			item: '<li class="jFiler-item">\
						<div class="jFiler-item-container">\
							<div class="jFiler-item-inner">\
								<div class="jFiler-item-thumb">\
									<div class="jFiler-item-status"></div>\
									<div class="jFiler-item-info">\
										<span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
										<span class="jFiler-item-others">{{fi-size2}}</span>\
									</div>\
									{{fi-image}}\
								</div>\
								<div class="jFiler-item-assets jFiler-row">\
									<ul class="list-inline pull-left"></ul>\
									<ul class="list-inline pull-right">\
										<li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
									</ul>\
								</div>\
							</div>\
						</div>\
					</li>',
			itemAppend: '<li class="jFiler-item">\
							<div class="jFiler-item-container">\
								<div class="jFiler-item-inner">\
									<div class="jFiler-item-thumb">\
										<div class="jFiler-item-status"></div>\
										<div class="jFiler-item-info">\
											<span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
											<span class="jFiler-item-others">{{fi-size2}}</span>\
										</div>\
										{{fi-image}}\
									</div>\
									<div class="jFiler-item-assets jFiler-row">\
										<ul class="list-inline pull-left">\
											<li><span class="jFiler-item-others">{{fi-icon}}</span></li>\
										</ul>\
										<ul class="list-inline pull-right">\
											<li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
										</ul>\
									</div>\
								</div>\
							</div>\
						</li>',
			itemAppendToEnd: false,
			removeConfirmation: true,
			_selectors: {
				list: '.jFiler-items-list',
				item: '.jFiler-item',
				remove: '.jFiler-item-trash-action'
			}
		},
		addMore: true
	});
	</script>

</body>

</html>
