<!DOCTYPE html>
<html>


<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />

    <!-- 	<script>
		var siteUrl = '{!! url("/") !!}';
	</script>
	<link rel="icon" href="{{ url('/img/care4u.png')}}" type="image/jpg" sizes="16x16">
	<link rel="stylesheet" type="text/css" href="{{ url('/css/app.css')}}" />

	<script type="text/javascript" src="{{ url('') }}/Nifty/js/jquery.min.js"></script> -->

    <style type="text/css">
        <?php include(public_path() . '/css/app.css'); ?>body {
            font-family: DejaVu Sans !important;
        }

        .container {
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }

        @media (min-width: 576px) {
            .container {
                max-width: 540px;
            }
        }

        @media (min-width: 768px) {
            .container {
                max-width: 720px;
            }
        }

        @media (min-width: 992px) {
            .container {
                max-width: 960px;
            }
        }

        @media (min-width: 1200px) {
            .container {
                max-width: 1140px;
            }
        }

        .col-md-6 {
            width: 50% !important;
            float: left;
        }

        /*	.col-md-12{
		width: 100% !important;
		float: left;
		}*/
        .col-md-offset-3 {
            margin-left: 33.3%;
        }

        .col-md-3 {
            width: 33.3% !important;
            float: left;
        }
    </style>

    @includeif('partial._default_css')
    @includeif('partial._css')
    @includeif('partial._modalLoader')
</head>

