<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>ผลการคัดกรองด้วยตนเอง</title>
    <style>
      .title-main
      {
        position: flex;
        margin-top: 20px;
        padding: 5px;
        background-color: #D3D3D3;
        border-radius: 8px;
        text-align: center;
      }

      .title-main p,
      canvas
      {
        margin-top: 5px;
      }

      .content
      {
        margin-top: 20px;
      }

      .content-title p
      {
        padding: 10px 10px;
        border-radius: 8px 8px 0 0;
        background: #F6F6F6;
      }

      .content-body
      {
        margin-top: -20px;
        border: 2px solid #F6F6F6;

      }

      .content-body p
      {
        margin-top: 8px;
        padding: 0px 10px;
      }

      .content-body.risk p,
      .content-body.waist p,
      .content-body.high-pressure-normal p
      {
        line-height: 16px;
      }

      #p3,
      .content-title
      {
        text-align: center;
      }

      button
      {
        margin: 20px 30px;
        padding: 2px 25px;
        font-size: 14px;
        background: #C4C4C4;
        height: 30px;
        border: 0px;
        border-radius: 4px;
      }

      button:hover
      {
        background-color: #fff;
        color: #C4C4C4;
      }

      @media screen and (max-width: 423px)
      {
        button
        {
          font-size: 10px;
        }
      }
    </style>
  </head>
  <body>

  <?php
      include "./header.php";
  ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>

      <div class="container">
        <div class="title-main">
          <p>ผลการคัดกรองด้วยตนเอง <br> (3 ธ.ค. 63)</p>
        </div>

        <div class="content">
          <div class="content-title">
            <p>น้ำหนักปกติ</p>
          </div>
          <div class="content-body">
            <p id="p1"><b>เยี่ยมมาก!!</b> คุณมีรูปร่างสมส่วน น้ำหนักปกติ อาหารที่รับประทานอยู่เหมาะสมดี</p>
            <p id="p2"><b>คำแนะนำเบื้องต้น</b> <br> พยายามดูแลสุขภาพและควบคุมน้ำหนักของคุณไว้ในระดับนี้ต่อไปเรื่อยๆ ด้วยการรับประทานอาหารที่มีประโยชน์ ออกกำลังกายอย่างสม่ำเสมอ และพักผ่อนให้เพียงพอ ถ้าอายุมากกว่า 35 ปี คุณควรตรวจ วัดความดันโลหิตทุก 1 ปี ถ้าอายุมากกว่า 35 ปี ควรเพิ่มการตรวจหาระดับน้ำตาลในเลือกเพื่อค้นหาโรคเบาหวานอย่างน้อยปีละ 1 ครั้ง หากสูบบุหรี่หรือดื่มสุราเป็นประจำ ควรเลิกให้ได้เพื่อสุขภาพของตัวคุณเอง แต่ถ้าคุณเป็นผู้หญิง คุณควรเพิ่มการตรงจมะเร็งเต้านม มะเร็งปากมดลูกด้วยนะ โดยเริ่มตั้งแต่อายุ 30 ปี ขึ้นไป</p>
            <p id="p3">คุณมีน้ำหนักอยู่ในช่วงที่ดีแล้ว ขอให้รักษาน้ำหนักอยู่ระหว่าง 63 ถึง 84 กก. ต่อไปนะคะ</p>
          </div>
        </div>

        <div class="content">
          <div class="content-title">
            <p class="text-bmi">BMI</p>
          </div>
          <div class="content-body">
            <canvas id="chart-bmi"></canvas>
          </div>
        </div>

        <div class="content">
          <div class="content-title">
            <p>น้ำหนัก</p>
          </div>
          <div class="content-body">
            <canvas id="chart-weight"></canvas>
          </div>
        </div>

        <div class="content">
          <div class="content-title">
            <p>ความเสี่ยงต่อโรคหัวใจใน 10 ปี = เสี่ยงต่ำ</p>
          </div>
          <div class="content-body risk">
            <p class="advice"><b>เยี่ยมมาก!!</b> ความเสี่ยงต่อโรคหัวใจของคุณอยู่ในระดับต่ำที่สุด <br><b>คำแนะนำ</b></br></p>
            <p>1. บริโภคอาหารรลดหวาน มัน เค็ม เพิ่มผักและผลไม้</p>
            <p>2. ออกกำลังกาย การเคลื่อนไหวร่างกาย ระดับหนักปานกลาง เช่น เดินเร็ว อย่างน้อย 30 นาที ต่อวัน สัปดาห์ละ 5 วัน ในการเคลื่อนไหวในชีวิตประจำวัน เวลาว่าง และการทำงาน</p>
            <p>3. น้ำหนักและรอบเอว ควบคุม ดัชนีมวลกาย (BMI) ให้อยู่ในช่วง 18.5 - 22.9 กก./ม หรือใกล้เคียง รอบเอว ผู้หญิงไม้เกิน 80 ซม. ชาย ไม่เกิน 90 ซม.</p>
            <p>4. หยุดสูบบุหรี่หรือไม่เริ่มสูบและไม่สูดคมควันบุหรี่</p>
            <p>5. หยุดดื่่มเครื่องดื่มที่มีแอลกอฮอล์ในรายที่หยุดดื่มไม่ได้ แนะนำให้ลดการดื่มลง (ผู้ชาย น้อยกว่าหรือเท่ากับ 2 หน่วยมาตรฐาน ผู้หญิง น้อยกว่าเท่ากับ 1 หน่วยมาตรฐาน)</p>
            <p>6. ความคุมความดันโลหิตน้อยกว่า 140/90 มม.ปรอท</p>
            <p>7. ติดตามทุก 6 เดือน</p>
            <p>8. ติดตามประเมินซ้ำภายใน 1 ปี</p>
          </div>
        </div>

        <div class="content">
          <div class="content-title">
            <p><b>รอบเอวของคุณอยู่ในเกณฑ์ปกติ</b> <br>(ชายน้อยกว่า 90 ซม., หญิงน้อยกว่า 80 ซม.)</p>
          </div>
          <div class="content-body waist">
            <p class="advice"><b>เยี่ยมมาก!!</b> รอบเอวของคุณอยู่ในเกณฑ์ปกติ <br><b>คำแนะนำ</b></p>
            <p>1. การรับประทานอาหารที่ดีต่อสุขภาพและออกกำลังกายอย่างสม่ำเสมอ</p>
            <p>2. วัดรอบเอวด้วยตนเองทุก 2 - 3 เดือน</p>
            <p>3. ปรับเปลี่ยนพฤติกรรม 3อ.2ส</p>
          </div>
        </div>

        <div class="content">
          <div class="content-title">
            <p>รอบเอว</p>
          </div>
          <div class="content-body">
            <canvas id="chart-waist"></canvas>
          </div>
        </div>

        <div class="content">
          <div class="content-title">
            <p>ความดันโลหิตปกติ</p>
          </div>
          <div class="content-body high-pressure-normal">
            <p class="advice"><b>เยี่ยมมาก!!</b> ความดันโลหิตของคุณอยู่ในเกณฑ์ปกติ <br><b>คำแนะนำ</b></p>
            <p>1. ควบคุมอาหาร</p>
            <p>2. ออกกำลังกาย</p>
            <p>3. วัดความดันโลหิตอย่างสม่ำเสมอ</p>
          </div>
        </div>

        <div class="content">
          <div class="content-title">
            <p>ความดันโลหิต</p>
          </div>
          <div class="content-body">
            <canvas id="high-pressure"></canvas>
          </div>
        </div>

        <div class="content">
          <div class="content-title">
            <p><b>น้ำตาลในเลือดปกติ</b> <br>(มีน้ำตาลในเลือดน้อยกว่า 100 มก.ดล.)</p>
          </div>
          <div class="content-body waist">
            <p class="advice"><b>เยี่ยมมาก!!</b> น้ำตาลในเลือดของคุณอยู่ในเกณฑ์ปกติ <br><b>คำแนะนำ</b></p>
            <p>1. ควบคุมอาหาร ออกกำลังกายอย่างสม่ำเสมอ</p>
            <p>2. ควบคุมน้ำหนักตัวให้อยู่ในเกณฑ์ที่เหมาะสม</p>
            <p>3. ควรประเมินความเสี่ยงซ้ำทุก 1-2 ปี</p>
          </div>
        </div>

        <div class="content">
          <div class="content-title">
            <p>น้ำตาลในเลือด</p>
          </div>
          <div class="content-body">
            <canvas id="chart-blood-suger"></canvas>
          </div>
        </div>

        <div class="content">
          <div class="content-title">
            <p>ไม่สูบบุหรี่</p>
          </div>
          <div class="content-body waist">
            <p class="advice"><b>เยี่ยมมาก!! ดูแลตนเองให้ห่างจากพิษภัยของบุหรี่ต่อไปนะ..</b></p>
          </div>
        </div>

        <div class="content">
          <div class="content-title">
            <p>ดื่มสุราบางโอกาส (1-2ครั้ง/สัปดาห์)</p>
          </div>
          <div class="content-body waist">
            <p class="advice"><b>คำแนะนำ</b></p>
            <p>1. ควรเข้ารับการประเมินพฤติกรรมการดื่มเครื่องดื่มแอลกอฮอล์ โดน อสม.หรือเจ้าหน้าที่สาธารณสุขในสถานบริการใกล้บ้าน</p>
            <p>2. สร้างแรงจูงใจและเสริมกำลังใจจากครอบครัวเพื่อช่วยเลิก</p>
            <p>3. พบเจ้าหน้าที่ เพื่อช่วยเลิกแอลกอฮอล์</p>
          </div>
        </div>

        <div class="button d-flex justify-content-center">
          <button type="button">ดูประวัติการบันทึกสุขภาพ</button>
          <button type="button">ปิด</button>
        </div>
      </div>

      <script>

      function chartOneData(id, typeChart, title, maxValue, minValue, stepSizeValue) {
        let element = document.getElementById(id).getContext('2d');
        let chart = new Chart(element, {
          type: typeChart,
          data: {
            labels: ['ม.ค.', 'มี.ค.', 'พ.ค.', 'ก.ค.', 'ก.ย.', 'พ.ย.'],
            datasets: [
              {
                label: title,
                data:[10,8,20,14,10,15,5],
                fill:false,
                backgroundColor: [
                  "rgba(255, 99, 132, 0.2)",
                  "rgba(255, 159, 64, 0.2)",
                  "rgba(255, 205, 86, 0.2)",
                  "rgba(75, 192, 192, 0.2)",
                  "rgba(54, 162, 235, 0.2)",
                  "rgba(153, 102, 255, 0.2)",
                  "rgba(201, 203, 207, 0.2)"],
                borderColor: [
                  "rgb(255, 99, 132)",
                  "rgb(255, 159, 64)",
                  "rgb(255, 205, 86)",
                  "rgb(75, 192, 192)",
                  "rgb(54, 162, 235)",
                  "rgb(153, 102, 255)",
                  "rgb(201, 203, 207)"
                ],
                borderWidth: 1
              }
            ]
          },
          options: {
            legend: {
              display: false
            },
            scales: {
              yAxes: [{
                ticks: {
                  beginAtZero: true,
                  max: maxValue,
                  min: minValue,
                  stepSize: stepSizeValue
                }
              }]
            }
          }
        })
      }

      function chartTwoData(id, typeChart, title, maxValue, minValue, stepSizeValue) {
        let element = document.getElementById(id).getContext('2d');
        let chart = new Chart(element, {
          type: typeChart,
          data: {
            labels: ['ม.ค.', 'มี.ค.', 'พ.ค.', 'ก.ค.', 'ก.ย.', 'พ.ย.'],
            datasets: [
              {
                    label: 'ความดันโลหิต ความดันค่าล่าง',
                    data: [122, 19, 32, 52, 25, 38],
                    backgroundColor: [
                        'rgba(255, 255, 255, 0.5)'
                    ],
                    borderColor: [
                        'rgba(9, 97, 30, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 7
              },
              {
                  label: 'ความดันโลหิต ความดันค่าบน',
                    data: [50, 60, 80, 100, 20, 30],
                    backgroundColor: [
                        'rgba(255, 255, 255, 0.5)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 7
              }
            ]
          },
          options: {
            legend: {
              display: false
            },
            scales: {
              yAxes: [
                {
                ticks: {
                  beginAtZero: true,
                  max: maxValue,
                  min: minValue,
                  stepSize: stepSizeValue
                }
                }
              ]
            }
          }
        })
      }

      function run() {
        chartOneData('chart-bmi', "bar", "BMI", 25, 0, 5);
        chartOneData('chart-weight', "bar", "น้ำหนัก", 25, 0, 5);
        chartOneData('chart-waist', "bar", "รอบเอว", 100, 0, 10);
        chartTwoData('high-pressure', "line", "ความดันโลหิต ความดันค่าล่าง", 140, 0, 20); // 2 data
        chartOneData('chart-blood-suger', "bar", "น้ำตาลในเลือด", 100, 0, 10);
      }

      run();

      </script>
  </body>
</html>