<template>
  <div class="chart-container">
    <apexchart
      type="line"
      height="350"
      :options="chartOptions"
      :series="series"
    />
  </div>
</template>

<script>
export default {
  name: 'LineChart',
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
      default: () => ['#1976d2', '#4caf50', '#ff9800', '#9c27b0']
    },
    title: {
      type: String,
      default: ''
    },
    strokeWidth: {
      type: Number,
      default: 3
    }
  },
  computed: {
    chartOptions() {
      return {
        chart: {
          type: 'line',
          height: 350,
          zoom: {
            enabled: true,
            type: 'x',
            autoScaleYaxis: true
          },
          toolbar: {
            show: true,
            tools: {
              download: true,
              selection: true,
              zoom: true,
              zoomin: true,
              zoomout: true,
              pan: true,
              reset: true
            }
          },
          fontFamily: 'Inter, sans-serif',
          foreColor: '#6b7280'
        },
        colors: this.colors,
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'smooth',
          width: this.strokeWidth,
          lineCap: 'round'
        },
        markers: {
          size: 5,
          strokeWidth: 2,
          hover: {
            size: 7
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
          },
          padding: {
            top: 0,
            right: 0,
            bottom: 0,
            left: 0
          }
        },
        legend: {
          position: 'top',
          horizontalAlign: 'right',
          fontSize: '14px',
          fontFamily: 'Inter, sans-serif',
          fontWeight: 500,
          markers: {
            width: 12,
            height: 12,
            radius: 6
          },
          itemMargin: {
            horizontal: 10,
            vertical: 5
          }
        },
        tooltip: {
          theme: 'dark',
          x: {
            format: 'dd/MM/yyyy'
          },
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

