<?php
// Prevents the phone's own regular browser HTTP cache from serving a
// stale copy of this page — a completely different, separate caching
// layer from the mobile PWA's own sw.js, which never touches this
// path at all (it's outside the PWA's own scope). Without this,
// changes made here can show up correctly on desktop (or after a hard
// refresh) while a phone keeps rendering an old cached version
// indefinitely. Scoped to mobile_app_view sessions only, matching
// every other change made for the mobile bridge — desktop sessions are
// untouched.
if (!empty($_SESSION['mobile_app_view'])) {
    header('Cache-Control: no-cache, no-store, must-revalidate');
    header('Pragma: no-cache');
    header('Expires: 0');
}
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- from landing Page -->
        <!-- Bootstrap core CSS -->
        <!--    <link href="<?= BASE_URL ?>themes/inspinia/css/bootstrap.min.css" rel="stylesheet"> -->

        <!-- Animation CSS -->
        <!--    <link href="<?= BASE_URL ?>themes/inspinia/css/animate.css" rel="stylesheet"> -->
        <link href="<?= BASE_URL ?>themes/inspinia/font-awesome/css/font-awesome.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
     <!--    <link href="<?= BASE_URL ?>themes/inspinia/css/style.css" rel="stylesheet"> -->
<!-- End from landing Page -->

    <title><?= SHORTSITENAME ?></title>
    <!-- Removed 2026-10-27: PayPal's developer-docs demo stylesheet (paypalobjects.com .../cardfields.css)
         was loaded on every page; its "button { width: 229px; height: 49px; ... }" made every <button>
         oversized (e.g. Save Changes vs Cancel). Nothing here uses PayPal card fields. -->

    <link href="<?= BASE_URL ?>themes/inspinia/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>themes/inspinia/font-awesome/css/font-awesome.css" rel="stylesheet">

        <!-- Sweet Alert -->
    <link href="<?= BASE_URL ?>themes/inspinia/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">


    <link href="<?= BASE_URL ?>themes/inspinia/css/animate.css" rel="stylesheet">
           <link href="<?= BASE_URL ?>themes/inspinia/css/style.css" rel="stylesheet">
    <!-- Loaded AFTER style.css on purpose — anything here overrides the
         theme's own rules, and survives a future theme update untouched.
         Never add rules to themes/inspinia/css/style.css directly again;
         put them here instead. See custom.css's own header comment. -->
    <link href="<?= BASE_URL ?>themes/inspinia/css/custom.css" rel="stylesheet">

    <link href="<?= BASE_URL ?>themes/inspinia/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
 <!--   <link type="text/css" href="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/css/dataTables.checkboxes.css" rel="stylesheet"/> -->

    <link href="<?= BASE_URL ?>themes/inspinia/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">

    <!-- Morris -->
    <link href="<?= BASE_URL ?>themes/inspinia/css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">

    <link href="<?= BASE_URL ?>themes/inspinia/css/plugins/summernote/summernote-bs4.css" rel="stylesheet">

    <style type="text/css" media="screen">
        #spinner{
            position: fixed;
            top: 50%;
            left: 50%;
        }
    </style>

        <style>
            .blink {
                animation: blinker 0.0s linear infinite;
                color: teal;
                font-family: sans-serif;
            }
            @keyframes blinker {
                50% {
                    opacity: 0;
                }
            }
        </style>


    <!-- New from layout  -->
 <!-- --   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->

    <!-- Toastr style -->
    <link href="<?= BASE_URL ?>themes/inspinia/css/plugins/toastr/toastr.min.css" rel="stylesheet">

 <!--   <link href="<?= BASE_URL ?>themes/inspinia/css/plugins/fullcalendar/fullcalendar.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>themes/inspinia/css/plugins/fullcalendar/fullcalendar.print.css" rel='stylesheet' media='print'> -->
    <link href="<?= BASE_URL ?>themes/inspinia/css/plugins/textSpinners/spinners.css" rel="stylesheet">

<!--    <link href="<?= BASE_URL ?>themes/inspinia/css/plugins/dropzone/basic.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>themes/inspinia/css/plugins/dropzone/dropzone.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>themes/inspinia/css/plugins/codemirror/codemirror.css" rel="stylesheet"> -->