<body>
    <div id="app">
        <div class="container" style="background: #fff">
            <div class="col-md-12" style="margin-top: 15px;">
                <div class="col-md-6">
                    <img src="{{ url('') }}/images/vietel.png" alt="" width="250px">
                    <br />
                    <h4>Số:...</h4>
                </div>
                <div class="col-md-6" style="text-align: center;">
                    <h4 style="color: red">CỘNG HOÀ XÃ HỘI CHỦ NGHĨA VIỆT NAM </h4>
                    <h4>Độc lập - Tự do - Hạnh phúc </h4>
                    <h4>--------)0(-------- </h4>
                </div>
            </div>
            <br />
            <br />

            <div class="col-md-12" style="text-align: center; width: 100%;">
                <h2>PHIẾU YÊU CẦU CUNG CẤP CHỨNG THƯ SỐ VIETTEL-CA </h2>
            </div>
            <div class="col-md-12">
                <h3>I. Thông tin về tổ chức, doanh nghiệp </h3>

                <div style="margin-left: 20px">
                    <h3>1. Tên giao dịch bằng tiếng Việt </h3>
                    <p style="margin-left: 30px">Tên giao dịch đầy đủ:………………………………………………...........................................</p>
                    <p style="margin-left: 30px">Tên viết tắt:……………………………………………..............................................................
                    </p>
                    <p style="margin-left: 30px">Trực thuộc :…………………………………………………….....................………………….
                    </p>
                </div>
                <div style="margin-left: 20px">
                    <h3>2. Tên giao dịch bằng tiếng Anh…………………………………………………………….......</h3>
                </div>
                <div style="margin-left: 20px">
                    <h3>3. Thông tin của tổ chức, doanh nghiệp</h3>
                    <p style="margin-left: 30px">Quyết định thành lập số/Giấy phép ĐKKD:
                    </p>
                    <p style="margin-left: 30px">Cấp ngày: ……………………………………….Tổ chức cấp:….……………………………..
                    </p>
                    <p style="margin-left: 30px">Mã số Thuế:
                    </p>
                </div>
                <div style="margin-left: 20px">
                    <h3>4. Địa chỉ của tổ chức, doanh nghiệp
                    </h3>
                    <p style="margin-left: 30px">Địa chỉ (theo quyết định thành lập/Giấy phép ĐKKD):…………….…………………………

                    </p>
                    <p style="margin-left: 30px">………………………………………………………………………………………………….………………………………………………………………………………

                    </p>
                    <p style="margin-left: 30px">Quận/Huyện………………………………….Thành phố/Tỉnh:………………........................

                    </p>
                </div>
                <div style="margin-left: 20px">
                    <h3>5. Email giao dịch chính thức:
                    </h3>
                </div>
                <h3>II. Khách hàng cá nhân/ đại diện pháp lý của tổ chức, doanh nghiệp </h3>
                <div style="margin-left: 20px">
                    <p style="margin-left: 30px">Họ và tên :…………….………………………………….Chức vụ: …………………………

                    </p>
                    <p style="margin-left: 30px">Số CMND/Hộ chiếu: ……………………Cấp ngày: ………………….. Tại:………………


                    </p>
                    <p style="margin-left: 30px">Hộ khẩu thường trú:……………………………………………………….…………………..
                    </p>
                    <p style="margin-left: 30px">Điện thoại:..………………………………Di động: ………………………………………….

                    </p>
                    <p style="margin-left: 30px">Email:...:…………….................................Fax:…………….......................................................

                    </p>
                </div>
                <h3>III. Thông tin liên hệ trong trường hợp cần thiết </h3>
                <div style="margin-left: 20px">
                    <p style="margin-left: 30px">Họ và tên:……………………………………Chức vụ: ……………………………………….

                    </p>
                    <p style="margin-left: 30px">Địa chỉ: …………………………………………………………………………………………
                    </p>

                    <p style="margin-left: 30px">Điện thoại:..………………………………Di động: ………………………………………….

                    </p>
                    <p style="margin-left: 30px">Email:...:…………….................................Fax:…………….......................................................
                    </p>
                </div>
                <h3>IV. Thông tin về chứng thư số Viettel-CA xin cấp:</h3>
                <div style="margin-left: 20px">

                    <h3>1. Đối tượng xin cấp dịch vụ:
                    </h3>
                    <div>
                        <span class="col-md-3 col-md-offset-3">
                            <input id="demo-todolist-3" class="magic-checkbox" type="checkbox">
                            <label for="demo-todolist-3"><span>Cá nhân</span></label>
                        </span>
                        <span class="col-md-3">
                            <input id="demo-todolist-3" class="magic-checkbox" type="checkbox">
                            <label for="demo-todolist-3"><span>Tổ chức</span></label>
                        </span>
                    </div>
                    <div class="clearfix"></div>
                    <h3>2. Loại chứng thư xin cấp:
                    </h3>
                    <div style="margin-left: 50px">
                        <div style="margin-bottom: 20px">
                            <input id="demo-todolist-3" class="magic-checkbox" type="checkbox">
                            <label for="demo-todolist-3"><span> Chứng thư số cho cơ quan, tổ chức, cá nhân</span></label>
                        </div>
                        <div style="margin-bottom: 20px">
                            <input id="demo-todolist-3" class="magic-checkbox" type="checkbox">
                            <label for="demo-todolist-3"><span> Chứng thư số SSL</span></label>
                        </div>
                        <div style="margin-bottom: 20px">
                            <input id="demo-todolist-3" class="magic-checkbox" type="checkbox">
                            <label for="demo-todolist-3"><span> Chứng thư số Code Signing
                                </span></label>
                        </div>
                    </div>
                    <h3>3. Thời hạn sử dụng:
                    </h3>
                    <div style="margin-left: 50px">
                        <p>Từ :………., …./…./…… Đến: ……….,…./…./……. </p>
                    </div>
                    <h3>4. Tên miền đăng ký (bắt buộc với chứng thư số SSL):………………….……………………

                    </h3>
                    <h3>5. Giấy phép tên miền số (bắt buộc với chứng thư số SSL):……..…………………………....
                    </h3>
                </div>


                <br><br />
                <br><br />
                <div class="col-md-6" style="text-align: center;">
                    <h4>Người tiếp nhận yêu cầu
                    </h4>
                    <p> (Ký và ghi rõ họ tên) (Ký, ghi họ tên và đóng dấu)
                    </p>
                </div>
                <div class="col-md-6" style="text-align: center;">
                    <p> ………, ngày ...... tháng …... năm…….
                    </p>
                    <h4>Người tiếp nhận yêu cầu Đại diện của tổ chức, doanh nghiệp
                    </h4>
                    <p> (Ký và ghi rõ họ tên) (Ký, ghi họ tên và đóng dấu)
                    </p>
                </div>

            </div>
        </div>
    </div>
</body>

</html>