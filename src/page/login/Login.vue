<template>
  <div class="login-root" >
    <div class="login-container">
      <div class="login-meta">
        <div class="systitle">
        <p >Searching  For  The  End  Of  Truth</p>
      </div>
      <div class="login-form" @keyup.enter="doLogin" v-if="show">
        <label class="form-b">
          <i class="phone"></i>
          <el-input type="text" maxlength="11" v-model="phonenum"  placeholder="请输入手机号" autocomplete="off" ></el-input>
        </label>
        <label class="form-b">
          <i class="password"></i>
          <el-input type="password"  v-model="password"  placeholder="请输入密码" autocomplete="off" ></el-input>
        </label>
        <!--<a href="javascript:;" class="forget-psw" @click="findpsw">忘记密码？</a>-->
        <el-button class="get-padding do-login" type="primary" @click="doLogin" :disabled="this.phonenum.length!==11||this.password.length==0">登录</el-button>
      </div>
    </div>
  </div>
  </div>
</template>
<script>
import axios from 'axios'
export default {
  data () {
    return {
      phonenum: '',
      password: '',
      passwordcheck: '',
      vercode: '',
      focus: false,
      focus2: false,
      focus3: false,
      focus4: false,
      error1: '',
      error2: '',
      error4: '',
      error3: '',
      showerror1: false,
      showerror2: false,
      showerror3: false,
      showerror4: false,
      show: true,
      eyes: 'password'
      // eyesshow: '../assets/common/no-show.png'
    }
  },
  methods: {
    checkValidity () {
      if (!this.checkPhone()) {
        return false
      }
      if (!this.password) {
        this.error2 = '密码不能为空'
        this.showerror2 = true
        return false
      }
      return true
    },
    checkPhone () {
      if (!this.phonenum) {
        this.error1 = '手机号不能为空'
        this.showerror1 = true
        return false
      }
      if (!/^1([358][0-9]|4[579]|66|7[0135678]|9[89])[0-9]{8}$/.test(this.phonenum)) {
        this.error1 = '请填写正确手机号'
        this.showerror1 = true
        return false
      }
      return true
    },
    checkvercode () {
      if (!this.checkPhone()) {
        return false
      }
      if (!this.vercode) {
        this.error2 = '验证码不能为空'
        this.showerror2 = true
        return false
      }
      return true
    },
    checkpassword () {
      if (!this.checkvercode()) {
        return false
      }
      console.log(this.password)
      if (!this.password) {
        this.error3 = '密码不能为空'
        this.showerror3 = true
        return false
      }
      if (this.password.length < 6) {
        this.error3 = '密码长度6位以上'
        this.showerror3 = true
        return false
      }
      return true
    },
    checkAll () {
      if (!this.checkpassword()) {
        return false
      }
      if (!this.passwordcheck) {
        this.error4 = '确认密码不能为空'
        this.showerror4 = true
        return false
      }
      if (this.password !== this.passwordcheck) {
        this.error4 = '两次密码不一致'
        this.showerror4 = true
        return false
      }
      return true
    },
    doLogin () {
      if (this.checkValidity()) {
        axios({
          method: 'get',
          url: 'http://localhost/que-ans/login.php',
          params: {
            username: this.phonenum,
            password: this.password
          }
        }).then((res) => {
          console.log(res.data)
          if (res.data) {
            const code = res.data.code
            if (code === 200) {
              var storage = window.localStorage
              // let storage.user = {}
              storage.setItem('username', res.data.res[0].username)
              console.log(storage.username)
              storage.setItem('iphone', res.data.res[0].iphone)
              storage.setItem('id', res.data.res[0].id)
              this.$router.push(
                {path: '/home/index'})
            } else {
              this.$message.error(res.data.msg)
            }
          } else {
            this.$message.error('登录出错')
          }
        })
      }
    },
    // if (this.checkValidity()) {
    //   // userSignin({
    //   //   mobilePhone: this.phonenum,
    //   //   password: this.password,
    //   //   platform: 'WEB'
    //   // })
    //   .then((res) => {
    //     console.log(res.data)
    //     if (res.data.code === 2001) {
    //       this.error1 = res.data.message
    //       this.showerror1 = true
    //     } else if (res.data.code === 2003) {
    //       this.error2 = res.data.message
    //       this.showerror2 = true
    //     } else if (res.data.code === 1000) {
    //       console.log('aa')
    //     } else {
    //       this.$message.error(res.data.message)
    //     }
    //   }, (error) => {
    //     console.log(error)
    //   })
    // }

    // doFind () {
    //   if (!this.checkAll()) {
    //     return false
    //   }
    //   findPsw({
    //     mobilePhone: this.phonenum,
    //     password: this.password,
    //     smsCode: this.vercode,
    //     platform: 'WEB'
    //   }).then((res) => {
    //     console.log(res.data)
    //     if (res.data.code === 2001) {
    //       this.error1 = res.data.message
    //       this.showerror1 = true
    //     } else if (res.data.code === 2002) {
    //       this.error2 = res.data.message
    //       this.showerror2 = true
    //     } else if (res.data.code === 1000) {
    //       this.show = !this.show
    //       this.$message.success('密码修改成功！请重新登录')
    //       this.password = ''
    //       this.vercode = ''
    //       this.passwordcheck = ''
    //     }
    //   }, (error) => {
    //     console.log(error)
    //   })

    showPsw () {
      if (this.eyes === 'password') {
        this.eyes = 'text'
        console.log(this.eyes)
      } else {
        this.eyes = 'password'
        console.log(this.eyes)
      }
    },
    focusOne () {
      this.focus = !this.focus
      this.showerror1 = false
    },
    focusTwo () {
      this.focus2 = !this.focus2
      this.showerror2 = false
    },
    focusThree () {
      this.focus3 = !this.focus3
      this.showerror3 = false
    },
    focusFour () {
      this.focus4 = !this.focus4
      this.showerror4 = false
    },
    clearphonenum () {
      this.phonenum = ''
    },
    clearpassword () {
      this.password = ''
    }
    // sendCode (e) {
    //   let count = 59
    //   let target = e.target || e.srcElement
    //
    //   if (~target.className.indexOf('disabled')) {
    //     return
    //   }
    //   if (!this.checkPhone()) {
    //     return
    //   }
    //   getSMSCode({
    //     mobilePhone: this.phonenum
    //   }).then((res) => {
    //     console.log('res: ' + res)
    //     if (res.data.code === 1000) {
    //       console.log(res.data.data)
    //       target.className = 'disabled'
    //       let stid = setInterval(function () {
    //         target.innerText = count + 'S'
    //         count--
    //         if (count < 0) {
    //           target.innerText = '重新发送'
    //           clearInterval(stid)
    //           target.className = ''
    //         }
    //       },
    //       1000)
    //     } else if (res.data.code === 2001) {
    //       this.error1 = res.data.message
    //       this.showerror1 = true
    //     }
    //   }, (error) => {
    //     console.log(error)
    //   })
    // }
    // }
  }
}
</script>
<style lang="stylus" scoped>
  .left
    float:left;
  .right
    float:right;
  .login-root
    position:fixed;
    top:0;
    left:0;
    right:0;
    bottom:0;
    background url("../../assets/img/true.jpg")
    background-size: cover;
    text-align:center;
    font-weight:lighter;
  .login-container
    position:absolute;
    left:50%;
    top:50%;
    width:440px;
    /*height:332px;*/
    margin:-166px 0 0 -220px;
    border-radius:4px;
    .do-login
      border-radius:4px;
      width:100%;
      color:white;
      font-weight:300;
      cursor:pointer;
      font-size:18px;
      text-align:center;
    .get-padding
      margin-bottom: 30px;
  .login-meta
    position:absolute;
    left:0;
    top:-60px;
    width:100%;
    .systitle
      width 500px
      color: darkgray
      font-size: 35px
    div
      width:100%;
      height:100px;
      border-radius:60px;
      margin:0px auto;
  .login-form
    padding:65px 70px 0;
    width 100%
    height 400px
    .el-button
      width 30%
      text-align center
      margin-left -36%
    .form-b
      border:1px solid #E6E5E5;
      border-radius:2px;
      position: relative;
      width 280px
      &.haserror
        border: 1px solid #FD675F;
        .error
          display: block;
    .form-b.on
      border:1px solid #1B51B1;
    label
      display:block;
      color:#ccc;
      font-size:20px;
      height:40px;
      margin:30px 0;
      position:relative;
      .error
        display: none;
        color: #FD675F;
        font-size: 12px;
        position: absolute;
        left: 0;
        top: 46px;
      span
        display:none;
        position:absolute;
        right:4px;
        top:8px;
        width:24px;
        height:24px;
        cursor:pointer;
      span.clear
        display:block;
      i
        position:absolute;
        left:2px;
        top:0;a
        display:block;
        width:10px;
        height:40px;
      a
        display:block;
        width:110px;
        height:40px;
        line-height:40px;
        border:1px solid #E6E5E5;
        border-radius:2px;
        font-size:14px;
        color:#666;
        text-align:center;
        text-decoration:none;
        &.disabled
          cursor: default;
    .item-two
      width:178px;
    input
      height:40px;
      width 90%
      line-height:40px;
      padding:0;
      display:inline-block;
      color:#666;
      font-size:14px;
      border:none;
      outline:none;
      float:right;
      resize:none;
      font-weight:300;
      &::placeholder
        color:#C4C3C5;
        font-weight:300;
</style>
