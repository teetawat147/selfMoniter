<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My LIFF v2</title>
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
  <script>
    liff.init({ liffId: "1655527645-9Onm8yKg" }, () => {
      if (liff.isLoggedIn()) {
        // runApp()
        liff.logout();
        window.location="../main/Healthdatarecord.php";
      } else {
        liff.login();
        window.location="../main/userRegister.php";
      }
    }, err => console.error(err.code, error.message));
  </script>
</body>

</html>