<!--  style for event calendar -->
<!--
<style>
.fc-disabled {
    background-color: #F0F0F0 !important;
    color: #000;
    cursor: default;
    font-family:Verdana, Arial, Helvetica, sans-serif;
    font-size:10px;
}
.faq-item {
  padding: 1px; /* was 20px I changed style.css 6236 */
  margin-bottom: 2px;
  background: #fff;

  width: 100%; /* I added - cant go <96% or title of collapse witll wrap on log ones
 /* color: red; can change the default background text */

}
/* WIDGETS */
.widget {
  border-radius: 5px;
  padding: 15px 35px; /*  default was 20  */
  margin-bottom: 10px;
  margin-top: 10px;
}
.widget.style1 h2 {
  font-size: 22px; /*  default was 30  */
}
.widget h2,
.widget h3 {
  margin-top: 5px;
  margin-bottom: 0;
}
.widget-text-box {
  padding: 20px;
  border: 1px solid #e7eaec;
  background: #ffffff;
}
.widget-head-color-box {
  border-radius: 5px 5px 0 0;
  margin-top: 10px;
}
.widget .flot-chart {
  height: 100px;
}
.vertical-align div {
  display: inline-block;
  vertical-align: middle;
}
.vertical-align h2,
.vertical-align h3 {
  margin: 0;
}
.todo-list {
  list-style: none outside none;
  margin: 0;
  padding: 0;
  font-size: 14px;
}
.todo-list.small-list {
  font-size: 12px;
}
.todo-list.small-list > li {
  background: #f3f3f4;
  border-left: none;
  border-right: none;
  border-radius: 4px;
  color: inherit;
  margin-bottom: 2px;
  padding: 6px 6px 6px 12px;
}
.todo-list.small-list .btn-xs,
.todo-list.small-list .btn-group-xs > .btn {
  border-radius: 5px;
  font-size: 10px;
  line-height: 1.5;
  padding: 1px 2px 1px 5px;
}
.todo-list > li {
  background: #f3f3f4;
  border-left: 6px solid #e7eaec;
  border-right: 6px solid #e7eaec;
  border-radius: 4px;
  color: inherit;
  margin-bottom: 2px;
  padding: 10px;
}
.todo-list .handle {
  cursor: move;
  display: inline-block;
  font-size: 16px;
  margin: 0 5px;
}
.todo-list > li .label {
  font-size: 9px;
  margin-left: 10px;
}
.check-link {
  font-size: 16px;
}
.todo-completed {
  text-decoration: line-through;
}
.geo-statistic h1 {
  font-size: 36px;
  margin-bottom: 0;
}
.glyphicon.fa {
  font-family: "FontAwesome";
}
</style>

-->

    <!-- end from layout  -->

<?php
    // Per-user, per-element font-size preferences (tab/header/label/
    // value/button). Computed in the CONTROLLER, not here — see
    // Ccmps::_with_fontsize_style() for why: Trongate's template loader
    // does not preserve the controller's object context inside this
    // file, so $this->model was never available here (confirmed via a
    // real fatal error: "Using $this when not in object context").
    // $data, unlike $this, is passed through normally and IS reliably
    // available, so the controller computes the style string and this
    // file just echoes it.
    echo $data['ccmps_fontsize_style'] ?? '';
?>
<?php if (!empty($_SESSION['mobile_app_view'])): ?>
<style>
  /* Hides the sidebar for sessions opened through the mobile app's
     Home tab (Welcome::mobile_bridge()) — deliberately scoped to a
     dedicated session flag set only by that bridge, not device_type,
     so this never affects a regular desktop session. The mobile app's
     own bottom tab bar already covers everything the sidebar does, so
     it's suppressed outright rather than just collapsed. CSS-only
     (not a device_type change) because device_type == 2 was confirmed
     to swap in an entirely different, simplified content block
     elsewhere on this page — not something to disturb just to hide a
     sidebar. #page-wrapper's left margin is reset to 0 to reclaim the
     space the (now-hidden) fixed-position sidebar would have taken. */
  #wrapper > nav,
  .navbar-static-side {
    display: none !important;
  }
  #page-wrapper {
    margin-left: 0 !important;
  }

  /* The responsive theme's own hamburger toggle (collapses the top nav
     into a "jump to section" menu on narrow screens) — works correctly
     functionally, but its default styling is invisible until :hover
     and has no width constraint, causing it to wrap onto its own line
     at full container width. Bootstrap 3/4 both use one of these class
     names depending on version, so both are covered rather than
     guessing at which this theme uses. */
  .navbar-toggle,
  .navbar-toggler {
    display: inline-block !important;
    width: auto !important;
    background-color: #0B1E33 !important;
    border: 1px solid #0B1E33 !important;
    border-radius: 4px;
    padding: 8px 12px !important;
    margin: 8px 0 !important;
  }
  .navbar-toggle .icon-bar {
    background-color: #fff !important;
  }

  /* Hides "Membership Vitals" for mobile app sessions specifically —
     targeted via :has() on its own unique link, rather than by editing
     ccmphome.php's HTML directly, since tracing exact div nesting by
     hand in a 2000+ line file risks mismatching a tag and breaking the
     page. :has() is supported in all current mobile browsers
     (Chrome/Safari/Edge, 2022+). ("Register Me" was originally hidden
     the same way here too, but the hamburger menu's own jump-list
     generation apparently scans the DOM for headings regardless of
     CSS visibility — display:none wasn't enough, so that one is now
     removed directly in ccmphome.php instead, via a PHP conditional.) */
  .faq-item:has(a[href="#faq7"]) {
    display: none !important;
  }

  /* Safety net — the sidebar (which normally holds Logout) is hidden
     for mobile_app_view sessions, and the theme's own hamburger toggle
     doesn't provide a logout option either. Confirmed via a real case:
     mobile_app_view stayed set to true on a desktop browser session
     left over from testing the bridge directly, leaving no visible way
     to sign out at all on that page. This link is small and unobtrusive
     but always present whenever this flag is set, so that situation
     can't happen again regardless of how the flag ends up set. */
  #mobile-view-signout {
    position: fixed;
    top: 8px;
    right: 12px;
    z-index: 2000;
    font-size: 0.8rem;
    color: #8a9bae;
    text-decoration: underline;
    background: rgba(11, 30, 51, 0.85);
    padding: 4px 10px;
    border-radius: 4px;
  }
