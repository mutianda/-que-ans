<template>
  <el-main class="main" width="95%">
    <div class="cont">
      <div class="box">
        <div class="title">{{que.title}}</div>

        <div class="que">
          {{que.content}}
        </div>
        <el-button type="success" round @click="dialogVisible = true">解答</el-button>
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
        <el-col :span="6"> <div class="queuser">提问者：{{que.username}}</div></el-col>
        <el-col :span="12">   <div class="ctime">{{que.create_time}}</div></el-col>
        <el-col :span="6"> <i class="el-icon-view" style="padding-right: 20px"></i>{{que.view}}</el-col>
      </el-row>
      </div>
    </div>
    <div class="ans">
      <div class="pinglun">评论区</div>
      <div class="cont">
        <div class="box" v-for="item in ans" :key="item.id">
          <div class="ansitem">
            {{item.content}}
          </div>
          <el-row style="height: 50px;line-height: 50px">
            <el-col :span="6"> <div class="queuser">回答人：{{item.username}}</div></el-col>
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
      que: [],
      dialogVisible: false,
      myans: '',
      ans: ''
    }
  },
  created () {
    const id = this.$route.params.id
    console.log(id)
    axios({
      method: 'get',
      url: 'http://localhost/que-ans/detail.php',
      params: {
        queid: this.$route.params.id
      }
    }).then((res) => {
      if (res.data) {
        if (res.data.code === 200) {
          this.que = res.data.que
          this.ans = res.data.ans
        } else {
          this.$message.error(res.data.msg)
        }
        console.log(res.data)
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
    doMyans () {
      const username = window.localStorage.username
      const userid = window.localStorage.id
      const params = new URLSearchParams()
      params.append('username', username)
      params.append('content', this.myans)
      params.append('userid', userid)
      params.append('queid', this.$route.params.id)
      axios.post('http://localhost/que-ans/getAns.php', params).then((res) => {
        if (res.data) {
          if (res.data.code === 200) {
            this.$message.success(res.data.msg)
            this.dialogVisible = false
            this.$router.go(0)
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
    min-height 900px
    background-color: #222;
    border-radius 15px
    .pinglun
      font-size 20px
      height 60px
      line-height 60px
    .cont
      width 100%
      margin-top 20px
      .box
        width 100%
        padding 10px 50xp
        border-bottom  white solid 1px
        color white
        .title
          color aqua
          font-size 25px
          margin-bottom 30px
        .que
          font-size 19px
          padding 10px 5px 50px 6px
  .ans
    margin 0 auto
    border-bottom  1px solid #eee
    .cont
      width 100%
      margin-top 10px
      .box
        width 100%
        padding 10px 30xp
        color white
        .ansitem
          padding-top 20px
          font-size 13px
</style>
