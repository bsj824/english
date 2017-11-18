<template>
  <div class="overview">
    <div class="head_stat">
      <div class="item link" @click="$router.push({name: 'articleList'})">
        <Icon style="color: #37c8f7;" class="icon" type="document"></Icon>
        <div class="inline">
          <div class="num">{{statistics.posts ? statistics.posts : 0}}</div>
          <div class="text">文章</div>
        </div>
      </div>
      <div class="item">
        <Badge class="badge" overflow-count="999" v-if="statistics.nowPVUV.unique_visitor - statistics.yesterdayPVUV.unique_visitor > 0" :count="statistics.nowPVUV.unique_visitor - statistics.yesterdayPVUV.unique_visitor"></Badge>
        <Icon style="color: #ff7e9c;" class="icon" type="arrow-graph-up-right"></Icon>
        <div class="inline">
          <div class="num">{{statistics.nowPVUV ? statistics.nowPVUV.unique_visitor : 0}}</div>
          <div class="text">今日UV</div>
        </div>
      </div>
      <div class="item">
        <Badge class="badge" overflow-count="999" v-if="statistics.nowPVUV.page_view - statistics.yesterdayPVUV.page_view > 0" :count="statistics.nowPVUV.page_view - statistics.yesterdayPVUV.page_view"></Badge>
        <Icon class="icon" style="color: #fcba2c;" type="stats-bars"></Icon>
        <div class="inline">
          <div class="num">{{statistics.nowPVUV ? statistics.nowPVUV.page_view : 0}}</div>
          <div class="text">今日PV</div>
        </div>
      </div>
      <div class="item link" @click="$router.push({name: 'userList'})">
        <Icon class="icon" style="color: #bc67db;" type="person"></Icon>
        <div class="inline">
          <div class="num">{{statistics.users ? statistics.users : 0}}</div>
          <div class="text">用户</div>
        </div>
      </div>
    </div>
    <div class="chart_pannel">
      <line-chart :options="options" :height="100" :chart-data="chartData"></line-chart>
    </div>
  </div>
</template>

<script>
import LineChart from '../components/LineChart.vue';
export default {
  components: { LineChart },
  data () {
    return {
      statistics: {
        nowPVUV: {},
        yesterdayPVUV: {},
        recentlyPVUV: []
      },
      chartData: null,
      options: {
        responsive: true,
        title: {
          display: true,
          text: '近期访问量'
        },
        tooltips: {
          mode: 'index',
          intersect: false,
        },
        hover: {
          mode: 'nearest',
          intersect: true
        },
        scales: {
          xAxes: [{
            display: true,
            gridLines: {
              display: true
            },
            scaleLabel: {
              display: true,
              labelString: '日期'
            }
          }],
          yAxes: [{
            gridLines: {
              display: true
            },
          }]
        }
      }
    };
  },
  mounted () {
    this.$http.get('statistics').then(res => {
      this.statistics = res.data;
      let currentDate = new Date();
      let chartData = {
        labels: [],
        datasets: [
          {
            label: 'pv',
            fill: false,
            backgroundColor: 'rgb(255, 205, 86)',
            borderColor: 'rgb(255, 205, 86)',
            data: []
          },
          {
            label: 'uv',
            fill: false,
            backgroundColor: '#f87979',
            borderColor: '#f87979',
            data: []
          }
        ]
      };
      this.statistics.recentlyPVUV.forEach(item => {
        chartData.labels.push(new Date(currentDate -= 86400000).toLocaleDateString().substr(5));
        chartData.datasets[0].data.push(item.page_view);
        chartData.datasets[1].data.push(item.unique_visitor);
      });
      chartData.labels.reverse();
      this.chartData = chartData;
    });
  }
};
</script>

<style scoped lang="less">
  .head_stat{
    height: 160px;
    border-radius: 4px;
    background-color: #fff;
    margin-bottom: 20px;
    padding: 30px 0;
    text-align: center;
    box-shadow: 1px 1px 2px #dfe5ed;
    .item{
      width: 25%;
      height: 100px;
      border-right: 1px solid #e5e9ef;
      float: left;
      position: relative;
      &.link{
        cursor: pointer;
      }
      .badge{
        position: absolute;
        right: 45px;
        top: 10px;
      }
      &:last-child{
        border-right: none;
      }
      .icon{
        margin-right: 20px;
        font-size: 60px;
        position: relative;
        top: -3px;
      }
      .inline{
        display: inline-block;
        position: relative;
        top: 17px;
        .num{
          font-size: 36px;
          font-family: Arial;
          text-align: left;
          color: #6d757a;
        }
        .text{
          font-size: 16px;
          text-align: left;
          color: #99a2aa;
        }
      }
    }
  }
  .chart_pannel{
    margin-top: 30px;
  }
</style>
