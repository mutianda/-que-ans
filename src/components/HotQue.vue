<template>
  <el-main class="main" width="95%">
    <div class="pinglun" style="font-size: 20px">热门区</div>
    <div class="cont">
      <div class="box" v-for="item in que" :key="item.id">
        <div class="title">{{item.title}}</div>
        <div class="que">
          {{item.content}}
        </div>
        <router-link :to="'/home/detail/' + item.id">  <el-button type="primary" round>评论{{item.pinglun}}</el-button></router-link>
        <el-button type="success" round @click="open(item.id)">解答</el-button>
        <el-dialog
          title="指点迷津"
          :visible.sync="dialogVisible"
          width="30%"
          :before-close="handleClose">
          <el-input
            size="mini"
            clearable
            type="textarea"
            :autosize="{ minRows: 5, maxRows: 7}"
            placeholder="请输入指点内容..."
            v-model="myans">
          </el-input>
          <span slot="footer" class="dialog-footer">
    <el-button @click="dialogVisible = false">取 消</el-button>
    <el-button type="primary" @click="doMyans">确 定</el-button>
  </span>
        </el-dialog>
        <el-row style="height: 50px;line-height: 50px">
          <el-col :span="6"> <div class="queuser">提问者：{{item.username}}</div></el-col>
          <el-col :span="12">   <div class="ctime">{{item.create_time}}</div></el-col>
          <el-col :span="6"> <i class="el-icon-view" style="padding-right: 20px"></i>{{item.view}}</el-col>
        </el-row>
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
      que: [],
      dialogVisible: false,
      myans: '',
      queid: ''
    }
  },
  created () {
    axios({
      method: 'get',
      url: 'http://localhost/que-ans/index.php',
      params: {
        kind: 'view'
      }
    }).then((res) => {
      if (res.data) {
        console.log(res.data)
        this.que = res.data
      } else {
        this.$message.error('网络出错')
      }
    })
  },
  methods: {
    handleClose (done) {
      this.$confirm('确认关闭？')
        .then(_ => {
          done()
        })
        .catch(_ => {})
    },
    open (id) {
      console.log(id)
      this.queid = id
      this.dialogVisible = true
    },
    doMyans () {
      const username = window.localStorage.username
      const userid = window.localStorage.id
      const params = new URLSearchParams()
      params.append('username', username)
      params.append('content', this.myans)
      params.append('userid', userid)
      params.append('queid', this.queid)
      axios.post('http://localhost/que-ans/getAns.php', params).then((res) => {
        if (res.data) {
          if (res.data.code === 200) {
            console.log(res.data)
            this.$message.success(res.data.msg)
            this.dialogVisible = false
          } else {
            this.$message.error(res.data.msg)
          }
        } else {
          this.$message.error('网络错误')
        }
      }
      )
    }
  }
}
</script>
<style scoped lang="stylus" >
  .main
    border-radius 15px
    background-color: #111;
    .cont
      width 100%
      margin-top 50px
      .box
        width 100%
        padding 30px 50xp
        border-bottom  white solid 1px
        color white
        .title
          color aqua
          font-size 25px
          line-height 60px
          height 60px
          margin-bottom 30px
        .que
          font-size 13px
        .el-button
          margin 20px 50px
</style>
