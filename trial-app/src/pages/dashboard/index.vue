<template>
  <q-page class="dashboard-page">
    <div class="dashboard-container">
      <!-- Header Section -->
      <div class="dashboard-header q-mb-lg">
        <div class="text-h4 text-weight-bold dashboard-title">Dashboard</div>
        <div class="text-subtitle1 text-grey-7">Visão geral do sistema</div>
      </div>

      <!-- Statistics Cards -->
      <div class="row q-col-gutter-md q-mb-lg">
        <div class="col-12 col-sm-6 col-md-3">
          <StatCard
            label="Total de Usuários"
            :value="stats.totalUsers"
            icon="people"
            icon-color="primary"
            :change="12.5"
            color="primary"
          />
        </div>
        <div class="col-12 col-sm-6 col-md-3">
          <StatCard
            label="Novos Usuários"
            :value="stats.newUsers"
            icon="person_add"
            icon-color="positive"
            :change="8.2"
            color="success"
          />
        </div>
        <div class="col-12 col-sm-6 col-md-3">
          <StatCard
            label="Atividades"
            :value="stats.activities"
            icon="trending_up"
            icon-color="warning"
            :change="-3.1"
            color="warning"
          />
        </div>
        <div class="col-12 col-sm-6 col-md-3">
          <StatCard
            label="Taxa de Conversão"
            :value="stats.conversionRate"
            icon="show_chart"
            icon-color="purple"
            :change="15.8"
            color="info"
            format="percentage"
          />
        </div>
      </div>

      <!-- Charts Row 1 -->
      <div class="row q-col-gutter-md q-mb-md">
        <div class="col-12 col-lg-8">
          <LineChart
            :series="lineChartSeries"
            :categories="lineChartCategories"
            :colors="['#1976d2', '#4caf50', '#ff9800']"
            title="Crescimento de Usuários"
          />
        </div>
        <div class="col-12 col-lg-4">
          <DonutChart
            :series="donutChartSeries"
            :labels="donutChartLabels"
            :colors="['#1976d2', '#4caf50', '#ff9800', '#9c27b0', '#f44336']"
            title="Distribuição por Tipo"
            donut-size="70%"
          />
        </div>
      </div>

      <!-- Charts Row 2 -->
      <!-- <div class="row q-col-gutter-md q-mb-md">
        <div class="col-12 col-lg-6">
          <BarChart
            :series="barChartSeries"
            :categories="barChartCategories"
            :colors="['#1976d2', '#4caf50']"
            title="Atividades por Mês"
          />
        </div>
        <div class="col-12 col-lg-6">
          <AreaChart
            :series="areaChartSeries"
            :categories="areaChartCategories"
            :colors="['#9c27b0', '#00bcd4']"
            title="Tendência de Acesso"
          />
        </div>
      </div> -->

      <!-- Charts Row 3 - Full Width -->
      <!-- <div class="row q-col-gutter-md">
        <div class="col-12">
          <LineChart
            :series="multiLineChartSeries"
            :categories="multiLineChartCategories"
            :colors="['#1976d2', '#4caf50', '#ff9800', '#9c27b0', '#f44336']"
            title="Análise Comparativa - Últimos 12 Meses"
            :stroke-width="2"
          />
        </div>
      </div> -->
    </div>
  </q-page>
</template>

<script>
import LineChart from 'components/charts/LineChart.vue'
// import BarChart from 'components/charts/BarChart.vue'
// import AreaChart from 'components/charts/AreaChart.vue'
import DonutChart from 'components/charts/DonutChart.vue'
import StatCard from 'components/charts/StatCard.vue'

export default {
  name: 'DashboardPage',
  components: {
    LineChart,
    // BarChart,
    // AreaChart,
    DonutChart,
    StatCard
  },
  data() {
    return {
      stats: {
        totalUsers: 1248,
        newUsers: 156,
        activities: 3420,
        conversionRate: 68.5
      },
      // Line Chart Data
      lineChartSeries: [
        {
          name: 'Usuários Ativos',
          data: [420, 532, 516, 575, 618, 662, 720, 780, 845, 920, 1000, 1100]
        },
        {
          name: 'Novos Usuários',
          data: [120, 132, 101, 134, 90, 230, 210, 182, 191, 234, 290, 330]
        },
        {
          name: 'Usuários Premium',
          data: [80, 95, 110, 125, 140, 155, 170, 185, 200, 215, 230, 245]
        }
      ],
      lineChartCategories: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
      
      // Donut Chart Data
      donutChartSeries: [35, 25, 20, 12, 8],
      donutChartLabels: ['Admin', 'Usuários', 'Premium', 'Trial', 'Inativos'],
      
      // Bar Chart Data
      barChartSeries: [
        {
          name: 'Atividades',
          data: [320, 450, 380, 520, 490, 610, 580, 670, 720, 680, 750, 820]
        },
        {
          name: 'Sessões',
          data: [280, 390, 340, 480, 450, 560, 530, 620, 680, 640, 710, 780]
        }
      ],
      barChartCategories: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
      
      // Area Chart Data
      areaChartSeries: [
        {
          name: 'Acessos Diários',
          data: [1200, 1350, 1280, 1450, 1380, 1520, 1480, 1620, 1750, 1680, 1820, 1950]
        },
        {
          name: 'Acessos Únicos',
          data: [800, 920, 880, 1000, 950, 1100, 1050, 1180, 1250, 1200, 1320, 1400]
        }
      ],
      areaChartCategories: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
      
      // Multi Line Chart Data
      multiLineChartSeries: [
        {
          name: 'Vendas',
          data: [4500, 5200, 4800, 6100, 5500, 6800, 7200, 7900, 8500, 9200, 9800, 10500]
        },
        {
          name: 'Receita',
          data: [3200, 3800, 3500, 4200, 3900, 4800, 5100, 5600, 6000, 6500, 7000, 7500]
        },
        {
          name: 'Custos',
          data: [1800, 2100, 1900, 2300, 2100, 2600, 2800, 3000, 3200, 3400, 3600, 3800]
        },
        {
          name: 'Lucro',
          data: [1400, 1700, 1600, 1900, 1800, 2200, 2300, 2600, 2800, 3100, 3400, 3700]
        }
      ],
      multiLineChartCategories: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez']
    }
  },
  methods: {
    async loadDashboardData() {
      try {
        const response = await this.executeMethod('get', 'api/v1/users')
        if (response && response.status === 200) {
          this.stats.totalUsers = response.data.data.length
          this.stats.newUsers = response.data.data.length
        }
      } catch (error) {
        console.error('Erro ao carregar dados do dashboard:', error)
      }
    }
  },
  async created() {
    await this.loadDashboardData()
  }
}
</script>

<style scoped>
.dashboard-page {
  background: linear-gradient(135deg, #f5f7fa 0%, #e9ecef 100%);
  min-height: 100vh;
  padding: 24px;
}

.dashboard-container {
  max-width: 1400px;
  margin: 0 auto;
}

.dashboard-header {
  margin-bottom: 32px;
}

.dashboard-title {
  color: #1f2937;
  margin-bottom: 8px;
  font-size: 32px;
  letter-spacing: -0.5px;
}

/* Responsive adjustments */
@media (max-width: 1024px) {
  .dashboard-page {
    padding: 16px;
  }
  
  .dashboard-title {
    font-size: 28px;
  }
}

@media (max-width: 600px) {
  .dashboard-page {
    padding: 12px;
  }
  
  .dashboard-title {
    font-size: 24px;
  }
}
</style>