</style>
<?php endif; ?>
</head>


<!--  <body> background will be black -->
<!-- <body class="gray-bg"> -->
    <!-- <body class="skin-1"> -->
    <body class="light-skin">

<?php if (!empty($_SESSION['mobile_app_view'])): ?>
<a href="<?= BASE_URL ?>welcome/logout/compccmp" id="mobile-view-signout">Sign Out</a>
<script>
  // mobile_app_view alone can't distinguish "genuinely inside the
  // mobile app's own Home tab iframe" from "a desktop browser that
  // still has this session flag left over from earlier testing" — both
  // are the identical session state as far as PHP can tell. Detecting
  // the iframe directly in JS and hiding the link there instead: this
  // link only ends the web session (a completely separate, independent
  // login from the mobile app's own JWT token in localStorage) — tapping
  // it inside the app would look like signing out while every other tab
  // (Profile, Chapter, etc.) still showed the member as logged in. The
  // app's own bottom-tab Sign Out is the correct way to log out there.
  if (window.self !== window.top) {
    document.getElementById('mobile-view-signout').style.display = 'none';
  }
</script>
<?php endif; ?>

<!-- <div id="app"> -->

 <div class="wrapper">  <!-- I added -->
    <main><?= Template::display($data) ?></main>

 </div> <!-- wrapper -->

<!-- js from layout  -->

<!-- end js function from layout  -->

<script>
function goToUrl(targetUrl) {
    window.location.href = targetUrl;
}
</script>

        <!-- Mainly scripts -->
<script src="<?= BASE_URL ?>themes/inspinia/js/plugins/pdfjs/pdf.js"></script>

<!-- Landing Page scripts -->
<script src="<?= BASE_URL ?>themes/inspinia/js/jquery-3.7.1.min.js"></script>
<script src="<?= BASE_URL ?>themes/inspinia/js/popper.min.js"></script>
<script src="<?= BASE_URL ?>themes/inspinia/js/bootstrap.js"></script>
<script src="<?= BASE_URL ?>themes/inspinia/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="<?= BASE_URL ?>themes/inspinia/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?= BASE_URL ?>themes/inspinia/js/inspinia.js"></script>
<script src="<?= BASE_URL ?>themes/inspinia/js/plugins/pace/pace.min.js"></script>
<script src="<?= BASE_URL ?>themes/inspinia/js/plugins/wow/wow.min.js"></script>

        <!-- HOWL -->

<script src="<?= BASE_URL ?>js/htmx/htmx.min.js"></script> <!-- v1.9.10 01/05/2024
<script defer src="https://unpkg.com/@alpinejs/mask@3.x.x/dist/cdn.min.js"></script>
<script defer src="https://unpkg.com/alpinejs"></script> -->

 <!--    <script src="<?= BASE_URL ?>themes/inspinia/js/jquery-3.7.1.min.js"></script> -->
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/sweetalert/sweetalert.min.js"></script>
<!--<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.6.1/dist/sweetalert2.all.min.js"></script>  -->
 <!--    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.15/dist/sweetalert2.all.min.js"></script> -->

<!--
<script src="<?= BASE_URL ?>themes/inspinia/js/plugins/fullcalendar/moment.min.js"></script>
<script src="<?= BASE_URL ?>themes/inspinia/js/plugins/fullcalendar/fullcalendar.min.js"></script> -->
<!-- <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/metisMenu/jquery.metisMenu.js"></script> -->
<!-- <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/slimscroll/jquery.slimscroll.min.js"></script> -->
<script src="<?= BASE_URL ?>themes/inspinia/js/plugins/jsKnob/jquery.knob.js"></script>

       <!-- Mainly scripts -->

 <!-- --   <script src="<?= BASE_URL ?>themes/inspinia/js/popper.min.js"></script>
    <script src="<?= BASE_URL ?>themes/inspinia/js/bootstrap.js"></script>
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/slimscroll/jquery.slimscroll.min.js"></script> -->

    <!-- Flot -->
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/flot/jquery.flot.js"></script>
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/flot/jquery.flot.pie.js"></script>
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/flot/jquery.flot.symbol.js"></script>
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/flot/jquery.flot.time.js"></script>

    <!-- Peity -->
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/peity/jquery.peity.min.js"></script>
    <script src="<?= BASE_URL ?>themes/inspinia/js/demo/peity-demo.js"></script>

    <!-- Custom and plugin javascript -->
 <!-- --   <script src="<?= BASE_URL ?>themes/inspinia/js/inspinia.js"></script>
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/pace/pace.min.js"></script> -->

    <!-- jQuery UI -->
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- Jvectormap -->
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

    <!-- EayPIE -->
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/easypiechart/jquery.easypiechart.js"></script>

    <!-- Sparkline -->
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- Sparkline demo data  -->
    <script src="<?= BASE_URL ?>themes/inspinia/js/demo/sparkline-demo.js"></script>

    <!-- iCheck from form-->
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/iCheck/icheck.min.js"></script>

    <!-- ChartJS-->
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/chartJs/Chart.min.js"></script>

    <!-- From Datatables  -->

    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/dataTables/datatables.min.js"></script>
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/dataTables/dataTables.bootstrap4.min.js"></script>

    <!-- CKEditor 4.20.1 Standard  -->

    <script src="<?= BASE_URL ?>ckeditor/ckeditor.js"></script>

