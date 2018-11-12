<template>
<el-container class="container-head">
  <el-header class="header">
    <div class="tab1">
      <router-link tag="div" class="tab-item" to="/home/index">
        <span class="tab-link"><i class="iconfont" style="font-size: 30px">&#xe626;</i> </span>
      </router-link>
      <router-link tag="div" class="tab-item" to="/home/hotque">
        <span class="tab-link">热门提问<i class="iconfont" style="color: red">&#xe600;</i></span>
      </router-link>
      <router-link tag="div" class="tab-item" to="/home/hotans">
      <span class="tab-link">热门解答<i class="iconfont" style="color: red">&#xe600;</i>
      </span>
      </router-link>
      <router-link tag="div" class="tab-item" to="/login">
        <span class="tab-link" @click="logout">退出<i class="iconfont">&#xe70a;</i></span>
      </router-link>
    </div>
    </el-header>
  <el-container class="container">
  <el-aside  class="right" width="10%">
    <div class="tab2">
    <router-link tag="div" class="tab-item" to="/home/myans">
      <span class="tab-link">我的<i class="iconfont ans" >&#xe629;</i></span>
    </router-link>
    <router-link tag="div" class="tab-item" to="/home/myques">
      <span class="tab-link">我的<i class="iconfont que">&#xe6b5;</i></span>
    </router-link>
      <router-link tag="div" class="tab-item" to="/home/wirte">
        <span class="tab-link">求解<i class="iconfont help">&#xe602;</i></span>
      </router-link>
    </div>
  </el-aside>
    <router-view></router-view>
  </el-container>
  </el-container>
</template>
<style lang="stylus" rel="stylesheet/stylus" scoped>
  .container-head .el-button{
    margin:10px 60px;
    border: none;
  }
  .container{
  }
  .header
    width: 100%;
    height: 60px;
    color: #333
    background-color black
    .tab1
      display flex
      height 60px
      width 70%
      float right
      line-height 60px
      display flex
      min-font-size 10px
      .tab-item
        flex: 1
        text-align: center
        .tab-link
          padding-bottom: 5px
          color: #888
          font-size 15px
          .iconfont
            font-size 20px
            min-font-size 10px
        &.router-link-active
          .tab-link
            color aqua
            border-bottom: 2px solid aqua
  .right
    min-width: 50px;
    min-font-size 10px
    opacity: 0.5
    .tab2
      flex-direction column
      height 180px
      text-align center
      line-height 80px
      display flex
      .tab-item
        flex: 1
        text-align: center
        .tab-link
          padding-bottom: 5px
          color: #888
          font-size: 20px;
          .iconfont
            font-size: 20px;padding-left: 5px
        &.router-link-active
          .tab-link
            color aqua
            border-bottom: 2px solid aqua
          .iconfont
            color: cornflowerblue;font-size: 20px;padding-left: 5px
          .ans
            color: darksalmon
          .que
            color: cornflowerblue
          .help
            color: deepskyblue

</style>

<script>
export default {
  data () {
    const item = {
      date: '2016-05-02',
      name: '王小虎',
      address: '上海市普陀区金沙江路 1518 弄'
    }
    return {
      tableData: Array(20).fill(item)
    }
  },
  methods: {
    logout () {
      window.localStorage.removeItem('username')
      console.log(window.localStorage.username)
      window.localStorage.removeItem('iphone')
      this.$router.push('/login')
    }
  }
}
</script>
