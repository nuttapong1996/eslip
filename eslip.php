<?php 
require_once 'backend/session.php';
if(isset($_SESSION['empcode'])){
$title = "สลิปเงินเดือน (PDF)";
?>
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="manifest" href="manifest.json">
            <meta name="apple-mobile-web-app-capable" content="yes">
            <meta name="apple-mobile-web-app-status-bar-style" content="black">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
            <?php include 'components/head.php'; ?>
            <title><?php echo $title ?></title>
        </head>
        <style>
        #pdf-canvas {
            border: 1px solid black;
            width: 100%;
            height: auto;
        }
        #controls {
            margin-top: 10px;
            text-align: center;
        }
        button {
            padding: 10px;
            margin: 5px;
            font-size: 16px;
        }
        #howto-btn {
            cursor: pointer;
        }
        dialog {
            border : 1px solid lightgray;
            border-radius:5px;
            box-shadow: 5px 5px 10px lightgray;
            text-align:center;
        }
    </style>
        <body class="sb-nav-fixed bg-gray ibm-plex-sans-thai-regular">
            <!-- topnav -->
            <?php include 'components/topnav.php'; ?>
            <div id="layoutSidenav">
                <!-- sidenav -->
                <?php include 'components/sidenav.php'; ?>
                <div id="layoutSidenav_content">
                    <main>
                        <div class="container-fluid px-4">
                            <h3 class="mt-5 mb-4 text-center"><?php echo $title ?></h3>
                            <div class="row justify-content-center">
                                    <div class="col-sm-4">
                                        <div class="card border-0 rounded-0 p-2 mb-4 shadow-sm">
                                                <h5 class="m-0 text-center text-muted">กรุณาเลือกปีและงวด</h5>
                                            <div class="card-body">                                                                                          
                                                <!-- <form class="d-flex flex-column justify-content-center" method="POST" action='components/slip.php' target="_blank">                                            -->
                                                <form class="d-flex flex-column justify-content-center m-0"  id="pdf-form" method="POST">                                                                                             
                                                    <input type="hidden" id="empcode" value="<?php echo $_SESSION['empcode'] ?>">                                         
                                                    <?php include 'components/period_select.php'; ?>
                                                    <button class="btn btn-sm btn-outline-success p-3 m-0" name='download'>ตกลง</button>
                                                </form>                                        
                                            </div>
                                            <hr>
                                            <span class="btn btn-outline-secondary" id="howto-btn"><i class="fa-solid fa-question-circle"></i> วิธีการเปิดดูไฟล์ PDF</span>
                                        </div>
                                    </div>
                            </div>
                            <div id="pdfview">
                                <div class="row justify-content-center ">
                                    <div class="col-sm-8 ">
                                        <div class="d-flex justify-content-between m-0" id="controls">
                                            <button class="btn  btn-warning" id="prev-page"><i class="fa-solid fa-chevron-left"></i> ก่อนหน้า</button>
                                            <button class="btn btn-success" id="download-pdf"><i class="fa-solid fa-file-pdf"></i> ดาวน์โหลด PDF</button>                                        
                                            <button  class="btn btn-warning" id="next-page"><i class="fa-solid fa-chevron-right"></i> ถัดไป</button>                                           
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2 justify-content-center">
                                    <div class="col-sm-8">
                                        <div class="d-flex flex-row justify-content-between align-items-center">
                                            <b>หน้าที่: <span id="page-num"></span> / <span id="page-count"></span></b>
                                        </div>
                                        <div class="d-flex flex-column align-items-center">                                                                  
                                            <canvas class="" id="pdf-canvas"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-sm-12 text-center">
                                        
                                    </div>
                                </div>                                              
                            </div>
                        </div>
                    </main>
                    <div class="py-5"></div>
                    <!-- footer -->
                    <div class="desktop">
                        <?php include 'components/foot.php'; ?>  
                    </div>
                </div>
            </div>
            <div class="mobilenav">
                <?php include 'components/bottomnav.php'; ?>
            </div>
            <dialog class="text-center" id="howto-dialog">
                <small class="p-3">
                    <b>หมายเหตุ : รหัสผ่านสำหรับเปิดดูไฟล์ PDF  <br>คือ วัน-เดือน-ปี(ค.ศ.) เกิดของท่าน</b>
                    <br> *ตัวอย่างเช่น <br> ถ้าท่านเกิดวันที่ 5 มกราคม ค.ศ.1970 <br> รหัสผ่านของท่านคือ 05011970*
                </small>
                <hr>
                <span class="btn btn-primary w-100" id="close-howto">ตกลง</span>
            </dialog>  
        </body>
    </html>

    


    <script>
        const pdfview = document.getElementById('pdfview');
        const form = document.getElementById('pdf-form');
        const canvas = document.getElementById('pdf-canvas');
        const ctx = canvas.getContext('2d');
        let pdfDoc = null,
            pageNum = 1,
            pageIsRendering = false,
            pdfUrl = '';
        pdfview.style.display = 'none';

        const dialog = document.querySelector('#howto-dialog');
        const btnHowto = document.querySelector('#howto-btn');
        const closeBtn = document.querySelector('#close-howto');

        btnHowto.addEventListener('click', () => {
            dialog.showModal();
        });

        closeBtn.addEventListener('click', () => {
            dialog.close();
        });


        // Function to render a page
        const renderPage = num => {
            pageIsRendering = true;

            // Get the page
            pdfDoc.getPage(num).then(page => {
                const viewport = page.getViewport({ scale: 1.5 });
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                const renderContext = {
                    canvasContext: ctx,
                    viewport: viewport
                };

                page.render(renderContext).promise.then(() => {
                    pageIsRendering = false;
                    document.getElementById('page-num').textContent = num;
                });
            });
        };

        // Queue the rendering of a page
        const queueRenderPage = num => {
            if (pageIsRendering) {
                setTimeout(() => queueRenderPage(num), 100);
            } else {
                renderPage(num);
            }
        };

        // Show previous page
        const showPrevPage = () => {
            if (pageNum <= 1) return;
            pageNum--;
            queueRenderPage(pageNum);
        };

        // Show next page
        const showNextPage = () => {
            if (pageNum >= pdfDoc.numPages) return;
            pageNum++;
            queueRenderPage(pageNum);
        };

        // Load PDF document from the generated URL
        const loadPDF = (url, password) => {
            // Set the password for the document
            const loadingTask = pdfjsLib.getDocument({
                url: url,
                password: password
            });

            loadingTask.promise.then(pdfDoc_ => {
                pdfDoc = pdfDoc_;
                document.getElementById('page-count').textContent = pdfDoc.numPages;
                renderPage(pageNum);
            }).catch(error => {
                if (error.name === 'PasswordException') {
                    // Prompt the user for the password
                    const userPassword = prompt('กรุณากรอกรหัสผ่านเพื่อดู PDF (วัน-เดือน-ปี ค.ศ. เกิดของท่าน) :');
                    if (userPassword) {
                        loadPDF(url, userPassword); // Retry with the entered password
                    }
                } else {
                    console.error('Error loading PDF:', error);
                }
            });
        };

        // Form submission handler
        form.addEventListener('submit', event => {
            event.preventDefault();

            const formData = new FormData(form);            
            const empcode = document.getElementById('empcode').value.trim(); // Get the content field value
            const year = document.getElementById('yearSelect').value.trim(); // Get the content field value
            const period1 = document.getElementById('salaryPeriods1').value.trim(); // Get the content field value
            const period2 = document.getElementById('salaryPeriods2').value.trim(); // Get the content field value
            const pdfTitle = document.getElementById('pdf-title'); // Get the content field value
            
            // pdfTitle.textContent = 'สลิปเงินเดือนงวดที่ : ' +period1+' - งวดที่ : '+period2 + ' ปี: '+year;

            pdfview.style.display = 'block';
            pdfview.scrollIntoView();

            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'components/slip.php', true);
            xhr.responseType = 'blob'; // Expect a PDF file as a blob

            xhr.onload = function() {
                if (xhr.status === 200) {
                    const blob = xhr.response;
                    pdfUrl = URL.createObjectURL(blob);
                    loadPDF(pdfUrl); // Load the PDF in the viewer

                    // Enable the download button with the PDF URL
                    document.getElementById('download-pdf').onclick = function() {
                        const link = document.createElement('a');
                        link.href = pdfUrl;
                        link.download = 'SQMM_ESL_'+empcode+'_'+year+'_PP'+period1+'-'+period2+'.pdf';
                        link.click();
                    };
                }
            };

            xhr.send(formData);
        });

        // Button events
        document.getElementById('prev-page').addEventListener('click', showPrevPage);
        document.getElementById('next-page').addEventListener('click', showNextPage);
    </script>
<?php 
}else{
    header('location:login');
}
?>