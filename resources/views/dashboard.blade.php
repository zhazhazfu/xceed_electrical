@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<!-- --------------- -->
<html>

<head>
    <title>Make Google Pie Chart in Laravel</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script type="text/javascript">
        var analytics = <?php echo $companycost_name; ?>;
        google.charts.load('current', {'packages':['corechart']});

        google.charts.setOnLoadCallback(drawChart);
        google.charts.setOnLoadCallback(drawChart1);

        function drawChart() {
            var data = google.visualization.arrayToDataTable(analytics);

            var options = {
                title: 'Company Costs',
                colors: ['#009900', '#00C5CD', '#0147FA', '#3E7A5E', '#551A8B','#5DFC0A','#8B7E66','#DCA2CD','#E04006','#E3170D','#E3E3E3','#EAB5C5','#EE3B3B']
            };

            //Here can change the diagram type
            var chart = new google.visualization.PieChart(document.getElementById('pie'));

            chart.draw(data, options);
        }


        function drawChart1() {
        var normal = 0;
        var mates_1 = 0;
        var mates_2 = 0;
        var mates_3 = 0;
        var real_1 = 0;
        var real_2 = 0;
        var real_3 = 0;
        var real_4 = 0;
        var loyal = 0;
        var general = 0;
        var PROMOTIONAL1 = 0;
        var PROMOTIONAL2 = 0;
        var PROMOTIONAL3 = 0;
        <?php
            foreach($customers as $customer)
            {
                if($customer->customer_archived == 0)
                {
                    if($customer->fk_discount_id == 1)
                    {
                        ?>
                        normal++;
                        <?php
                    }
                    if($customer->fk_discount_id == 2)
                    {
                        ?>
                        mates_1++;
                        <?php
                    }
                    if($customer->fk_discount_id == 3)
                    {
                        ?>
                        mates_2++;
                        <?php
                    }
                    if($customer->fk_discount_id == 4)
                    {
                        ?>
                        mates_3++;
                        <?php
                    }
                    if($customer->fk_discount_id == 5)
                    {
                        ?>
                        real_1++;
                        <?php
                    }
                    if($customer->fk_discount_id == 6)
                    {
                        ?>
                        real_2++;
                        <?php
                    }
                    if($customer->fk_discount_id == 7)
                    {
                        ?>
                        real_3++;
                        <?php
                    }
                    if($customer->fk_discount_id == 8)
                    {
                        ?>
                        real_4++;
                        <?php
                    }
                    if($customer->fk_discount_id == 9)
                    {
                        ?>
                        loyal++;
                        <?php
                    }
                    if($customer->fk_discount_id == 10)
                    {
                        ?>
                        general++;
                        <?php
                    }
                    if($customer->fk_discount_id == 11)
                    {
                        ?>
                        PROMOTIONAL1++;
                        <?php
                    }
                    if($customer->fk_discount_id == 12)
                    {
                        ?>
                        PROMOTIONAL2++;
                        <?php
                    }
                    if($customer->fk_discount_id == 13)
                    {
                        ?>
                        PROMOTIONAL3++;
                        <?php
                    }
                }
            }
        ?>
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['NORMAL PRICING - NO DISCOUNT',     normal],
          ['MATES RATES CATEGORY 1',       mates_1],
          ['MATES RATES CATEGORY 2',  mates_2],
          ['MATES RATES CATEGORY 3', mates_3],
          ['REAL ESTATE / STRATA CATERGORY - 1',    real_1],
          ['REAL ESTATE / STRATA CATEGORY - 2',  real_2],
          ['REAL ESTATE / STRATA CATEGORY - 3',  real_3],
          ['REAL ESTATE / STRATA CATEGORY - 4',  real_4],
          ['LOYAL CUSTOMER',  loyal],
          ['GENERAL CUSTOMER DISCOUNT',  general],
          ['PROMOTIONAL DISCOUNT - 1',  PROMOTIONAL1],
          ['PROMOTIONAL DISCOUNT - 2',  PROMOTIONAL2],
          ['PROMOTIONAL DISCOUNT - 3',  PROMOTIONAL3],
        ]);
            // var data = google.visualization.arrayToDataTable(analytics1);

            var options = {
                title: 'Proportion of Customers Discount'
                
            };

            //Here can change the diagram type
            var chart = new google.visualization.PieChart(document.getElementById('pie1'));

            chart.draw(data, options);
        }
    </script>
</head>

<body>

