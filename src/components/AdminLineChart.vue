<template>
  <section>
    <canvas id="Chart"></canvas>
    <canvas id="Chart2"></canvas>
    <canvas id="Chart3"></canvas>
  </section>
</template>

<script>
import Chart from 'chart.js/auto'

export default {
  mounted() {
    this.renderChart1()
    this.renderChart2()
    this.renderChart3()
  },
  methods: {
    renderChart1() {
      const ctx = document.getElementById('Chart').getContext('2d')
      const labels = ['一月份', '二月份', '三月份', '四月份', '五月份', '六月份', '七月份']
      const data = {
        labels: labels,
        datasets: [
          {
            label: '每月銷售額',
            data: [32500, 43209, 50280, 35181, 24556, 43255, 28440],
            fill: true,
            borderColor: '#381B1D',
            backgroundColor: '#FCF0D8',
            pointStyle: 'circle',
            pointRadius: 6,
            pointHoverRadius: 10,
            pointHoverBackgroundColor: '#381B1D',
            tension: 0.4
          }
        ]
      }
      const config = {
        type: 'line',
        data: data,
        options: {
          responsive: true,
          interaction: {
            intersect: false
          },
          scales: {
            x: {
              display: true,
              title: {
                display: true,
                text: '日期'
              }
            },
            y: {
              display: true,
              title: {
                display: true,
                text: '金額'
              }
            }
          },
          plugins: {
            title: {
              display: true,
              text: '銷售總額圖表',
              font: {
                size: 20
              }
            }
          }
        }
      }
      new Chart(ctx, config)
    },
    renderChart2() {
      const ctx = document.getElementById('Chart2').getContext('2d')
      const labels = ['一月份', '二月份', '三月份', '四月份', '五月份', '六月份', '七月份']
      const data = {
        labels: labels,
        datasets: [
          {
            label: '每月會員人數',
            data: [625, 469, 530, 231, 166, 335, 500],
            fill: true,
            borderColor: '#381B1D',
            backgroundColor: '#FCF0D8',
            pointStyle: 'circle',
            pointRadius: 6,
            pointHoverRadius: 10,
            pointHoverBackgroundColor: '#381B1D',
            tension: 0.4
          }
        ]
      }
      const config = {
        type: 'line',
        data: data,
        options: {
          responsive: true,
          interaction: {
            intersect: false
          },
          scales: {
            x: {
              display: true,
              title: {
                display: true,
                text: '日期'
              }
            },
            y: {
              display: true,
              title: {
                display: true,
                text: '會員人數'
              }
            }
          },
          plugins: {
            title: {
              display: true,
              text: '會員人數圖表',
              font: {
                size: 20
              }
            }
          }
        }
      }
      new Chart(ctx, config)
    },
    renderChart3() {
      const ctx = document.getElementById('Chart3').getContext('2d')
      const labels = ['一月份', '二月份', '三月份', '四月份', '五月份', '六月份', '七月份']
      const data = {
        labels: labels,
        datasets: [
          {
            label: '每月訂位數量',
            data: [65, 59, 80, 81, 56, 55, 40],
            fill: true,
            borderColor: '#381B1D',
            backgroundColor: '#FCF0D8',
            pointStyle: 'circle',
            pointRadius: 6,
            pointHoverRadius: 10,
            pointHoverBackgroundColor: '#381B1D',
            tension: 0.4
          }
        ]
      }
      const config = {
        type: 'line',
        data: data,
        options: {
          responsive: true,
          interaction: {
            intersect: false
          },
          scales: {
            x: {
              display: true,
              title: {
                display: true,
                text: '日期'
              }
            },
            y: {
              display: true,
              title: {
                display: true,
                text: '預約人數'
              }
            }
          },
          plugins: {
            title: {
              display: true,
              text: '訂位數量圖表',
              font: {
                size: 20
              }
            }
          }
        }
      }
      new Chart(ctx, config)
    }
  }
}
</script>

<style lang="scss" scoped>
section {
  width: 100%;
  justify-content: space-between;
  display: flex;
}
canvas {
  width: 30% !important;
  height: 300px !important;
}
</style>
