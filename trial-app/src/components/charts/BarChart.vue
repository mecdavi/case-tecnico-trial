<template>
  <div class="chart-container">
    <apexchart
      type="bar"
      height="350"
      :options="chartOptions"
      :series="series"
    />
  </div>
</template>

<script>
export default {
  name: 'BarChart',
  props: {
    series: {
      type: Array,
      required: true,
      default: () => []
    },
    categories: {
      type: Array,
      default: () => []
    },
    colors: {
      type: Array,
      default: () => ['#1976d2', '#4caf50', '#ff9800']
    },
    title: {
      type: String,
      default: ''
    },
    horizontal: {
      type: Boolean,
      default: false
    }
  },
  computed: {
    chartOptions() {
      return {
        chart: {
          type: 'bar',
          height: 350,
          toolbar: {
            show: true,
            tools: {
              download: true,
              selection: false,
              zoom: false,
              zoomin: false,
              zoomout: false,
              pan: false,
              reset: false
            }
          },
          fontFamily: 'Inter, sans-serif',
          foreColor: '#6b7280'
        },
        colors: this.colors,
        plotOptions: {
          bar: {
            horizontal: this.horizontal,
            borderRadius: 6,
            columnWidth: '60%',
            dataLabels: {
              position: 'top'
            }
          }
        },
        dataLabels: {
          enabled: true,
          offsetY: this.horizontal ? 0 : -20,
          style: {
            fontSize: '12px',
            colors: ['#374151'],
            fontWeight: 500
          },
          formatter: (val) => {
            return val.toLocaleString()
          }
        },
        xaxis: {
          categories: this.categories,
          labels: {
            style: {
              colors: '#9ca3af',
              fontSize: '12px'
            }
          },
          axisBorder: {
            show: false
          },
          axisTicks: {
            show: false
          }
        },
        yaxis: {
          labels: {
            style: {
              colors: '#9ca3af',
              fontSize: '12px'
            },
            formatter: (val) => {
              return val.toLocaleString()
            }
          }
        },
        grid: {
          borderColor: '#e5e7eb',
          strokeDashArray: 4,
          xaxis: {
            lines: {
              show: true
            }
          },
          yaxis: {
            lines: {
              show: true
            }
          }
        },
        legend: {
          position: 'top',
          horizontalAlign: 'right',
          fontSize: '14px',
          fontFamily: 'Inter, sans-serif',
          fontWeight: 500
        },
        tooltip: {
          theme: 'dark',
          y: {
            formatter: (val) => {
              return val.toLocaleString()
            }
          }
        },
        title: {
          text: this.title,
          align: 'left',
          style: {
            fontSize: '18px',
            fontWeight: 600,
            color: '#1f2937',
            fontFamily: 'Inter, sans-serif'
          }
        },
        fill: {
          opacity: 0.9,
          type: 'gradient',
          gradient: {
            shade: 'light',
            type: 'vertical',
            shadeIntensity: 0.3,
            gradientToColors: this.colors,
            inverseColors: false,
            opacityFrom: 1,
            opacityTo: 0.8,
            stops: [0, 100]
          }
        }
      }
    }
  }
}
</script>

<style scoped>
.chart-container {
  background: #ffffff;
  border-radius: 12px;
  padding: 20px;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}
</style>

