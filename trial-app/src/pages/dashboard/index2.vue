<template>
    <q-page class="flex flex-center">
        <apexchart type="donut" height="370px" :options="chartOptions" :series="chart"> </apexchart>
    </q-page>
</template>
<script lang="js">
// import ApexCharts from 'apexcharts'
export default {
    name: "indexDashboard",
    data() {
        return {
            chart : [38, 40, 25],
        };
    },
    computed:{
        chartOptions(){
          return {
            labels: ['series-1', 'series-2', 'series-3'],
            chart: {
                type: 'donut',
                fontFamily: `inherit`,
                foreColor: '#a1aab2',
                toolbar: {
                    show: false
                }
            },
            colors: ['#1976d2', '#f2c037', '#F9F9FD'],
            plotOptions: {
                pie: {
                    startAngle: 0,
                    endAngle: 360,
                    donut: {
                        size: '75%',
                        background: 'transparent'
                    }
                }
            },
            stroke: {
                show: false
            },
            
            dataLabels: {
                enabled: false
            },
            legend: {
                show: false
            },
            tooltip: { theme: "dark", fillSeriesColor: false },
        };
      }
    },
    methods: {
        //
    },
    async created() {
        //
    }
}
</script>
