<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My LIFF </title>
  <style>
    #pictureUrl { display: block; margin: 0 auto }
  </style>
</head>
<body>
  <img id="pictureUrl" width="25%">
  <p id="userId"></p>
  <p id="displayName"></p>
  <p id="statusMessage"></p>
  <p id="getDecodedIDToken"></p>
  <script src="https://static.line-scdn.net/liff/edge/versions/2.6.0/sdk.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script>
    liff.init({ liffId: "1655527645-9Onm8yKg" }, () => {
      if (liff.isLoggedIn()) {
        liff.getProfile().then(profile=>{
            let lineId=profile.userId;

            $.ajax({
                method: "POST",
                url: "../main/lineIdCheck.php",
                data: {lineId:lineId}
            })
            .done(function(msg) {
                // $(target).html(msg);
                console.log(msg);
                if (msg=='Ok'){
                    window.location="../main/Healthdatarecord.php";
                }else{
                    window.location="../main/userRegister.php?lineId="+lineId;
                }
            });
        })
      } else { 
        console.log("111");
        //liff.login();
        window.location="../main/login.php";
      }
    }, err => console.error(err.code, error.message));
  </script>
</body>

</html>