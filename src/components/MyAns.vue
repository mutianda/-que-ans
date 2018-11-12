<template>
  <el-main class="main" width="95%">
    <div class="ans">
      <div class="pinglun" style="font-size: 20px">我的评论</div>
      <div class="cont">
        <div class="box" v-for="item in ans" :key="item.id">
          <div class="ansitem">
            {{item.content}}
          </div>
          <router-link :to="'/home/detail/' + item.queid">  <el-button type="primary" round>详情{{item.pinglun}}</el-button></router-link>
          <el-row style="height: 50px;line-height: 50px">
            <el-col :span="6"> <div class="queuser">回答人：{{item.username}}</div>
           </el-col>
            <el-col :span="12">   <div class="ctime">{{item.create_time}}</div></el-col>
            <el-col :span="6"> <i class="el-icon-view" style="padding-right: 20px"></i>{{item.view}}</el-col>
          </el-row>
          <!--<el-button  icon=" el-icon-view" circle  style="position: absolute;right: 20px">{{item.view}}</el-button>-->
        </div>
      </div>
    </div>
  </el-main>
</template>
<script>
import axios from 'axios'
export default {
  name: '',
  data () {
    return {
      ans: []
    }
  },
  created () {
    axios({
      method: 'get',
      url: 'http://localhost/que-ans/myans.php',
      params: {
        userid: window.localStorage.id
      }
    }).then((res) => {
      if (res.data) {
        console.log(res.data)
        this.ans = res.data
      } else {
        this.$message.error('网络出错')
      }
    })
  }
}
</script>
<style scoped lang="stylus" >
  .main
    height: 1300px;
    border-radius 15px
    background-color: #222;
    .ans
      width 100%
      .cont
        width 100%
        margin-top 50px
        .box
          width 100%
          border-bottom  white solid 1px
          color white
          .ansitem
            width 100%
            padding 20px 10px
          .que
            font-size 13px
          .el-button
            margin 20px 30px
</style>
