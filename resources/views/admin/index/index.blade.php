@extends('admin.index')
@section('body')
    <div class="wap_content">
        <div class="row mb-5 align-items-start">
            <div class="col-3">
                <div class="total d-flex flex-wrap">
                    <span class="name w-100">Phòng hiện có: {{ $array['room'] }}</span>
                    <span class="name w-100">Phòng đang hoạt động: {{ $array['hoatdong'] }}</span>
                    <span class="name w-100">Phòng đang thuê: {{ $array['dangthue'] }}</span>
                    <span class="name w-100">Phòng đang đã thuê: {{ $array['dathue'] }}</span>
                    <span class="name w-100">Phòng bảo trì: {{ $array['baotri'] }}</span>
                    <a href="{{ route('admin.phong-tro') }}"
                        class="btn btn-success xemchitiet text-decoration-none w-100 d-flex flex-wrap mt-2 align-items-center">
                        <span>Xem chi tiết</span>
                        <div class="animate-xt"><i class="fa-sharp fa-regular fa-circle-arrow-right"></i></div>
                    </a>
                </div>
            </div>
            <div class="col-3">
                <div class="total d-flex flex-wrap">
                    <span class="name w-100">Thu tháng hiện tại: {{ $array['thu'] }}</span>
                    <span class="name w-100">Thu tháng trước: {{ $array['thuprev'] }}</span>
                    <span class="name w-100">Thu so với tháng trước: {{ $array['thuper'] }}%
                        @if ($array['thuper'] < 0)
                            <i class="fa-regular fa-arrow-down-right" style="color: #ff0000;"></i>
                        @else
                            <i class="fa-regular fa-arrow-up-right" style="color: #00ff22;"></i>
                        @endif
                    </span>
                </div>
            </div>
            <div class="col-3">
                <div class="total d-flex flex-wrap">
                    <span class="name w-100">Chi tháng hiện tại: {{ $array['chi'] }}</span>
                    <span class="name w-100">Chi tháng trước: {{ $array['chiprev'] }}</span>
                    <span class="name w-100">Chi so với tháng trước: {{ $array['chiper'] }}%
                        @if ($array['chiper'] < 0)
                            <i class="fa-regular fa-arrow-down-right" style="color: #ff0000;"></i>
                        @else
                            <i class="fa-regular fa-arrow-up-right" style="color: #00ff22;"></i>
                        @endif
                    </span>
                </div>
            </div>
            <div class="col-3">
                <div class="total d-flex flex-wrap">
                    <span class="name w-100">Doanh thu: {{ $array['doanhthu'] }}</span>
                    <span class="name w-100">Doanh thu tháng trước: {{ $array['doanhthuprev'] }}</span>
                    <span class="name w-100">Doanh thu so với tháng trước: {{ $array['doanhthuper'] }}%
                        @if ($array['doanhthuper'] < 0)
                            <i class="fa-regular fa-arrow-down-right" style="color: #ff0000;"></i>
                        @else
                            <i class="fa-regular fa-arrow-up-right" style="color: #00ff22;"></i>
                        @endif
                    </span>
                </div>
            </div>
        </div>
        <div class="box-thongke text-center">
            <span class="title-thongke">Thống kê doanh thu</span>
            <div class="basic-colunm-chart col-11 m-auto"></div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        var d = new Date(),
            n = d.getMonth();
        var thang = [];
        for (var i = 0; i <= n; i++) {
            thang[i] = 'Tháng ' + (i + 1);
        }

        var options = {
            series: [{
                name: 'Thu',
                type: 'column',
                data: {{ $array['thongkethu'] }}
            }, {
                name: 'Chi',
                type: 'column',
                data: {{ $array['thongkechi'] }}
            }, {
                name: 'Doanh thu',
                type: 'line',
                data: {{ $array['thongkedoanhthu'] }}
            }],
            chart: {
                toolbar: {
                    show: false
                },
                height: 350,
                type: 'line',
            },
            stroke: {
                width: [0, 0, 2]
            },
            dataLabels: {
                enabled: true,
                enabledOnSeries: [2],
                formatter: function(value) {
                    return formatMoney(value, ' VNĐ');
                }
            },
            xaxis: {
                title: {
                    text: 'Tháng'
                },
                categories: thang,
            },
            yaxis: [{
                labels: {
                    formatter: function(value) {
                        return formatMoney(value, ' VNĐ');
                    }
                },
                title: {
                    text: 'VNĐ'
                },
            }],
            tooltip: {
                y: {
                    formatter: function(val) {
                        return formatMoney(val, " VNĐ");
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector(".basic-colunm-chart"), options);
        chart.render();
    </script>
@endsection
