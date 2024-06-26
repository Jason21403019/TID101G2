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
  data() {
    return {
      phpdata: []
    }
  },
  mounted() {
    this.fetchAdminLineChart()
  },
  methods: {
    renderChart1() {
      const ctx = document.getElementById('Chart').getContext('2d')
      const labels = this.phpdata.data2.map((item) => this.getMonthName(item.month))
      const data = {
        labels: labels,

        datasets: [
          {
            label: '每月訂單量',
            data: this.phpdata.data2.map((item) => item.counts),
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
                text: '數量'
              }
            }
          },
          plugins: {
            title: {
              display: true,
              text: '訂單總量圖表',
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
      const labels = this.phpdata.data3.map((item) => this.getMonthName(item.month))
      const data = {
        labels: labels,
        data: this.phpdata.data3.map((item) => item.total),
        datasets: [
          {
            label: '每月銷售額',
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
    renderChart3() {
      const ctx = document.getElementById('Chart3').getContext('2d')
      const labels = this.phpdata.data.map((item) => this.getMonthName(item.month))
      const data = {
        labels: labels,

        datasets: [
          {
            label: '每月訂位數量',
            data: this.phpdata.data.map((item) => item.counts),
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
    },
    getMonthName(month) {
      const monthNames = [
        '一月份',
        '二月份',
        '三月份',
        '四月份',
        '五月份',
        '六月份',
        '七月份',
        '八月份',
        '九月份',
        '十月份',
        '十一月份',
        '十二月份'
      ]
      return monthNames[parseInt(month) - 1] // 將數字月份轉換為對應的中文月份名稱
    },

    // php
    fetchAdminLineChart() {
      fetch('http://localhost/TID101G2/public/api/AdminLineChart.php')
        .then((response) => response.json())
        .then((data) => {
          this.phpdata = data // 將從 PHP 獲取的資料存儲到 Vue 的 data 屬性中
          this.renderChart1() // 数据加载成功后渲染图表
          this.renderChart2()
          this.renderChart3()
        })
        .catch((error) => console.error('Error fetching data:', error))
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
