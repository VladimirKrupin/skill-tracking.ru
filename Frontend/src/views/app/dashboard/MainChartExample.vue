<script>
import { Line } from 'vue-chartjs'
import { getStyle, hexToRgba } from '@coreui/coreui/dist/js/coreui-utilities'
import { CustomTooltips } from '@coreui/coreui-plugin-chartjs-custom-tooltips'
import { random } from '@/shared/utils'

export default {
  extends: Line,
  props: ['height','skillData'],
  mounted () {
    const brandSuccess = getStyle('--success') || '#4dbd74';
    const brandInfo = getStyle('--info') || '#20a8d8';
    const brandDanger = getStyle('--danger') || '#f86c6b';

    let bgs = [brandSuccess,brandInfo,brandDanger];

    let elements = 27
    const data1 = [1,2,3,4,5,6,7,8,9]
    const data2 = [11,22,33,44,55,66]
    const data3 = [0,0,0,0,0,0,0,0,0]

    // for (let i = 0; i <= elements; i++) {
    //   data1.push(random(50, 200))
    //   data2.push(random(80, 100))
    //   data3.push(65)
    // }
    //   console.log(this.skillData);
      console.log(this.skillData.points);
    let points = this.skillData.points;
    let datasets = [];
    Object.keys(points).map(function (key,index) {
        let data = [];
        let new_values = points[index].new_values;
        Object.keys(new_values).map(function (k,i) {
            let val = new_values[k].value;
            if (points[index].units_type === 'time'){
                val = val/60/60;
            }
            data.push(val);
        });
        // console.log(k);
        datasets.push({
            label: points[index].title,
            backgroundColor: hexToRgba(brandInfo, 10),
            borderColor: bgs[key],
            pointHoverBackgroundColor: '#fff',
            borderWidth: 2,
            data: data
        });
    });
    this.renderChart({
      labels: ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su'],
      datasets: datasets
    }, {
      tooltips: {
        enabled: false,
        custom: CustomTooltips,
        intersect: true,
        mode: 'index',
        position: 'nearest',
        callbacks: {
          labelColor: function (tooltipItem, chart) {
            return { backgroundColor: chart.data.datasets[tooltipItem.datasetIndex].borderColor }
          }
        }
      },
      maintainAspectRatio: false,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines: {
            drawOnChartArea: false
          }
        }],
        yAxes: [{
          ticks: {
            beginAtZero: true,
            maxTicksLimit: 5,
            stepSize: Math.ceil(250 / 5),
            max: 50
          },
          gridLines: {
            display: true
          }
        }]
      },
      elements: {
        point: {
          radius: 0,
          hitRadius: 10,
          hoverRadius: 4,
          hoverBorderWidth: 3
        }
      }
    })
  }
}
</script>
