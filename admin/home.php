

<div class="hero">
    <div class="hero-inner">
        <div class="hero-title">
            <h1 class="text-light title font-2"></h1>
            <p class="text-capitalize text-light"></p>
        </div>
        <a href="#" class="sd"></a>
    </div>
</div>


<div class="row">
    <div id="piechart" style="width: 900px; height: 800px;"></div>

    <script type="text/javascript" src="https://fastly.jsdelivr.net/npm/echarts@5/dist/echarts.min.js"></script>
    <script type="text/javascript">
        var chartDom = document.getElementById('piechart');
        var myChart = echarts.init(chartDom);
        var option;

        option = {
            legend: {
                top: 'bottom'
            },
            toolbox: {
                show: true,
                feature: {
                    mark: {
                        show: true
                    },
                    dataView: {
                        show: true,
                        readOnly: false
                    },
                    restore: {
                        show: true
                    },
                    saveAsImage: {
                        show: true
                    }
                }
            },
            series: [{
                name: 'Catalogue Chart',
                type: 'pie',
                radius: [50, 250],
                center: ['50%', '50%'],
                roseType: 'area',
                itemStyle: {
                    borderRadius: 8
                },
                data: [
                    <?php
                    $tongdm = count($listthongke);
                    $i = 1;
                    foreach ($listthongke as $thongke) {
                        extract($thongke);
                        if ($i == $tongdm) $dauphay = "";
                        else $dauphay = ",";
                        echo "{ value: " . $countsp . ", name: '" . $tendm . "' }" . $dauphay;
                        $i++;
                    }
                    ?>
                ]
            }]
        };

        option && myChart.setOption(option);

        window.addEventListener('resize', myChart.resize);
    </script>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js"></script>
<script>
    $('.sd').click(function(){
        $('.hero, .content').addClass('scrolled');
    });

    $('.hero').mousewheel(function(e){
        if( e.deltaY < 0 ){
            $('.hero, .content').addClass('scrolled');
            return false;
        }
    });
    $(window).mousewheel(function(e){
        if( $('.hero.scrolled').length ){
            if( $(window).scrollTop() == 0 && e.deltaY > 0 ){
                $('.hero, .content').removeClass('scrolled');
            }
        }
    });
</script>