<!-- --    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/pdfjs/pdf.js"></script> -->

    <!-- BS custom file -->
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/bs-custom-file/bs-custom-file-input.min.js"></script>


    <!-- Vue.js CDN  all pages except ccmphome which uses itself ccmphome.php
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script> -->


    <!-- Run Scripts  -->

<script>
    CKEDITOR.replace('bulletin_editor'); // in bulletin crud.php
</script>
<script>
    CKEDITOR.replace('notice_editor'); // in notice crud.php
</script>
<script>
    CKEDITOR.replace('job_editor'); // in job crud.php
</script>
<script>
    CKEDITOR.replace('activity_editor'); // in activity crud.php
</script>
<script>
    CKEDITOR.replace('note_editor'); // in library crud.php
</script>
<script>
    CKEDITOR.replace('doc_editor'); // in library crud.php
</script>
<script>
    CKEDITOR.replace('marquee_editor'); // in library crud.php
</script>

<script>
    CKEDITOR.replace('reject_editor'); // in librarykanban.php
</script>

<script>
    CKEDITOR.replace('ipc_editor'); // in librarykanban.php
</script>

<script>
    CKEDITOR.replace('irc_editor'); // in librarykanban.php
</script>

<script>
    CKEDITOR.replace('bklg_editor'); // in librarykanban.php
</script>

<script>
    CKEDITOR.replace('hdr0_editor'); // in librarykanban.php
</script>

<script>
    CKEDITOR.replace('hdr5_editor'); // in librarykanban.php
</script>

<script src="https://smtpjs.com/v3/smtp.js"></script>

<script>
const output = document.getElementById("output");
const filepicker = document.getElementById("filepicker");

filepicker.addEventListener("change", (event) => {
  const files = event.target.files;
  const now = new Date();
  output.textContent = "";

  for (const file of files) {
    const date = new Date(file.lastModified);
    //const date = new date.toDateString(file.lastModified);
   // date.toDateString(date);
    output.value =  ` ${date}`;

    // true if the file hasn't been modified for more than 1 year
    //const stale = now.getTime() - file.lastModified > 31_536_000_000;
    //output.textContent += `${file.name} is ${
    //  stale ? "stale" : "fresh"
    //} (${date}).\n`;
  }
});
</script>

<!-- elastimail smtp.elastimail.com port 2525 bpaems@gmail.com 10ED5065E00E43ECC42F6B4296CF9E55C1E0 -->

<script>
    function sendEmail(){
        alert('inspinia Fired!');
        return false;
        Email.send({
        //    Host: "smtp.gmail.com",
        //   Password: "Byus4Us!!"
            Host: "smtp.elastimail.com ",
            Username: "bpaems@gmail.com",
            Password: "10ED5065E00E43ECC42F6B4296CF9E55C1E0"
            To: 'bpaems@gmail.com',
            From: document.getElementById("name").value,
            Subject: "New Sponsor Form Inquiry",
            Body: "Name: " + document.getElementById("name").value
            + "<br> Email: " + document.getElementById("email").value
            + "<br> Mobile: " + document.getElementById("phone").value
            + "<br> Message: " + document.getElementById("message").value


    }). then(
        message => alert("Message Sent!")
    );

}
</script>

<script>
      function FetchMailCounties(id){
        //  $("#county").html('');
          $("#mailcounty").html('<option>Select County</option>');
          $.ajax({
                type: 'post',
                url:'<?= BASE_URL ?>welcome-ccmps/getmailcntydata',
                data: {mailingstate :id},
                success: function(data){
                    $("#mailcounty").html(data);
                }
          })

      }
 </script>

 <script>
      function FetchPhysCounties(id){

          $("#physcounty").html('<option>Select County</option>');
          $.ajax({
                type: 'post',
                url:'<?= BASE_URL ?>welcome-ccmps/getphyscntydata',
                data: {physicalstate :id},
                success: function(data){
                    $("#physcounty").html(data);
                }
          })
      }
 </script>

 <script id="script">
        //
        // If absolute URL from the remote server is provided, configure the CORS
        // header on that server.
        //
       // var url = './pdf/example.pdf';
       var url = '/Applications/XAMPP/xamppfiles/htdocs/honchocore/pdf/example.pdf';
       //   var url = <?= APPPATH ?>.'/pdf/example.pdf';
