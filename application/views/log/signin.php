<!DOCTYPE html>
<html>
  <head>
    <base href="<?php echo base_url();?>"/>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width,initial-scale=1,shrink-to-fit=no"
    />
    <title>Login</title>
      <link rel="shortcut icon" href="img/LOGO.png" type="image/x-icon" />
    <style>
      #loader {
        transition: all 0.3s ease-in-out;
        opacity: 1;
        visibility: visible;
        position: fixed;
        height: 100vh;
        width: 100%;
        background: #fff;
        z-index: 90000;
      }
      #loader.fadeOut {
        opacity: 0;
        visibility: hidden;
      }
      .spinner {
        width: 40px;
        height: 40px;
        position: absolute;
        top: calc(50% - 20px);
        left: calc(50% - 20px);
        background-color: #333;
        border-radius: 100%;
        -webkit-animation: sk-scaleout 1s infinite ease-in-out;
        animation: sk-scaleout 1s infinite ease-in-out;
      }
      @-webkit-keyframes sk-scaleout {
        0% {
          -webkit-transform: scale(0);
        }
        100% {
          -webkit-transform: scale(1);
          opacity: 0;
        }
      }
      @keyframes sk-scaleout {
        0% {
          -webkit-transform: scale(0);
          transform: scale(0);
        }
        100% {
          -webkit-transform: scale(1);
          transform: scale(1);
          opacity: 0;
        }
      }
    </style>
    <link href="assets/agenda/style.css" rel="stylesheet" />
  </head>
  <body class="app">
    <div id="loader"><div class="spinner"></div></div>
    <!--tambahan untuk captcha-->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script>
      window.addEventListener("load", () => {
        const loader = document.getElementById("loader");
        setTimeout(() => {
          loader.classList.add("fadeOut");
        }, 300);
      });
    </script>

    <div class="peers ai-s fxw-nw h-100vh">
      <div
        class="d-n@sm- peer peer-greed h-100 pos-r bgr-n bgpX-c bgpY-c bgsz-cv"
        style="background-image: url('img/pitamin_login_cover_5.png'); background-size: cover; background-repeat: no-repeat;
background-position: 0vh ; height: 400px"
      >
<!--        <div class="pos-a centerXY">-->
<!--          <div-->
<!--            class="bgc-white bdrs-50p pos-r"-->
<!--            style="width: 120px; height: 120px"-->
<!--          >-->
<!--            <img-->
<!--              class="pos-a centerXY"-->
<!--              src="assets/agenda/assets/static/images/logo1.png"-->
<!--              alt=""-->
<!--            />-->
<!--          </div>-->
<!--        </div>-->
      </div>
        <!--settingcover-->
      <div
        class="col-12 col-md-4 peer pX-40 pY-80 h-100 scrollable pos-r"
        style="background-image: url('img/bg-brown-dark-2.png'); background-size: cover; background-repeat: no-repeat;
background-position: 0vh ; height: 400px"
      >
        <span style="font: bold;">
            <h4 class="fw-300 c-grey-900 mB-40" style="font-weight: bold; color: white !important;">Login</h4>
        </span>
        <form class="validate-form" action="" method="post">
          <?php	echo $this->session->flashdata('msg');	?>
          <div  class="form-group validate-input" data-validate = "Username is required">
            <label class="text-normal text-dark" style="font-weight: bold; color: white !important;">Username</label>
            <input type="text" class="form-control" placeholder="Username" name="username" style="width: 87%" required/>
          </div>
          <div class="form-group validate-input" data-validate = "Password is required">
            <label class="text-normal text-dark" style="font-weight: bold; color: white !important;">Password</label>
            <input
              type="password"
              class="form-control"
              placeholder="Password"
              name="password"
              style="width: 87%"
              required
            />
          </div>
          <div class="form-group">
            <!-- <div class="peers ai-c jc-sb fxw-nw"> -->
              <!-- <div class="peer">
                <div class="checkbox checkbox-circle checkbox-info peers ai-c">
                  <input
                    type="checkbox"
                    id="inputCall1"
                    name="inputCheckboxesCall"
                    class="peer"
                  />
                  <label for="inputCall1" class="peers peer-greed js-sb ai-c"
                    ><span class="peer peer-greed">Remember Me</span></label
                  >
                </div>
              </div> -->
              <!-- <div class="peer"> -->

<!--              <div class="g-recaptcha" data-sitekey="6LfUAE8mAAAAAGv4HnOTyYq3q-xedw0ethHsKO4H"></div>-->

              <div class="g-recaptcha" data-sitekey="6LdJ0pAmAAAAAI7vU7S3seu7_Wt9AnJCINpeceU_"
                   style="">

              </div>

              <!--btnlogin dikirim dan terbaca pada controller Web.php -->
                <button class="btn btn-primary" name="btnlogin" id="btnlogin" type="submit" style="margin-top: 20px">Login</button>

              <!-- </div>
            </div> -->
          </div>

        </form>
      </div>
    </div>
    <script type="text/javascript" src="assets/agenda/vendor.js"></script>
    <script type="text/javascript" src="assets/agenda/bundle.js"></script>
    <!--tambahan untuk captcha-->
    <script type="text/javascript">
        $(document).on('click', '#btnlogin', function() {
            var response = grecaptcha.getResponse();
            if (response.length == 0) {
                alert("Please verify you are not a robot.");
                return false;
            }
        });
    </script>
  </body>
</html>
