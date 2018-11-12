<template>
  <el-main class="main" width="95%">
    <div class="pinglun" style="font-size: 20px">我的求助</div>
    <div class="cont">
      <div class="box" v-for="item in que" :key="item.id">
        <div class="title"  >
          <span class="title">  {{item.title}}</span>
        </div>
        <div class="que">
          <span> {{item.content}}</span>
        </div>
        <router-link :to="'/home/detail/' + item.id">  <el-button type="primary" round>评论{{item.pinglun}}</el-button></router-link>
        <el-button type="success" round @click="open(item)">编辑</el-button>
        <el-dialog
          title="指点迷津"
          :visible.sync="dialogVisible"
          width="30%"
          :before-close="handleClose">
          <el-input
            size="mini"
            clearable
            placeholder="请输入指点内容..."
            v-model="quetitle">
          </el-input>
          <el-input
            size="mini"
            clearable
            type="textarea"
            :autosize="{ minRows: 5, maxRows: 7}"
            placeholder="请输入指点内容..."
            v-model="content">
          </el-input>
          <span slot="footer" class="dialog-footer">
    <el-button @click="dialogVisible = false">取 消</el-button>
    <el-button type="primary" @click="editque">发送</el-button>
  </span>
        </el-dialog>
        <el-row style="height: 50px;line-height: 50px">
          <el-col :span="6"> <div class="queuser">我的求助</div></el-col>
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
      queid: '',
      quetitle: '',
      content: '',
      dialogVisible: false
    }
  },
  created () {
    axios({
      method: 'get',
      url: 'http://localhost/que-ans/myque.php',
      params: {
        userid: window.localStorage.id
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
    open (item) {
      console.log(item)
      this.queid = item.id
      console.log(item)
      this.quetitle = item.title
      this.content = item.content
      this.dialogVisible = true
    },
    editque () {
      console.log(this.content)
      const params = new URLSearchParams()
      params.append('title', this.quetitle)
      params.append('quecont', this.content)
      params.append('id', this.queid)
      params.append('username', window.localStorage.username)
      axios.post('http://localhost/que-ans/edit.php', params).then((res) => {
        console.log(res.data)
        if (res.data.code === 200) {
          this.$message.success(res.data.msg)
          this.dialogVisible = false
          this.$router.go(0)
        } else {
          this.$message.error(res.data.msg)
        }
      })
    }
  }
}
</script>
<style scoped lang="stylus" >
  .main
    height: 1300px;
    border-radius 15px
    background-color: #222;
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
          margin 20px 30px
</style>