//var url = '<?= APPPATH ?>/modules/cms/ccmpslibrary/assets/docs/bpa_by_laws.pdf';

        var pdfDoc = null,
                pageNum = 1,
                pageRendering = false,
                pageNumPending = null,
                scale = 1.5,
                zoomRange = 0.25,
                canvas = document.getElementById('the-canvas'),
                ctx = canvas.getContext('2d');

        /**
         * Get page info from document, resize canvas accordingly, and render page.
         * @param num Page number.
         */
        function renderPage(num, scale) {
            pageRendering = true;
            // Using promise to fetch the page
            pdfDoc.getPage(num).then(function(page) {
                var viewport = page.getViewport(scale);
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                // Render PDF page into canvas context
                var renderContext = {
                    canvasContext: ctx,
                    viewport: viewport
                };
                var renderTask = page.render(renderContext);

                // Wait for rendering to finish
                renderTask.promise.then(function () {
                    pageRendering = false;
                    if (pageNumPending !== null) {
                        // New page rendering is pending
                        renderPage(pageNumPending);
                        pageNumPending = null;
                    }
                });
            });

            // Update page counters
            document.getElementById('page_num').value = num;
        }

        /**
         * If another page rendering in progress, waits until the rendering is
         * finised. Otherwise, executes rendering immediately.
         */
        function queueRenderPage(num) {
            if (pageRendering) {
                pageNumPending = num;
            } else {
                renderPage(num,scale);
            }
        }

        /**
         * Displays previous page.
         */
        function onPrevPage() {
            if (pageNum <= 1) {
                return;
            }
            pageNum--;
            var scale = pdfDoc.scale;
            queueRenderPage(pageNum, scale);
        }
        document.getElementById('prev').addEventListener('click', onPrevPage);

        /**
         * Displays next page.
         */
        function onNextPage() {
            if (pageNum >= pdfDoc.numPages) {
                return;
            }
            pageNum++;
            var scale = pdfDoc.scale;
            queueRenderPage(pageNum, scale);
        }
        document.getElementById('next').addEventListener('click', onNextPage);

        /**
         * Zoom in page.
         */
        function onZoomIn() {
            if (scale >= pdfDoc.scale) {
                return;
            }
            scale += zoomRange;
            var num = pageNum;
            renderPage(num, scale)
        }
        document.getElementById('zoomin').addEventListener('click', onZoomIn);

        /**
         * Zoom out page.
         */
        function onZoomOut() {
            if (scale >= pdfDoc.scale) {
                return;
            }
            scale -= zoomRange;
            var num = pageNum;
            queueRenderPage(num, scale);
        }
        document.getElementById('zoomout').addEventListener('click', onZoomOut);

        /**
         * Zoom fit page.
         */
        function onZoomFit() {
            if (scale >= pdfDoc.scale) {
                return;
            }
            scale = 1;
            var num = pageNum;
            queueRenderPage(num, scale);
        }
        document.getElementById('zoomfit').addEventListener('click', onZoomFit);


        /**
         * Asynchronously downloads PDF.
         */
        PDFJS.getDocument(url).then(function (pdfDoc_) {
            pdfDoc = pdfDoc_;
            var documentPagesNumber = pdfDoc.numPages;
            document.getElementById('page_count').textContent = '/ ' + documentPagesNumber;

            $('#page_num').on('change', function() {
                var pageNumber = Number($(this).val());

                if(pageNumber > 0 && pageNumber <= documentPagesNumber) {
                    queueRenderPage(pageNumber, scale);
                }

            });

            // Initial/first page rendering
            renderPage(pageNum, scale);
        });
    </script>

 <script>
        $(document).ready(function(){



            // begin landing page
            $('body').scrollspy({
                target: '#navbar',
                offset: 80
            });

            // Page scrolling feature
            $('a.page-scroll').bind('click', function(event) {
                var link = $(this);
                $('html, body').stop().animate({
                    scrollTop: $(link.attr('href')).offset().top - 50
                }, 500);
                event.preventDefault();
                $("#navbar").collapse('hide');
            });
        });

        var cbpAnimatedHeader = (function() {
            var docElem = document.documentElement,
                    header = document.querySelector( '.navbar-default' ),
                    didScroll = false,
                    changeHeaderOn = 200;
            function init() {
                window.addEventListener( 'scroll', function( event ) {
                    if( !didScroll ) {
                        didScroll = true;
                        setTimeout( scrollPage, 250 );
                    }
                }, false );
            }
            function scrollPage() {
                var sy = scrollY();
                if ( sy >= changeHeaderOn ) {
                    $(header).addClass('navbar-scroll')
                }
                else {
                    $(header).removeClass('navbar-scroll')
                }
                didScroll = false;
            }
            function scrollY() {
                return window.pageYOffset || docElem.scrollTop;
            }
            init();

        })();

        // Activate WOW.js plugin for animation on scrol
        new WOW().init();
// end landing page
        //   $('#mailngstate').change(function(){
          //      var $mstid = $('#mailingstate').val();
              //  alert($mstid);


          //  });

        $('.scroll_content').slimscroll({
            height: '890px' // any shorter and wont see bottom of footer without scrolling the page
        });
 //$('#sendsponsor').on('click',function(){
//alert('sendsponsor!');
// }
  //          alert('Hello');
 // bsCustomFileInput.init()  // this stoppped everything from executing
