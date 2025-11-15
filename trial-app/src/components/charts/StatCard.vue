<template>
  <q-card class="stat-card" :class="cardClass">
    <q-card-section class="stat-card-content">
      <div class="row items-center no-wrap">
        <div class="col">
          <div class="stat-label">{{ label }}</div>
          <div class="stat-value">{{ formattedValue }}</div>
          <div v-if="change !== null" class="stat-change" :class="changeClass">
            <q-icon :name="changeIcon" size="16px" />
            <span>{{ Math.abs(change) }}%</span>
            <span class="stat-change-label">{{ changeLabel }}</span>
          </div>
        </div>
        <div class="stat-icon-container">
          <q-icon :name="icon" :size="iconSize" :color="iconColor" />
        </div>
      </div>
    </q-card-section>
  </q-card>
</template>

<script>
export default {
  name: 'StatCard',
  props: {
    label: {
      type: String,
      required: true
    },
    value: {
      type: [Number, String],
      required: true
    },
    icon: {
      type: String,
      default: 'trending_up'
    },
    iconColor: {
      type: String,
      default: 'primary'
    },
    iconSize: {
      type: String,
      default: '48px'
    },
    change: {
      type: Number,
      default: null
    },
    color: {
      type: String,
      default: 'primary'
    },
    format: {
      type: String,
      default: 'number' // 'number', 'currency', 'percentage'
    },
    currency: {
      type: String,
      default: 'R$'
    }
  },
  computed: {
    formattedValue() {
      if (this.format === 'currency') {
        return `${this.currency} ${Number(this.value).toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`
      } else if (this.format === 'percentage') {
        return `${Number(this.value).toFixed(1)}%`
      } else {
        return Number(this.value).toLocaleString('pt-BR')
      }
    },
    changeClass() {
      if (this.change === null) return ''
      return this.change >= 0 ? 'positive' : 'negative'
    },
    changeIcon() {
      if (this.change === null) return ''
      return this.change >= 0 ? 'arrow_upward' : 'arrow_downward'
    },
    changeLabel() {
      if (this.change === null) return ''
      return this.change >= 0 ? 'vs mês anterior' : 'vs mês anterior'
    },
    cardClass() {
      return `stat-card-${this.color}`
    }
  }
}
</script>

<style scoped>
.stat-card {
  border-radius: 12px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
  transition: transform 0.2s ease, box-shadow 0.2s ease;
  border: none;
  overflow: hidden;
}

.stat-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.12);
}

.stat-card-content {
  padding: 24px;
}

.stat-label {
  font-size: 14px;
  font-weight: 500;
  color: #6b7280;
  margin-bottom: 8px;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.stat-value {
  font-size: 32px;
  font-weight: 700;
  color: #1f2937;
  margin-bottom: 8px;
  line-height: 1.2;
}

.stat-change {
  display: flex;
  align-items: center;
  gap: 4px;
  font-size: 13px;
  font-weight: 500;
  margin-top: 8px;
}

.stat-change.positive {
  color: #10b981;
}

.stat-change.negative {
  color: #ef4444;
}

.stat-change-label {
  font-size: 12px;
  color: #9ca3af;
  margin-left: 4px;
}

.stat-icon-container {
  padding: 16px;
  border-radius: 12px;
  background: linear-gradient(135deg, rgba(25, 118, 210, 0.1) 0%, rgba(25, 118, 210, 0.05) 100%);
  display: flex;
  align-items: center;
  justify-content: center;
}

.stat-card-primary .stat-icon-container {
  background: linear-gradient(135deg, rgba(25, 118, 210, 0.1) 0%, rgba(25, 118, 210, 0.05) 100%);
}

.stat-card-success .stat-icon-container {
  background: linear-gradient(135deg, rgba(76, 175, 80, 0.1) 0%, rgba(76, 175, 80, 0.05) 100%);
}

.stat-card-warning .stat-icon-container {
  background: linear-gradient(135deg, rgba(255, 152, 0, 0.1) 0%, rgba(255, 152, 0, 0.05) 100%);
}

.stat-card-info .stat-icon-container {
  background: linear-gradient(135deg, rgba(156, 39, 176, 0.1) 0%, rgba(156, 39, 176, 0.05) 100%);
}
</style>

