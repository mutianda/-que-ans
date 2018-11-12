<template>
  <el-main class="main" width="95%">
    <div class="pinglun" style="font-size: 20px"><i class="el-icon-edit"></i>写求助</div>
    <div class="cont">
      <div class="box">
        <div class="title">我的提问</div>
        <div class="que">
          <el-input
            size="mini"
            clearable
            type="textarea"
            :autosize="{ minRows: 1, maxRows: 2}"
            placeholder="请输入问题标题..."
            v-model="title"
          style="margin-bottom: 30px;width: 60%">
          </el-input>
          <el-input
            size="mini"
            clearable
            type="textarea"
            :autosize="{ minRows: 5, maxRows: 7}"
            placeholder="请输入问题内容..."
            v-model="quecont">
          </el-input>
        </div>
        <el-button  round @click="out">退出</el-button>
        <el-button type="success" round @click="doSend">发送</el-button>
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
      quecont: '',
      title: ''
    }
  },
  methods: {
    doSend () {
      console.log(this.quecont)
      const userid = window.localStorage.id
      const username = window.localStorage.username
      console.log(window.localStorage.username)
      const params = new URLSearchParams()
      params.append('username', username)
      params.append('title', this.title)
      params.append('quecont', this.quecont)
      params.append('id', userid)
      axios.post('http://localhost/que-ans/publish.php', params).then((res) => {
        console.log(res.data)
        if (res.data.code === 200) {
          this.$message.success(res.data.msg)
          this.$router.push({path: '/home/index'})
        } else {
          this.$message.error(res.data.msg)
        }
      })
    },
    out () {
      this.$router.go(-1)
    }
  }
}
</script>
<style scoped lang="stylus">
.main
  border-radius 15px
  border-radius 15px
  background-color: #222
  .cont
    width 100%
    margin-top 50px
    .box
      width 60%
      padding 30px 50xp
      border-bottom  white solid 1px
      color white
      margin  0 auto
      .title
        color whitesmoke
        font-size 25px
        line-height 60px
        height 60px
        margin-bottom 30px
      .que
        font-size 13px
        .el-input
          width 50%
      .el-button
        margin 20px 50px
</style>
