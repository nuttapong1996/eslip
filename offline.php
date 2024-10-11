<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    /* ibm-plex-sans-thai-regular - latin_thai */
@font-face {
  font-display: swap; /* Check https://developer.mozilla.org/en-US/docs/Web/CSS/@font-face/font-display for other options. */
  font-family: 'IBM Plex Sans Thai';
  font-style: normal;
  font-weight: 400;
  src: url('fonts/ibm-plex-sans-thai-v10-latin_thai-regular.woff2') format('woff2'); /* Chrome 36+, Opera 23+, Firefox 39+, Safari 12+, iOS 10+ */
}
    body{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #f8f9fa;
        font-family: 'IBM Plex Sans Thai', sans-serif;
    }
    .card{
        border: none;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        padding: 30px;
        text-align: center;
        border-radius: 10px;
    }
    .close{
        font-size: 100px;
        color:red;
    }
    h1{
        color: red;
        padding: 0px;
        margin: 0px;
    }
    hr{
        background: red;
        height: 1px;
    }
</style>
<body>
    <div class="card">
        <div>
            <span class="close">&#9888;</span>
            <h1 class="" style="font-size: 3rem;">ออฟไลน์</h1>
            <h5 class="text-danger">กรุณาเชื่อมต่ออินเตอร์เน็ตเพื่อเข้าใช้งาน</h5>
            <hr style="margin: 0px 0px 20px 0px;">
            <a href="index" style="text-decoration: none; background-color: #003F88; color: white; padding: 5px;border-radius: 5px">&#8635; Reload Page</a>
        </div>
    </div>
</body>
</html>