// begin from layout
            $('#toggleSpinner1').on('click',function(){
//alert('Yep1');
                document.getElementById("ibox1").style.display = "";
         //   $('#ibox1').children('.ibox-content').toggleClass('sk-loading');
         //   $('#ibox2').children('.ibox-content').toggleClass('sk-loading');
             console.log("spinner started");
            });

            $('#toggleSpinner2').on('click',function(){

                document.getElementById("ibox2").style.display = "";

             console.log("spinner started");
            });

            $('#toggleSpinner3').on('click',function(){

                document.getElementById("ibox3").style.display = "";

             console.log("spinner started");
            });

            $('#toggleSpinner4').on('click',function(){

                document.getElementById("ibox4").style.display = "";

             console.log("spinner started");
            });

            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green'
            });


           $("#btnDelBull").click(function(){

                     // works
                    if(confirm('This bulletin will be permanently deleted. Are you sure?'))
                    {

                    //do nothing: just let it continue executing with the deletes
                    //alert('yes!');

                    }else{
                        return false; // kills php execution of the delete
                    }

            });

           // generic delete record button - perhaps could pass the name of the thing (bulletin, Notice, etc)
           $("#btnDelRec").click(function(){

                     // works
                    if(confirm('This record will be permanently deleted. Are you sure?'))
                    {

                    //do nothing: just let it continue executing with the deletes
                    //alert('yes!');

                    }else{
                        return false; // kills php execution of the delete
                    }

            });


           $("#bullsubmit").click(function(){
                var bulkaction = document.getElementById("selected").value;
 // alert(bulkaction);
                if (bulkaction  == 6){ // put up a confirmation modal
/*
                 swal({
                        title: "Are you sure?",
                        text: "You will not be able to recover this imaginary file!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, delete it!",
                        closeOnConfirm: false
                    });
*/
                     // works
                    if(confirm('This bulletin will be permanently deleted. Confirm Deletion?'))
                    {

                    //do nothing: just let it continue executing with the deletes
                    //alert('yes!');

                    }else{
                        return false; // kills php execution of the delete
                    }



                } // if bulkaction != 6, if not ignore and keep executing
            });

           $("#ntcsubmit").click(function(){
  //alert('Fired!');
                var bulkaction = document.getElementById("selected").value;
 // alert(bulkaction);
                if (bulkaction  == 6){ // put up a confirmation modal
/*
                 swal({
                        title: "Are you sure?",
                        text: "You will not be able to recover this imaginary file!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, delete it!",
                        closeOnConfirm: false
                    });
*/
                     // works
                    if(confirm('This notice will be permanently deleted. Confirm Deletion?'))
                    {

                    //do nothing: just let it continue executing with the deletes
                    //alert('yes!');

                    }else{
                        return false; // kills php execution of the delete
                    }



                } // if bulkaction != 6, if not ignore and keep executing
            });

            // set font button

            $("#FontBtn").click(function(){
             //   var nfontsize  = $("#fontsize").val();
                var nfontsize  = document.getElementById("FontSel").value;
            //    var nmfontsize = document.getElementById("MFontSel").value;
                var sarecid    = $("#recid").val();
//alert('683');
//alert(nfontsize);
//alert(sarecid);
                    $.ajax({

                        url:'<?= BASE_URL ?>welcome-ccmps/fontsize',
                        type: 'post',
                        data: {fontsize:nfontsize,recid:sarecid},
                      //  data: {fontsize:nfontsize,mfontsize:nmfontsize,recid:sarecid},
                      //  dataType: "json",  // if wanted to pass to php function fontsize()
              //   as json object and not input. As json could send to node.js or API

                        success:function(response){
                            $("#result").text(response);
                            setTimeout(function(){
                                $("#result").fadeOut("slow");
                                $("#fontsize").val("");
                                $("#mfontsize").val("");
                                $("#recid").val("");
                                $("#tabsleft").val("");
                                $("#dbtupd").val("");
                                $("#myModal").modal("hide");
                            }, 2500);

                        },
                        error:function(response){
                            $("#result").text(response);
                       // error:function(jqXHR, textStatus, errorThrown){
                       //    var $errmsg = '<p>Status code: ' + jqXHR.status + '</p>'
                         //   console.log($errmsg);
                        }


                    });

            });

