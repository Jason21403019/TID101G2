<template>
  <section>
    <canvas id="Chart"></canvas>
    <canvas id="Chart2"></canvas>
    <canvas id="Chart3"></canvas>
  </section>
</template>
<script>
import '../../node_modules/chart.js'
const ctx = document.getElementById('Chart')
const labels = ['一月份', '二月份', '三月份', '四月份', '五月份', '六月份', '七月份'] // 设置 X 轴上对应的标签
const data = {
  labels: labels,
  datasets: [
    {
      label: '每月銷售額',
      data: [65, 59, 80, 81, 56, 55, 40],
      fill: true, // 填滿折線圖
      borderColor: ' #381B1D', // 设置线的颜色
      backgroundColor: 'rgba(255, 165, 0, 0.5)', //
      backgroundColor: '#FCF0D8', // 设置点的填充色
      pointStyle: 'circle', //设置点类型为圆点
      pointRadius: 6, //设置圆点半径
      pointHoverRadius: 10, //设置鼠标移动上去后圆点半径
      pointHoverBackgroundColor: ' #381B1D',
      tension: 0.4 //線彎曲程度
    }
  ]
}
const config = {
  type: 'line', // 设置图表类型
  data: data,
  options: {
    responsive: true, // 设置图表为响应式

    interaction: {
      // 设置每个点的交互
      intersect: false
    },
    scales: {
      // 设置 X 轴与 Y 轴
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
const myChart = new Chart(ctx, config)
// --------------------------
const ctx2 = document.getElementById('Chart2').getContext('2d')
const labels2 = ['一月份', '二月份', '三月份', '四月份', '五月份', '六月份', '七月份']
const data2 = {
  labels: labels2,
  datasets: [
    {
      label: '每月會員人數',
      data: [65, 59, 80, 81, 56, 55, 40],
      fill: true, // 填滿折線圖
      borderColor: ' #381B1D', // 设置线的颜色
      backgroundColor: 'rgba(255, 165, 0, 0.5)', //
      backgroundColor: '#FCF0D8', // 设置点的填充色
      pointStyle: 'circle', //设置点类型为圆点
      pointRadius: 6, //设置圆点半径
      pointHoverRadius: 10, //设置鼠标移动上去后圆点半径
      pointHoverBackgroundColor: ' #381B1D',
      tension: 0.4 //線彎曲程度
    }
  ]
}
const config2 = {
  type: 'line',
  data: data2,
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
const myChart2 = new Chart(ctx2, config2)
//   --------------------------------
const ctx3 = document.getElementById('Chart3').getContext('2d')
const labels3 = ['一月份', '二月份', '三月份', '四月份', '五月份', '六月份', '七月份']
const data3 = {
  labels: labels3,
  datasets: [
    {
      label: '每月訂位數量',
      data: [65, 59, 80, 81, 56, 55, 40],
      fill: true, // 填滿折線圖
      borderColor: ' #381B1D', // 设置线的颜色
      backgroundColor: 'rgba(255, 165, 0, 0.5)', //
      backgroundColor: '#FCF0D8', // 设置点的填充色
      pointStyle: 'circle', //设置点类型为圆点
      pointRadius: 6, //设置圆点半径
      pointHoverRadius: 10, //设置鼠标移动上去后圆点半径
      pointHoverBackgroundColor: ' #381B1D',
      tension: 0.4 //線彎曲程度
    }
  ]
}
const config3 = {
  type: 'line',
  data: data3,
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
const myChart3 = new Chart(ctx3, config3)
</script>
<style>
section {
  width: 100%;
  justify-content: space-between;
  display: flex;
  canvas {
    width: 30% !important; /* 設置寬度 */
    height: 300px !important; /* 設置高度 */
  }
}
</style>
