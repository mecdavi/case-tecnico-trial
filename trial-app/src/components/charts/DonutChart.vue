<template>
  <div class="chart-container">
    <apexchart
      type="donut"
      height="350"
      :options="chartOptions"
      :series="series"
    />
  </div>
</template>

<script>
export default {
  name: 'DonutChart',
  props: {
    series: {
      type: Array,
      required: true,
      default: () => []
    },
    labels: {
      type: Array,
      default: () => []
    },
    colors: {
      type: Array,
      default: () => ['#1976d2', '#4caf50', '#ff9800', '#9c27b0', '#f44336', '#00bcd4']
    },
    title: {
      type: String,
      default: ''
    },
    donutSize: {
      type: String,
      default: '70%'
    }
  },
  computed: {
    chartOptions() {
      return {
        chart: {
          type: 'donut',
          height: 350,
          fontFamily: 'Inter, sans-serif',
          foreColor: '#6b7280',
          toolbar: {
            show: true,
            tools: {
              download: true
            }
          }
        },
        colors: this.colors,
        labels: this.labels,
        plotOptions: {
          pie: {
            donut: {
              size: this.donutSize,
              labels: {
                show: true,
                name: {
                  show: true,
                  fontSize: '16px',
                  fontWeight: 600,
                  color: '#374151',
                  offsetY: -10
                },
                value: {
                  show: true,
                  fontSize: '24px',
                  fontWeight: 700,
                  color: '#1f2937',
                  formatter: (val) => {
                    return val.toLocaleString()
                  }
                },
                total: {
                  show: true,
                  label: 'Total',
                  fontSize: '14px',
                  fontWeight: 500,
                  color: '#6b7280',
                  formatter: () => {
                    const total = this.series.reduce((a, b) => a + b, 0)
                    return total.toLocaleString()
                  }
                }
              }
            }
          }
        },
        dataLabels: {
          enabled: true,
          style: {
            fontSize: '12px',
            fontWeight: 500,
            colors: ['#ffffff']
          },
          dropShadow: {
            enabled: true,
            blur: 3,
            opacity: 0.3
          }
        },
        stroke: {
          show: true,
          width: 2,
          colors: ['#ffffff']
        },
        legend: {
          position: 'bottom',
          horizontalAlign: 'center',
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
          y: {
            formatter: (val, { seriesIndex, w }) => {
              seriesIndex
              const total = w.globals.seriesTotals.reduce((a, b) => a + b, 0)
              const percent = ((val / total) * 100).toFixed(1)
              return `${val.toLocaleString()} (${percent}%)`
            }
          }
        },
        title: {
          text: this.title,
          align: 'center',
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