/* FontBtn2 disabled: it posted to cms-ccmpslibrary/fontsize (old library, removed
   2026-10-16) and nothing opens #fontModal2 any more. DMS has _fontsize() if revived.
             $("#FontBtn2").click(function(){ // filelibrary
             //   var nfontsize  = $("#fontsize").val();
                var nfontsize  = document.getElementById("FontSel").value;
            //    var nmfontsize = document.getElementById("MFontSel").value;
                var sarecid    = $("#recid").val();

//alert('726');
  //      alert(nfontsize);
//alert(sarecid);
                    $.ajax({

                        url:'<?= BASE_URL ?>cms-ccmpslibrary/fontsize',
                        type: 'post',
                        data: {fontsize:nfontsize,recid:sarecid},
                      //  data: {fontsize:nfontsize,mfontsize:nmfontsize,recid:sarecid},
                      //  dataType: "json",  // if wanted to pass to php function fontsize()
              //   as json object and not input. As json could send to node.js or API

                        success:function(response){
                            $("#result").text(response);
                            setTimeout(function(){
                                $("#result").fadeOut("slow");
                                $("#fontsize").val("");
                                $("#mfontsize").val("");
                                $("#recid").val("");
                                $("#tabsleft").val("");
                                $("#dbtupd").val("");
                                $("#myModal").modal("hide");
                            }, 2500);

                        },
                        error:function(response){
                            $("#result").text(response);
                       // error:function(jqXHR, textStatus, errorThrown){
                       //    var $errmsg = '<p>Status code: ' + jqXHR.status + '</p>'
                         //   console.log($errmsg);
                        }


                    });

            });
*/

            // Reset password modal - Reset Password button calls MyModal2 which calls this which posts values from form to honcho/modalresetpw
            $("#ResetBtn").click(function(){

                         //   alert('Fired');
                var req_pw_length    = $("#rpwl2").val();
                var new_password     = $("#npass2").val();
                var confirm_password = $("#cpass2").val();
                var db_to_update     = $("#dbtupd2").val();
                var sarecid          = $("#id2").val();
//alert(sarecid);
                if(new_password == "" || confirm_password == ""){ // 1st else
                    alert('All fields are required');
                  //    alert('new password ='+new_password+' confim pw ='+confirm_password+' req length ='+'All fields are required: inspinia template line 260');
                  //  confirm('This account will be permanently deleted. Confirm Deletion?');
                }else{ // 1st else
//alert(sarecid);
                 if(new_password.length >= req_pw_length){


                  if(new_password == confirm_password){ // 2nd else

                    $.ajax({

                        url:'<?= BASE_URL ?>welcome-ccmps/modalresetpw',
                        type: 'post',
                        data: {npass:new_password,cpass:confirm_password,recid:sarecid,dbtupd:db_to_update}, // these are values posted to url as inputs (not segments)
                        success:function(response){
                            $("#result").text(response);
                            setTimeout(function(){
                                $("#result").fadeOut("slow");
                                $("#npass2").val("");
                                $("#cpass2").val("");
                                $("#dbtupd2").val("");
                                $("#myModal2").modal("hide");
                            }, 3000);

                        },
                        error:function(response){
                            $("#result").text(response);
                       // error:function(jqXHR, textStatus, errorThrown){
                       //    var $errmsg = '<p>Status code: ' + jqXHR.status + '</p>'
                         //   console.log($errmsg);
                        }
                    });
                  }else{ // 2nd else
                    alert('The new password does not match the confirm password.');
                        setTimeout(function(){
                          //  $("#result").fadeOut("slow");
                            $("#npass").val("");
                            $("#cpass").val("");
                            $("#dbtupd").val("");
                        }, 500);
                  } // 2nd else
              }else{
                alert('The new password failed validation rules. It must be at least '+req_pw_length+' characters long.');
                        setTimeout(function(){
                          //  $("#result").fadeOut("slow");
                            $("#npass").val("");
                            $("#cpass").val("");
                            $("#dbtupd").val("");
                        }, 500);

              }



                } // 1st else above
            });





         // change password modal
            $("#ChangeBtn1").click(function(){
           //           $('#ChangeBtn').on('click',function(){

 //               alert('Fired');
                var req_pw_length    = $("#rpwl").val();
                var current_password = $("#crpass").val();
                var new_password     = $("#npass").val();
                var confirm_password = $("#cpass").val();
                var db_to_update     = $("#dbtupd").val();
                var sarecid          = $("#recid").val();

                if(current_password =="" || new_password == "" || confirm_password == ""){ // 1st else
                    alert('All fields are required');
                  //  confirm('This account will be permanently deleted. Confirm Deletion?');
                }else{ // 1st else

                 if(new_password.length >= req_pw_length){


                  if(new_password == confirm_password){ // 2nd else

                    $.ajax({

                      /*  swal({
                            title: "Ajax request example",
                            text: "Submit to run ajax request",
                            url:'<?= BASE_URL ?>honcho/modalchangepw',
                            type: 'post',
                            data: {crpass:current_password,npass:new_password,cpass:confirm_password},
                            showCancelButton: true,
                            closeOnConfirm: false,
                            showLoaderOnConfirm: true
                            }, function () {
                            setTimeout(function () {
                                swal("Ajax request finished!");
                            }, 2000);
                        }); */


                        url:'<?= BASE_URL ?>welcome-ccmps/modalchangepw',
                        type: 'post',
                        data: {crpass:current_password,npass:new_password,cpass:confirm_password,dbtupd:db_to_update,recid:sarecid}, // these are values posted to url as inputs (not segments)
                        success:function(response){
                            $("#result").text(response);
                            setTimeout(function(){
                                $("#result").fadeOut("slow");
                                $("#crpass").val("");
                                $("#npass").val("");
                                $("#cpass").val("");
                                $("#dbtupd").val("");
                                $("#myModal").modal("hide");
                            }, 2500);


                        },
                        error:function(response){
                            $("#result").text(response);
                       // error:function(jqXHR, textStatus, errorThrown){
                       //    var $errmsg = '<p>Status code: ' + jqXHR.status + '</p>'
                         //   console.log($errmsg);
                        }
                    });
                  }else{ // 2nd else
                    alert('The new password does not match the confirm password.');
                        setTimeout(function(){
                          //  $("#result").fadeOut("slow");
                            $("#npass").val("");
                            $("#cpass").val("");
                            $("#dbtupd").val("");
                        }, 500);
                  } // 2nd else
              }else{
                alert('The new password failed validation rules. It must be at least '+req_pw_length+' characters long.');
                        setTimeout(function(){
                          //  $("#result").fadeOut("slow");
                            $("#npass").val("");
                            $("#cpass").val("");
                            $("#dbtupd").val("");
                        }, 500);

              }



                } // 1st else above
            });

         // For an In Review Comment
            $("#IrcBtn").click(function(){
           // $('#IpcBtn').on('click',function(){

             //   alert('Fired');
                var ircomment    = $("#ircomment").val();
                var managemode   = $("#managemode").val();
                var frmpg        = $("#frmpg").val();
                var recid        = $("#recid").val();

                    $.ajax({

                      //  url:'<?= BASE_URL ?>welcome-ccmps/modalrejectdoc',
                        url:'<?= BASE_URL ?>dms-dmslibrary/modalircomment',
                        type: 'post',
                        data: {ircomment:comment,managemode:managemode,frmpg:frmpg,recid:recid}, // these are values posted to url as inputs (not segments)
                        success:function(response){
                            $("#result").text(response);
                            setTimeout(function(){
                                $("#result").fadeOut("slow");
                                $("#ircomment").val("");
                                $("#managemode").val("");
                                $("frmpg").val("");
                                $("#recid").val("");
                                $("#myModal").modal("hide");
                            }, 2500);


                        },
                        error:function(response){
                            $("#result").text(response);
                       // error:function(jqXHR, textStatus, errorThrown){
                       //    var $errmsg = '<p>Status code: ' + jqXHR.status + '</p>'
                            console.log($errmsg);
                        }
                    });

                } // 1st else above
            });


         // For an In Process Comment
            $("#IpcBtn").click(function(){
           // $('#IpcBtn').on('click',function(){

             //   alert('Fired');
                var ipcomment    = $("#ipcomment").val();
                var managemode   = $("#managemode").val();
                var frmpg        = $("#frmpg").val();
                var recid        = $("#recid").val();

                    $.ajax({

                      //  url:'<?= BASE_URL ?>welcome-ccmps/modalrejectdoc',
                        url:'<?= BASE_URL ?>dms-dmslibrary/modalipcomment',
                        type: 'post',
                        data: {ipcomment:comment,managemode:managemode,frmpg:frmpg,recid:recid}, // these are values posted to url as inputs (not segments)
                        success:function(response){
                            $("#result").text(response);
                            setTimeout(function(){
                                $("#result").fadeOut("slow");
                                $("#ipcomment").val("");
                                $("#managemode").val("");
                                $("frmpg").val("");
                                $("#recid").val("");
                                $("#myModal").modal("hide");
                            }, 2500);


                        },
                        error:function(response){
                            $("#result").text(response);
                       // error:function(jqXHR, textStatus, errorThrown){
                       //    var $errmsg = '<p>Status code: ' + jqXHR.status + '</p>'
                            console.log($errmsg);
                        }
                    });

                } // 1st else above
            });


         // add comment modal
            $("#DocCommentBtn").click(function(){
           // $('#RejectBtn').on('click',function(){

             //   alert('Fired');
                var doccomment   = $("#doccomment").val();
                var managemode   = $("#managemode").val();
                var frmpg        = $("#frmpg").val();
                var recid        = $("#recid").val();

                    $.ajax({
                        url:'<?= BASE_URL ?>welcome-ccmps/modaladdcomment',
                        type: 'post',
                        data: {doccomment:doccomment,managemode:managemode,frmpg:frmpg,recid:recid}, // these are values posted to url as inputs (not segments)
                        success:function(response){
                            $("#result").text(response);
                            setTimeout(function(){
                                $("#result").fadeOut("slow");
                                $("#rejectreason").val("");
                                $("#managemode").val("");
                                $("frmpg").val("");
                                $("#recid").val("");
                                $("#myModal").modal("hide");
                            }, 2500);

                        },
                        error:function(response){
                            $("#result").text(response);
                       // error:function(jqXHR, textStatus, errorThrown){
                       //    var $errmsg = '<p>Status code: ' + jqXHR.status + '</p>'
                            console.log($errmsg);
                        }
                    });

                } // 1st else above
            });

         // reject document modal - For an Pending Approval Comment
            $("#RejectBtn").click(function(){
           // $('#RejectBtn').on('click',function(){

             //   alert('Fired');
                var rejectreason = $("#rejectreason").val();
                var managemode   = $("#managemode").val();
                var frmpg        = $("#frmpg").val();
                var recid        = $("#recid").val();

                    $.ajax({

                        url:'<?= BASE_URL ?>welcome-ccmps/modalrejectdoc',
                        type: 'post',
                        data: {rejectreason:comment,managemode:managemode,frmpg:frmpg,recid:recid}, // these are values posted to url as inputs (not segments)
                        success:function(response){
                            $("#result").text(response);
                            setTimeout(function(){
                                $("#result").fadeOut("slow");
                                $("#rejectreason").val("");
                                $("#managemode").val("");
                                $("frmpg").val("");
                                $("#recid").val("");
                                $("#myModal").modal("hide");
                            }, 2500);


                        },
                        error:function(response){
                            $("#result").text(response);
                       // error:function(jqXHR, textStatus, errorThrown){
                       //    var $errmsg = '<p>Status code: ' + jqXHR.status + '</p>'
                            console.log($errmsg);
                        }
                    });




                } // 1st else above
            });


       });
    </script>



<!-- End Javascript   -->
<!-- </div>    id="app"  -->
</body>

</html>