<!-- Button trigger modal -->
<div class=" p-3 mb-5 bg-white rounded border">
    <div>

        @if($message = Session::get('error'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>{{ $message }}</strong>
        </div>
        @endif

        @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>

    <div class="row">
        <div class="col-sm">
            <h3>Dashboard</h3>
            @if(isset(Auth::user()->user_name))
            <div class="alert alert-success success-block">
            <button type="button" class="close" data-dismiss="alert">x</button>
                <strong>Welcome {{ Auth::user()->user_name }}</strong>
            </div>
            @else
            <script>
                window.location = "/main";
            </script>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6">
            <div class="row">
                <div class="col-md-4">
                    @foreach($grossmargin as $grossmargins)
                    @php
                    $value = $grossmargins->gm_rate;
                    @endphp
                    @endforeach
                    @component('common-components.dashboard2-widget')
                    @slot('title') Current GM Rate @endslot
                    @slot('total') {{number_format($value,4)}} @endslot
                    @slot('chartId') radial-chart-1 @endslot
                    @endcomponent
                </div>
                <div class="col-md-4">
                    
                <!-- total company expenses -->
    @php
    $total = 0;
    @endphp
    @foreach($companyCosts as $companyCost)
    @if($companyCost->companycost_archived == '0')
    @php
    $total += $companyCost->companycost_yearly;
    @endphp
    @endif
    @endforeach


    <!-- total employee costs -->
    @php
    $total_employee = 0;
    $total_cost_less_super=0;
    @endphp
    @foreach($employeeCosts as $employeeCost)
    @if($employeeCost->employee_archived == '0' && $employeeCost->employee_type == 'Employee')
    @php
    $total_employee += $employeeCost->employee_workercomp + $employeeCost->employee_hoursperweek*
    $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear*0.095 +
    $employeeCost->employee_phone +$employeeCost->employee_otherweeklycost +
    $employeeCost->employee_vehiclecost + $employeeCost->employee_hoursperweek*
    $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear;
    $total_cost_less_super+=$employeeCost->employee_workercomp +
    $employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly *
    $employeeCost->employee_weeksperyear*0.095 + $employeeCost->employee_phone
    +$employeeCost->employee_otherweeklycost + $employeeCost->employee_vehiclecost +
    $employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly *
    $employeeCost->employee_weeksperyear - $employeeCost->employee_hoursperweek*
    $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear*0.095;
    @endphp
    @endif
    @endforeach


    <!-- total sub-contractor costs -->
    @php
    $total_subcontractor = 0;
    $total_cost_less_super=0;
    @endphp
    @foreach($employeeCosts as $employeeCost)
    @if($employeeCost->employee_archived == '0' && $employeeCost->employee_type == 'Sub-Contractor')
    @php
    $total_subcontractor += $employeeCost->employee_cash + $employeeCost->employee_workercomp +
    $employeeCost->employee_hoursperweek*
    $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear*0.095 +
    $employeeCost->employee_phone +$employeeCost->employee_otherweeklycost +
    $employeeCost->employee_vehiclecost + $employeeCost->employee_hoursperweek*
    $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear;
    $total_cost_less_super+=$employeeCost->employee_workercomp +
    $employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly *
    $employeeCost->employee_weeksperyear*0.095 + $employeeCost->employee_phone
    +$employeeCost->employee_otherweeklycost + $employeeCost->employee_vehiclecost +
    $employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly *
    $employeeCost->employee_weeksperyear - $employeeCost->employee_hoursperweek*
    $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear*0.095;
    @endphp
    @endif
    @endforeach


    @php
    $total_business_hourly_cost = $total + $total_employee + $total_subcontractor;
    @endphp

                    <!-- code for dashboard table2 -->
                    @component('common-components.dashboard2-widget')
                    @slot('title')Hourly Running Cost @endslot
                    @slot('total') ${{number_format($total_business_hourly_cost/365/8, 2)}} @endslot
                    @slot('chartId') radial-chart-2 @endslot
                    @endcomponent
                </div>
                <div class="col-md-4">
                    @component('common-components.dashboard2-widget')
                    @slot('title') Current Charge Rate @endslot
                    @slot('total') ${{number_format(($total_business_hourly_cost/365/8) * $grossmargins->gm_rate, 2)}}@endslot
                    @slot('chartId') radial-chart-2 @endslot
                    @endcomponent
                </div>
                
                <div class="container">
                    <!-- <h3 align="center">Make Google Pie Chart in Laravel</h3><br /> -->

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <!-- <h3 class="panel-title">Percentage of Male and Female Employee</h3> -->
                        </div>
                        <div class="panel-body" align="left">
                            <div id="pie" class="card mt-2" style="width:750px; height:450px;">
                            </div>
                            <div id="pie1" class="card mt-2" style="width:750px; height:450px;">
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
        </div>


        <!-- 、、、、、、、、、、、、、、、、 -->
</body>

</html>
@endsection
